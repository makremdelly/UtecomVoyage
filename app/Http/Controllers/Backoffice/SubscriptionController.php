<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\History;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;


class SubscriptionController extends Controller
{
    public function getsubscriptions()
    {
        $reservations = Payment::select(
            [
                'reservations.*',
                'payments.amount',
                'users.name as user_name',
                'users.email as user_email',
                'users.id as user_id',
                'users.phone',
            ]
        )
            ->join('reservations', 'payments.id', '=', 'reservations.payment_id')
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->get()->toArray();

        return $reservations;
    }

    public function allsubscriptions()
    {
        return datatables($this->getsubscriptions())->toJson();
    }

    public function getReservation($id)
    {
        $reservations = DB::table('reservations')
            ->where('id', '=', $id)
            ->get();
        return datatables($reservations)->toJson();
    }


    /**       
     * Display a listing of the resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Response
     */
    public function sendReminder(Request $request, $id)
    {
        $data = $request->mytext;
        $email = $request->myemail;
        Mail::send([], [], function ($message) use ($data, $email) {
            $message->to($email)
                ->subject('Retard de paiement')
                ->setBody($data);
        });
    }

    // public function print(Request $request, $id)
    // {
    //     $histories = History::select(
    //         [
    //             'histories.*',
    //             'hotels.name as hotel_name',
    //             'users.name as user_name',
    //             'users.id as user_id',
    //             'users.email as user_email',
    //         ]
    //     )
    //         ->where('histories.reservation_id', $id)
    //         ->leftJoin('hotels', 'hotels.id', '=', 'histories.hotel_id')
    //         ->leftJoin('users', 'users.id', '=', 'histories.user_id')
    //         ->get()->toArray();
    //     $size = sizeof($histories);
    //     return $histories[$size - 1];
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('subscriptions');
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
    // public function show($id)
    // {
    //     //    $histories = History::all()->where('histories.subscription_id',$id);
    //     $histories = History::select(
    //         [
    //             'histories.*',
    //             'hotels.name as hotel_name',
    //             'users.name as user_name',
    //             'users.id as user_id',
    //             'users.email as user_email',
    //         ]
    //     )
    //         ->where('histories.user_id', $id)
    //         ->leftJoin('hotels', 'hotels.id', '=', 'histories.hotel_id')
    //         ->join('users', 'users.id', '=', 'histories.user_id')
    //         ->get()->toArray();
    //     // dd($histories);

    //     return view('Subscription-show')->with(['histories' => $histories]);
    // }




    public function show(Request $request, $user_id)
    {
        $res = $this->getReservation($user_id);

        $histories = Reservation::select(
            [
                'reservations.*',
                'payments.amount',
                'hotels.name as hotel_name',
                'users.name as user_name',
                'users.id as user_id',
                'users.email as user_email',
            ]
        )
            ->where('users.id', $user_id)
            ->leftJoin('hotels', 'hotels.id', '=', 'reservations.hotel_id')
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->join('payments', 'payments.id', '=', 'reservations.payment_id')
            ->get()->toArray();
        // dd($histories);

        return view('Subscription-show')->with(['histories' => $histories]);
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
        $amount = $request->amount_a_payer;
        // dd($amount);
        // $res = Payment::select(
        //     [
        //         'payments.amount',

        //     ]
        // )
        //     ->join('reservations', 'payments.id', '=', 'reservations.payment_id')
        //     ->where('reservations.id', $id)
        //     ->update(['amount' => $amount]);
        $res = Reservation::select(
            [
                'reservations.*',
                'payments.amount',
            ]
        )
            ->join('payments', 'payments.id', '=', 'reservations.payment_id')
            ->where('reservations.id', $id)
            ->update(['amount' => $amount]);
           
        Reservation::where('id', $id)
        ->where('status', 'En attente de paiement')
        ->update(['status' => 'Acceptée']);
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
