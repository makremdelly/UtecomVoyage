<?php

namespace App\Http\Controllers\Backoffice;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Room;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(Request $request)
    {   
        // return view('dashboard');
        
        $count = Room::all()->count();
        $countres = Reservation::all()->count();
        return view('dashboard')
            ->with([
               
                'reservations'    => $countres,
                'rooms'           =>$count
                ]);
    }

    }
    

