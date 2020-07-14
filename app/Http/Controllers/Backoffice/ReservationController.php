<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Payment;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Softon\SweetAlert\Facades\SWAL;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reservations');
    }

    public function allreservations()
    {
        $reservations = Payment::select(
            [
                'reservations.*',
                'payments.amount',
                'hotels.name as hotel_name',
                'users.name as user_name',
                'users.email as user_email',
                'users.id as user_id',
                'users.phone',
            ]
        )
            ->join('reservations', 'payments.id', '=', 'reservations.payment_id')
            ->join('hotels', 'reservations.hotel_id', '=', 'hotels.id')
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->get()->toArray();
        // dd($reservations);
        return datatables($reservations)->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $hotelid, $roomid)
    {
        //get the current reservation id 
        $r = parse_url(URL::current());
        $resid = substr($r['path'], strrpos($r['path'], '/') + 1);
        $url = explode('/', URL::current());
        // dd($url);

        $reservationobject = Reservation::find($resid);

        $arr = array();
        foreach ($reservationobject->rooms as $room) {
            $r = $room->toArray();
            array_push($arr, $r);
            $t = $room['id'];
        }
        // dd($r);
        //  dd($t);
        
        $offer = Offer::select('discount','price')->where('room_id', $room->id)->get()->toArray();
        $discount = $offer['0']['discount'];
		$price = $offer['0']['price'];
		$remise = abs($price - $discount);
        //  dd($remise);
        $res = Reservation::select(
            [
                'reservations.*',
                'payments.amount',
                'users.name as user_name',
                'users.email as user_email',
                'users.id as user_id',
                'users.phone',
                // 'reservations_has_rooms.reservation_id',
                // 'reservations_has_rooms.room_id'
            ]
        )
            ->join('payments', 'payments.id', '=', 'reservations.payment_id')
            ->join('users', 'users.id', '=', 'reservations.user_id')
            // ->leftJoin('reservations_has_rooms', 'reservations.id', '=', 'reservations_has_rooms.reservation_id')
            ->where('reservations.id', $resid)
            ->get()->toArray();

        //get current hotel 
        $h = Hotel::where('id', $res[0]['hotel_id'])->get()->toArray();

        // $rooms_has_resa = DB::table('reservations_has_rooms')
        // ->join('reservations', 'reservations.id', '=', 'reservations_has_rooms.reservation_id')
        // ->select('reservation_id','room_id')
        // ->where('reservation_id', $resid)
        // ->get()->toArray();
        // dd($rooms_has_resa);

        // $room1 = Room::where('id', $res[0]['room_id'])->get()->toArray();
        // dd($h,$res,$arr);
        // dd($room1);
        if ($url[3] == 'room') {
            if (($resid == $res[0]['id']) && ($url[4] == $t)) {
                return view('reservationshow')
                    ->with([
                        'reservation'   => $res,
                        'hotel'         => $h,
                        'rooms'         => $arr,
                        'offers'        =>$offer,
                        'remise'        =>$remise
                    ]);
            } else {
                abort(404);
            }
        } else if ($url[3] == 'hotels') {
            if (($resid == $res[0]['id']) && ($hotelid == $res[0]['hotel_id'])) {
                return view('reservationshow')
                    ->with([
                        'reservation'   => $res,
                        'hotel'         => $h,
                        'rooms'         => $arr,
                        'offers'        =>$offer,
                        'remise'        =>$remise
                    ]);
            } else {
                abort(404);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request, $id)
    {
        // $reservtions = Reservation::find($id);
        // $reservtions->status = 'Acceptée';
        // $reservtions->save();    
        // SWAL::message('Bien', 'réservation acceptée avec succès', 'success', ['timer' => 4000]);
        // return redirect('reservations/');


        // $reservtions = Reservation::find($id);
        $reservtions = Reservation::select(
            [
                'reservations.*',
                'payments.amount',
            ]
        )
            ->join('payments', 'payments.id', '=', 'reservations.payment_id')
            ->where('reservations.id', $id)
            ->first()->toArray();
        // dd($reservtions);
        if ($reservtions['amount'] == 'Non payé') {
            $reservtions = Reservation::where('id', $reservtions['id'])->update(['status' => 'En attente de paiement']);
        } else {
            $reservtions = Reservation::where('id', $reservtions['id'])->update(['status' => 'Acceptée']);
        }
        SWAL::message('Bien', 'réservation acceptée avec succès', 'success', ['timer' => 4000]);
        return redirect('reservations/');
    }


    public function refuse(Request $request, $id)
    {
        $reservtions = Reservation::find($id);
        $reservtions->status = 'Refusée';
        $reservtions->save();
        SWAL::message('Bien', 'réservation Refusée', 'success', ['timer' => 4000]);
        return redirect('reservations/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
