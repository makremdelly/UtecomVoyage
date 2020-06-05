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

		return view('hotels');
	}

	public function uploadImage(Request $request)
	{
		request()->validate([
			'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
			'name' => 'required',
			'phone' => 'required',
			'description' => 'required',
			'star' => 'required',
			'address' => 'required'
		]);



		// $imageName = time().'.'.request()->image->getClientOriginalExtension();
		$name = request()->name;
		$tel = request()->phone;
		$description = request()->description;
		$st = request()->star;
		$address = request()->address;

		//upload image 
		$hotel = new Hotel;
		$hotel->name = $name;
		$hotel->phone = $tel;
		$hotel->description = $description;
		$hotel->stars = $st;
		$hotel->address = $address;
		$hotel->save();

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
				DB::raw('(CASE WHEN (COUNT(DISTINCT(reservations.id))<> 0 ) THEN COUNT(DISTINCT(reservations.id)) ELSE 0 END)  as reservations_count'),
			]
		)
			->leftJoin('rooms', 'hotels.id', '=', 'rooms.hotel_id')
			->leftJoin('reservations', 'hotels.id', '=', 'reservations.hotel_id')
			->groupBy('hotels.id')
			->get()->toArray();
		return $rooms;
	}

	public function getHotels()
	{
		return datatables($this->getTrait())->toJson();
	}

	public function getreservations(Hotel $hotel)
	{
		$reservations = Payment::select(
			[
				'reservations.*',
				'payments.amount',
				'users.name as user_name',//
                'users.email as user_email',//
			]
		)
			->join('reservations', 'payments.id', '=', 'reservations.payment_id')
			->join('users', 'users.id', '=', 'reservations.user_id')//
			->where('hotel_id', $hotel->id)
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
	public function update(Request $request, Hotel $hotel)
	{
		//
	}

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
		\Spatie\MediaLibrary\Models\Media::where('model_id', $hotel->id)->update(['deleted_at' => now()]);
		$r = Reservation::select('payment_id')->where('hotel_id', $hotel->id)->get()->toArray();
		$nb = count($r);
		for ($i = 0; $i < $nb; $i++) {
			Payment::find($r[$i]['payment_id'])->delete();
		}
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
	function autocars()
	{
		return view('autocars');
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
