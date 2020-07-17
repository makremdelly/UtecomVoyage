<?php

namespace App\Http\Controllers\Backoffice;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Charts\ReservationChart;



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


        $countH = Hotel::select(
            [
                'hotels.id',
                'hotels.name',
                'hotels.stars',
                'hotels.created_at',
                DB::raw('(CASE WHEN (COUNT(DISTINCT(rooms.id))<> 0 ) THEN COUNT(DISTINCT(rooms.id)) ELSE 0 END)  as rooms_count'),
                // DB::raw('(CASE WHEN (COUNT(DISTINCT(reservations.id))<> 0 ) THEN COUNT(DISTINCT(reservations.id)) ELSE 0 END)  as reservations_count'),
                DB::raw('(CASE WHEN (COUNT(DISTINCT(reservations_has_rooms.reservation_id))<> 0 ) THEN COUNT(DISTINCT(reservations_has_rooms.reservation_id)) ELSE 0 END)  as reservations_count'),
                ]
        )
            // ->leftJoin('reservations', 'hotels.id', '=', 'reservations.hotel_id')
            ->leftJoin('rooms', 'hotels.id', '=', 'rooms.hotel_id')
            ->leftJoin('reservations_has_rooms', 'rooms.id', '=', 'reservations_has_rooms.room_id')
            ->groupby('hotels.id')->orderby('reservations_count', 'desc')->limit(5)->get()->toArray();
        // dd($hotel);

        // Reservation::select(DB::raw('*, COUNT(hotel_id) as hotel_count'))->with('hotel')->groupby('hotel_id')->orderby('hotel_count', 'desc')->limit(4)->get();
        // $image = DB::table('media')->select('media.name', 'media.file_name', 'hotels.id')
        //     ->leftJoin('media', 'hotels.id', '=', 'media.model_id')
        //     ->where('model_type', 'App\Models\Hotel')
        //     ->where('model_id','hotels.id')
        //     ->get()->toArray();;
        // dd($image);
        // $arr = array();

        $months = collect([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
        $res = DB::table('reservations')
            ->select(DB::raw('count(*) as count, extract(month from reservations.created_at) as month'))
            ->groupBy('month')
            ->pluck('count', 'month');

        $statis=$months->map(function ($value, $key) use ($res) {
            if (isset($res[$key + 1], $res)) {
                return $res[$key + 1];
            }
            return 0;
        })->toArray();

        $chart = new ReservationChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->height(350);
        // $chart->title("My Cool Chart");
        $chart->type('datetime');

        $chart->type('line');
        $chart->dataset('Réservations', 'line', $statis)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0',
        ]);
        // dd($chart);

        $media = Hotel::select(
            [
                'hotels.id',
                'hotels.name',
                'media.name as name_media',
                'media.file_name as filename_media',
            ]
        )
            ->join('media', 'hotels.id', '=', 'media.model_id')
            ->where('model_type', 'App\Models\Hotel')
            ->orderby('name_media', 'desc')
            ->get()->toArray();
        // dd($media);
        $count = Room::all()->count();
        $countres = Reservation::all()->count();
        return view('dashboard')
            ->with([

                'reservations'    => $countres,
                'rooms'           => $count,
                'hotels'          => $countH,
                'pictures'        => $media,
                'chart'           => $chart
            ]);
    }
}
