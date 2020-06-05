<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\Voyage;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Softon\SweetAlert\Facades\SWAL;
use App\Models\Photo;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use App\Models\Autocar;
use App\Models\Programme;
use Carbon\Carbon;
use FarhanWazir\GoogleMaps\GMaps;
use Spatie\MediaLibrary\MediaCollections\File;
use App\Http\Requests\VoyagePostRequest;


class VoyageController extends Controller
{
	public function voyageAdd(Request $request)
	{

		request()->validate([
			'type' => 'required',
			'nbplace' => 'required',
			'villeD' => 'required',
			'depart' => 'required',
			'retour' => 'required',
			'startDate' => 'required',
			'endDate' => 'required',
			'prix' => 'required',
			'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
			'autocar' => 'required',
			'description' => 'required',
		]);

		$Type = request()->type;
		$NbPlace = request()->nbplace;
		$VilleD = request()->villeD;
		$depart = request()->depart;
		$retour = request()->retour;
		$startdata = request()->startDate;
		$enddate = request()->endDate;
		$Prix = request()->prix;
		$Autocar = request()->autocar;
		$description = request()->description;



		// $dom = new \DomDocument();
		// $dom->loadHtml($descriptionn, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
		// $description = $dom->saveHTML();



		$voyage = new Voyage;
		$voyage->type = $Type;
		$voyage->NbPlace = $NbPlace;
		$voyage->villeD = $VilleD;
		$voyage->depart = $depart;
		$voyage->retour = $retour;
		$voyage->startDate = $startdata;
		$voyage->endDate = $enddate;
		$voyage->description = $description;
		$voyage->autocar_id = $Autocar;
		$voyage->prix = $Prix;
		// $voyage->photo = $Photo;
		$voyage->save();

		$file = array();
		$files = request()->file('photo');
		foreach ($files as $file) {
			// get File name with extension 
			$filenameWithExt = $file->getClientOriginalName();
			// //get just the file name 
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			// //get extension 
			$extension = $file->getClientOriginalExtension();
			// //create new filename
			$filenameToStore = $filename . '_' . time() . '.' . $extension;
			$file->storeAs('public/' . $voyage->id, $filenameToStore);
			Voyage::find($voyage->id)
				->addMediaFromUrl('storage/' . $voyage->id . '/' . $filenameToStore)
				->preservingOriginal() //middle method
				->toMediaCollection(); //finishing method
		}

		Autocar::where('id', $voyage->autocar_id)->update(['status' => 'non disponible']);

		SWAL::message('Bien', 'votre voyage a été ajouté avec succès', 'success', ['timer' => 4000]);
		return redirect('/voyages');
	}

	// public function map()
	// {
	//     $config['center'] = 'Sydney Airport,Sydney';
	//     $config['zoom'] = '14';
	//     $config['map_height'] = '400px';

	//     $gmap = new GMaps();
	//     $gmap->initialize($config);

	//     $map = $gmap->create_map();
	//     return view('showvoyage',compact('map'));	
	// }

	public function getVoyage($id)
	{

		$voyages = DB::table('voyages')
			->where('id', '=', $id)
			->get();
			echo json_encode($voyages);
			// return datatables($voyages)->toJson();
	}
	public function allvoyages()
	{
		$voyages = Voyage::select(
			[
				'voyages.*'
			]
		);

		return datatables($voyages)->toJson();
	}

	// public function destroy(Request $request, Voyage $voyage)
	// {
	// 	// $date = Carbon::now()->toDateTimeString();

	// 	// \Spatie\MediaLibrary\Models\Media::where('model_id', $voyage->id)->update(['deleted_at' => now()]);

	// 	// $voyage::where('periode','<',$date)->update(['periode' =>'expired']);

	// 	// \Spatie\MediaLibrary\Models\Media::where('model_id', $hotel->id)->update(['deleted_at' => now()]);

	// }

	public function getTrait()
	{
		$voyages = Voyage::select(
			[
				'voyages.id',
				'voyages.type',
				'voyages.NbPlace',
				'voyages.created_at',
			]
		)
			->groupBy('voyages.id')
			->get()->toArray();
		return $voyages;
	}

	public function getVoyages()
	{
		return datatables($this->getTrait())->toJson();
	}

	public function show(Request $request, Voyage $voyage)
	{

		//get all voyages
		$allvoyages = $this->getTrait();
		//count voyages
		$count = Voyage::all()->count();

		//get all pictures for this voyage 
		$newsItem = $voyage;
		$newsItem->getMedia('images')->toArray();
		$pics = $newsItem['media']->toArray();
		// dd($pics);
		$startTimeStamp = strtotime($voyage->startDate);
		$endTimeStamp = strtotime($voyage->endDate);
		$timeDiff = abs($endTimeStamp - $startTimeStamp);
		$numberDays = $timeDiff / 86400;
		$numberDay = intval($numberDays);
		$programmes = \App\Models\Programme::where('voyage_id', $voyage->id)->get()->toArray();


		return view('showvoyage')
			->with([
				'voyage'     => $voyage,
				'pictures'  => $pics,
				'numberDay' => $numberDay,
				'programmes' => $programmes
			]);
	}







	public function updateimg($id, Request $req)
	{
		$idImg = $req->input('id');
		//$file = $req->file('image');

		$voyage = Voyage::find($id);



		$file = request()->file('photo');


		$filenameWithExt = $file->getClientOriginalName();
		// //get just the file name 
		$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
		// //get extension 
		$extension = $file->getClientOriginalExtension();
		// //create new filename
		$filenameToStore = $filename . '_' . time() . '.' . $extension;
		$file->storeAs('public/' . $voyage->id, $filenameToStore);
		$voyage->addMediaFromUrl('storage/' . $voyage->id . '/' . $filenameToStore)
			->preservingOriginal() //middle method
			->toMediaCollection(); //finishing method


		DB::table('media')->where('id', '=', $idImg)->delete();
		//$media = $voyage->getMedia()
		return "ok"; //redirect('/voyage');
	}

