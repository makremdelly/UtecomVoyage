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


		// $editeurs = DB::table('reservations_has_rooms')->get();
		// foreach ($editeurs as $editeur) {
		// 	echo $editeur->room_id;
		// }
		$rooms = Room::select(
			[
				'rooms.*',
				'hotels.name as hotel_name',
				'reservations_has_rooms.room_id as exist'

			]
		)
			->leftJoin('hotels', 'hotels.id', '=', 'rooms.hotel_id')
			->leftJoin('reservations_has_rooms', 'reservations_has_rooms.room_id', '=', 'rooms.id')
			->get()->toArray();

		// dd($rooms);
		return datatables($rooms)->toJson();

		// 		<?php
		// $editeurs = DB::table('editeurs')->get();
		// foreach ($editeurs as $editeur) {
		//     echo $editeur->nom, '<br>';
		// }


	}
}
