<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Payment;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

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
    public function show(Request $request, $hotelid)
    {

        //get the current reservation id 
        $r = parse_url(URL::current());
        $resid = substr($r['path'], strrpos($r['path'], '/')+1);

        $reservationobject = Reservation::find($resid);
        $arr = array();
        foreach ($reservationobject->rooms as $room) {
            $r = $room->toArray();
            array_push($arr,$r);
        }
        
        // dd($arr);
        $res = Reservation::select(
            [
                'reservations.*',
                'payments.amount',
                'users.name as user_name',
                'users.email as user_email',
                'users.id as user_id',
                'users.phone',  
            ]
        )
        ->join('payments', 'payments.id', '=','reservations.payment_id')
        ->join('users', 'users.id', '=', 'reservations.user_id')
        ->where('reservations.id',$resid)
        ->get()->toArray();
        //get current hotel 
        $h = Hotel::where('id',$res[0]['hotel_id'])->get()->toArray();
        // dd($h,$res,$arr);
       
		if (($resid == $res[0]['id']) && ($hotelid == $res[0]['hotel_id']) ) {
            return view('reservationshow')
            ->with([
                'reservation'   => $res,
                'hotel'         => $h,
                'rooms'         => $arr,
                ]);
		} else {
			abort(404);
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
    public function update(Request $request, $id)
    {
        //
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