	public function deleteimg($id)
	{
		DB::table('media')->where('id', '=', $id)->delete();
	}

	public function allimg(Voyage $voyage)
	{
		\Spatie\MediaLibrary\Models\Media::where('model_id', $voyage->id)->delete();
	}
	public function imageAdd(Voyage $voyage, Request $request)
	{
		request()->validate([
			'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
		]);

		$file = array();
		$files = request()->file();

		foreach ($files as $file) {
			// get File name with extension 
			$filenameWithExt = $file->getClientOriginalName();
			// //get just the file name 
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			// //get extension 
			$extension = $file->getClientOriginalExtension();
			// //create new filename
			$filenameToStore = $filename . '_' . time() . '.' . $extension;
			$file->storeAs('public/' . $voyage->id, $filenameToStore);
			Voyage::find($voyage->id)
				->addMediaFromUrl('storage/' . $voyage->id . '/' . $filenameToStore)
				->preservingOriginal() //middle method
				->toMediaCollection(); //finishing method
		}
		SWAL::message('Bien', 'votre photo a été ajouté avec succès', 'success', ['timer' => 4000]);
		return redirect('voyages/' . $voyage->id);
	}


	public function update(Request $request, $id)

	{	
		// request()->validate([
		// 	'autocar' => 'required',
		// ]);
		// $Autocar = request()->autocar;

		//$id = $request->voyageId;
		$voyages = Voyage::find($id);

		$voyages = Voyage::where('id', '=', $id)->first(); // where id is method param from url or request object

		//    $name = $request->input('nbplace');
		$voyages->type = $request->input('type');
		$voyages->nbplace = $request->input('nbplace');
		//    $voyages->NbPlace = $request->input('nbplace');
		$voyages->villeD = $request->input('villeD');
		$voyages->depart = $request->input('depart');
		$voyages->retour = $request->input('retour');
		$voyages->autocar_id = $request->input('autocar');
		$voyages->prix = $request->input('prix');
		$voyages->startDate = $request->input('startDate');
		$voyages->endDate = $request->input('endDate');
		$voyages->photo = $request->input('photo');
		$voyages->description = $request->input('description');

		$voyages->save();
		Autocar::where('id', $voyages->autocar_id)->update(['status' => 'non disponible']);
		// Autocar::where('id',$Autocar)->update(['status' => ' disponible']);


		
		//    return response()->json($name);

	}

	function CheckImage(Request $request)
	{
		$pic_id_array = $request->input('id');
		$pict = Media::whereIn('id', $pic_id_array);
		if ($pict->delete()) {
			echo 'Data Deleted';
		}
	}


	public function destroy(Request $request, Voyage $voyage)
	{
		Programme::where('voyage_id', $voyage->id)->delete();
		Autocar::where('id', $voyage->autocar_id)->update(['status' => 'disponiblé']);
		\Spatie\MediaLibrary\Models\Media::where('model_id', $voyage->id)->update(['deleted_at' => now()]);
		$voyage->delete();
	}


	function addVoyage()
	{
		return view('addvoyage');
	}
}











































// <?php 
// $r2 = url()->current();
// $arr = array();
// $arr = explode("/",$r2);
// $edit = true;
// if ($arr[3] == 'addvoyage') {
//   $edit = false;
// }



//  @if ($edit)
//         <form method="POST" action="{{$arr[3]}}/" id="form" class="signup-form" enctype="multipart/form-data">
//       @else
//       <form method="POST" action="{{ route('added.post.show') }}" id="signup-form" class="signup-form" enctype="multipart/form-data">
//       @endif





// public function imageAdd(Voyage $voyage, Request $request)
// 	{
// 		request()->validate([
// 			'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
// 		]);

// 		$file = array();
// 		$files = request()->file('photo');
// 		foreach ($files as $file) {
// 			// get File name with extension 
// 			$filenameWithExt = $file->getClientOriginalName();
// 			// //get just the file name 
// 			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
// 			// //get extension 
// 			$extension = $file->getClientOriginalExtension();
// 			// //create new filename
// 			$filenameToStore = $filename . '_' . time() . '.' . $extension;
// 			$file->storeAs('public/' . $voyage->id, $filenameToStore);
// 			Voyage::find($voyage->id)
// 				->addMediaFromUrl('storage/' . $voyage->id . '/' . $filenameToStore)
// 				->preservingOriginal() //middle method
// 				->toMediaCollection(); //finishing method
// 		}
// 		SWAL::message('Bien', 'votre photo a été ajouté avec succès', 'success', ['timer' => 4000]);
// 		return redirect('voyages/' . $voyage->id);
		
// 	}





	// public function CheckImage( $id , Request $request)
    // {
	// 	$ids = $request->$id;
	// 	DB::table("media")->whereIn('id',explode(",",$ids))->delete();
	// 	return response()->json(['success'=>"Products Deleted successfully."]);
	// 	// \Spatie\MediaLibrary\Models\Media::where('model_id', $voyage->id)->delete();

	// }
	
	// public function CheckImage($id)
	// {
	// 	$ids = explode(',', $id);
	// 	foreach ($ids as $id) {
	// 		\Spatie\MediaLibrary\Models\Media::findOrFail($id)->delete();
	// 	}
	// }
