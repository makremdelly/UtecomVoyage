<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

	public function destroy(Request $request, Room $room)
	{

		$room->delete();
	}
}
