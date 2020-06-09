<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Reservation;

use Spatie\MediaLibrary\Models\Media;


class RoomController extends Controller
{
	function index()
	{
		return view('room');
	}

	public function allrooms()
	{
		$arr = array();

		$rooms = Room::select(
			[
				'rooms.*',
				'hotels.name as hotel_name',
			]
		)
			->leftJoin('hotels', 'hotels.id', '=', 'rooms.hotel_id')
			->get()->toArray();


		$rooms_has_resa = DB::table('reservations_has_rooms')
			->select('room_id')
			->groupBy('room_id')
			->get();
		foreach ($rooms_has_resa as $room_res) {
			array_push($arr, $room_res->room_id);
		}

		foreach ($rooms as $index => $room) {
			if (in_array($room['id'], $arr)) {
				$rooms[$index]['disponibility'] = 1;
			} else {
				$rooms[$index]['disponibility'] = 0;
			}
		}
		return datatables($rooms)->toJson();
	}

	public function getTrait()
	{
		$rooms = Room::select(
			[
				'rooms.id',
				'hotels.name',
				'hotels.stars',
				'hotels.address',
				// DB::raw('(CASE WHEN (COUNT(DISTINCT(rooms.id))<> 0 ) THEN COUNT(DISTINCT(rooms.id)) ELSE 0 END)  as rooms_count'),
				// DB::raw('(CASE WHEN (COUNT(DISTINCT(reservations.id))<> 0 ) THEN COUNT(DISTINCT(reservations.id)) ELSE 0 END)  as reservations_count'),
			]
		)
			->leftJoin('hotels', 'hotels.id', '=', 'rooms.hotel_id')
			// ->leftJoin('reservations', 'hotels.id', '=', 'reservations.hotel_id')
			// ->groupBy('hotels.id')
			->get()->toArray();
		return $rooms;
	}

	public function getreservations(Room $room)
	{


		$rooms_has_resa = DB::table('reservations_has_rooms')
			
			->join('reservations', 'reservations.id', '=', 'reservations_has_rooms.reservation_id')
			->join('payments', 'payments.id', '=', 'reservations.payment_id')
			->join('users', 'users.id', '=', 'reservations.user_id') //
	
			->select('reservation_id', 'payments.amount', 'users.name', 'users.email', 'reservations.arrival_date')

			->where('room_id', $room->id)
			->get()->toArray();


			// DB::table('users')
            // ->join('contacts', 'users.id', '=', 'contacts.user_id')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            // ->select('users.id', 'contacts.phone', 'orders.price')
            // ->get();



			// $reservations = Reservation::select(
			// 	[
			// 		'reservations.*',
			// 		'payments.amount',
			// 		'users.name as user_name', //
			// 		'users.email as user_email', //
			// 	]
			// )
			// 	->join('payments', 'payments.id', '=', 'reservations.payment_id')
			// 	->join('users', 'users.id', '=', 'reservations.user_id') //
			// 	->where('id', $room->id)
			// 	->get()->toArray();



		return datatables($rooms_has_resa)->toJson();
	}

	public function show(Request $request, Room $room)
	{

		//get all Rooms
		$allrooms = $this->getTrait();
		//count rooms
		$count = Room::all()->count();
		//this room services
		$serviceh = Service::where('hotel_id', $room->id)->get()->toArray();
		//get index of current room in the array 
		for ($i = 0; $i < $count; $i++) {
			if ($allrooms[$i]['id'] == $room->id) {
				$index = $i;
				break;
			}
		}
		//get all pictures for this room 
		$newsItem = $room;
		$newsItem->getMedia('images')->toArray();
		$pics = $newsItem['media']->toArray();

		//get current hotel object
		$currentroomobject = $allrooms[$index];


		return view('roomshow')
			->with([
				'room'     => $room,
				'rest'      => $currentroomobject,
				'pictures'  => $pics,
				'service'   => $serviceh,

			]);
	}
	public function destroy(Request $request, Room $room)
	{
		$room->delete();
	}
}
