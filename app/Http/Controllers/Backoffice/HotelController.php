<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Hotel;
use App\Models\Service;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Softon\SweetAlert\Facades\SWAL;
use App\Models\Photo;
use App\Models\Voyage;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\URL;



class HotelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$services = Service::select(
			[
				'services.*',
			]
		)
			->get();
		$grouped = $services->groupBy('name')->toArray();
		// dd($grouped);
		return view('hotels')
			->with([
				'services'  => $grouped,

			]);
	}

	public function uploadImage(Request $request)
	{
		request()->validate([
			'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
			'name' => 'required',
			'phone' => 'required',
			'description' => 'required',
			'star' => 'required',
			'address' => 'required',
			'service' => 'required'
		]);

		// $imageName = time().'.'.request()->image->getClientOriginalExtension();
		$name = request()->name;
		$tel = request()->phone;
		$description = request()->description;
		$st = request()->star;
		$address = request()->address;
		$servic = request()->service;

		//upload image 
		$hotel = new Hotel;
		$hotel->name = $name;
		$hotel->phone = $tel;
		$hotel->description = $description;
		$hotel->stars = $st;
		$hotel->address = $address;
		$hotel->save();


		$service = new Service;
		$service->name = $servic;
		$service->hotel_id = $hotel->id;
		if ($servic = 'WIFI') {
			$service->description = 'Est maxime voluptatem et perferendis est soluta beatae fugiat. Aut voluptatibus dicta aut sed iure nisi. Perspiciatis nihil consectetur enim delectus.';
			$service->icon = 'fas fa-wifi';
		} elseif ($servic = 'ascenseur') {
			$service->description = 'Sint ullam dolore ut velit quia error. Dolorem et impedit adipisci. Deleniti tenetur quae iusto sed. Et voluptatibus et ut saepe.';
			$service->icon = 'fas fa-gamepad';
		} elseif ($servic = 'Salle de Sport') {
			$service->description = 'Quia eum velit deserunt labore. Tempore quasi impedit ullam ducimus recusandae ab. Aspernatur sapiente hic sed quaerat id neque ut ad. Ex dolorem perspiciatis adipisci iure corrupti explicabo aut.';
			$service->icon = 'fas fa-swimmer';
		} elseif ($servic = 'Parking') {
			$service->description = 'Qui unde voluptas natus perspiciatis quia consequatur aut. Rerum explicabo et aut minus.';
			$service->icon = 'fas fa-parking';
		}
		// dd($service);
		$service->save();
		$file = array();
		$files = request()->file('image');
		foreach ($files as $file) {
			// get File name with extension 
			$filenameWithExt = $file->getClientOriginalName();
			// //get just the file name 
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			// //get extension 
			$extension = $file->getClientOriginalExtension();
			// //create new filename
			$filenameToStore = $filename . '_' . time() . '.' . $extension;
			$file->storeAs('public/' . $hotel->id, $filenameToStore);
			Hotel::find($hotel->id)
				->addMediaFromUrl('storage/' . $hotel->id . '/' . $filenameToStore)
				->preservingOriginal() //middle method
				->toMediaCollection(); //finishing method
		}
		SWAL::message('Bien', 'votre hotel a été ajouté avec succès', 'success', ['timer' => 4000]);
		return redirect('hotels/' . $hotel->id);
	}
	public function getTrait()
	{
		$rooms = Hotel::select(
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
			->leftJoin('rooms', 'hotels.id', '=', 'rooms.hotel_id')
			// ->leftJoin('reservations', 'hotels.id', '=', 'reservations.hotel_id')
			->leftJoin('reservations_has_rooms', 'rooms.id', '=', 'reservations_has_rooms.room_id')
			->groupBy('hotels.id')
			->get()->toArray();
		return $rooms;
	}

	public function getHotels()
	{
		return datatables($this->getTrait())->toJson();
	}

	// public function getreservations(Hotel $hotel)
	// {
	// 	$reservations = Payment::select(
	// 		[
	// 			'reservations.*',
	// 			'payments.amount',
	// 			'users.name as user_name', //
	// 			'users.email as user_email', //
	// 		]
	// 	)
	// 		->join('reservations', 'payments.id', '=', 'reservations.payment_id')
	// 		->join('users', 'users.id', '=', 'reservations.user_id') //
	// 		->where('hotel_id', $hotel->id)
	// 		->get()->toArray();
	// 	return datatables($reservations)->toJson();
	// }
	public function getreservations(Hotel $hotel)
	{
		$reservations = DB::table('reservations_has_rooms')
			->join('reservations', 'reservations.id', '=', 'reservations_has_rooms.reservation_id')
			->join('rooms', 'rooms.id', '=', 'reservations_has_rooms.room_id')
			->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
			->join('payments', 'payments.id', '=', 'reservations.payment_id')
			->join('users', 'users.id', '=', 'reservations.user_id') //
			->select('reservations.*', 'reservation_id as res_id', 'payments.amount', 'users.name as user_name', 'users.email as user_email', 'reservations.arrival_date', 'reservations.departure_date', 'hotels.id as hotel_id')
			->where('rooms.hotel_id', $hotel->id)
			->get()->toArray();
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
	public function getHotel($id)
	{
		$hotels = DB::table('hotels')
			->where('id', '=', $id)
			->get();
			echo json_encode($hotels);
			// return datatables($hotels)->toJson();
	}

	public function update(Request $request, $id)
	{	
		$hotels = Hotel::find($id);
		$hotels = Hotel::where('id', '=', $id)->first(); // where id is method param from url or request object

		//    $name = $request->input('nbplace');
		$hotels->name = $request->input('name');
		$hotels->stars = $request->input('star');
		$hotels->phone = $request->input('phone');
		$hotels->address = $request->input('address1');
		$hotels->description = $request->input('exampleFormControlTextarea1');
		$hotels->save();
		$service= Service::where('hotel_id', $id)->first();
		$service->name = $request->input('service');
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
	 * @param  \App\Hotel  $hotel
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Hotel $hotel)
	{

		// get hotel owners
		$arr = array();
		foreach ($hotel->users as $user) {
			$s = $user->toArray();
			array_push($arr, $s);
		}
		// dd($arr);

		//get all hotels
		$allhotels = $this->getTrait();
		//count hotels
		$count = Hotel::all()->count();
		//this hotel services
		$serviceh = Service::where('hotel_id', $hotel->id)->get()->toArray();
		//get index of current hotel in the array 
		for ($i = 0; $i < $count; $i++) {
			if ($allhotels[$i]['id'] == $hotel->id) {
				$index = $i;
				break;
			}
		}
		//get all pictures for this hotel 
		$newsItem = $hotel;
		$newsItem->getMedia('images')->toArray();
		$pics = $newsItem['media']->toArray();
		//get current hotel object
		$currenthotelobject = $allhotels[$index];
		// $pictures = Photo::where('hotel_id', $hotel->id)->get()->toArray();
		// dd($pictures);
		// $pictures = Hotel::find($hotel->id)->getMedia();

		return view('hotelshow')
			->with([
				'rest'      => $currenthotelobject,
				'hotel'     => $hotel,
				'pictures'  => $pics,
				'service'   => $serviceh,
				'owners'    => $arr
			]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Hotel  $hotel
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Hotel $hotel)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Hotel  $hotel
	 * @return \Illuminate\Http\Response
	 */


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Hotel  $hotel
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Hotel $hotel)
	{

		// foreach ($hotel->users as $user) {
		//     $user->delete();   
		// }
		Room::where('hotel_id', $hotel->id)->delete();
		Service::where('hotel_id', $hotel->id)->delete();
		\Spatie\MediaLibrary\Models\Media::where('model_id', $hotel->id)->update(['deleted_at' => now()]);
		// $r = Reservation::select('payment_id')->where('hotel_id', $hotel->id)->get()->toArray();
		// $nb = count($r);
		// for ($i = 0; $i < $nb; $i++) {
		// 	Payment::find($r[$i]['payment_id'])->delete();
		// }
		// $r = DB::table('reservations_has_rooms')
		// 	->join('reservations', 'reservations.id', '=', 'reservations_has_rooms.reservation_id')
		// 	->join('rooms', 'rooms.id', '=', 'reservations_has_rooms.room_id')
		// 	->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
		// 	->join('payments', 'payments.id', '=', 'reservations.payment_id')
		// 	->select('reservations.*','reservations.payment_id', 'reservation_id as res_id', 'payments.amount', 'reservations.arrival_date', 'reservations.departure_date', 'hotels.id as hotel_id')
		// 	->where('rooms.hotel_id', $hotel->id)
		// 	->get()->toArray();

		// $nb = count($r);
		// for ($i = 0; $i < $nb; $i++) {
		// 	Payment::find($r[$i]['payment_id'])->delete();
		// }

		$hotel->delete();
	}
	function hotel()
	{
		return view('addhotel');
	}

	function voyage()
	{
		return view('voyage');
	}

	function addprogramme(Voyage $voyage)
	{
		$r2 = parse_url(URL::current());
		$endofurl2 = substr($r2['path'], strrpos($r2['path'], '/') + 1);

		$voyage = Voyage::where('id', $endofurl2)->get()->toArray();
		// dd($voyage);

		if ($endofurl2 == $voyage[0]['id']) {
			return view('addprogramme')
				->with([
					'endofurl2'  => $endofurl2,
					'voyage'  => $voyage
				]);
		} else {
			abort(404);
		}
	}
}
