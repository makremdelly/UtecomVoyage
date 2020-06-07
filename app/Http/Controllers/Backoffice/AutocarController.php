<?php
namespace App\Http\Controllers\Backoffice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\URL;
use App\Models\Autocar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;
use App\Models\Voyage;
use Softon\SweetAlert\Facades\SWAL;


class AutocarController extends Controller
{
    
    function AddAutocar(Request $request)
    {
     if($request->ajax())
     {
      $rules = array(
       'type.*'  => 'required',
       'nbplace.*'  => 'required',
       'matricule.*'  => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }
    //   dd($request->jour);

      $type = $request->type;
      $nbplace = $request->nbplace;
      $matricule = $request->matricule;
      $insert_data=[];
      for($count = 0; $count < count($type); $count++)
      {
       $data = new Autocar( array(
        'type' => $type[$count],
        'NbPlace'  => $nbplace[$count],
        'Matricule'  => $matricule[$count],
        'status'  => 'disponiblé'

       ));
       
       $data->save();
       $insert_data[] = $data;

 
      }

    //   SWAL::message('Bien', 'votre autocar a été ajouté avec succès', 'success', ['timer' => 4000]);
    //   return redirect('/autocars');

    //   Programme::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
     }
    }
    public function allautocars()
    {
        $autocars = Autocar::select(
            [
                'autocars.*',
                // 'voyages.depart',
            ]
            )
            // ->LeftJoin('voyages', 'voyages.id', '=', 'autocars.voyage_id')

            ->get()->toArray();
        
        //  dd($autocars); 	
       
		return datatables($autocars)->toJson();
		
		//get all autocars
		$allautocar = $this->getTrait();
		//count autocars
		$count = Autocar::all()->count();

    }
    function addAutocars()
	{
		return view('addautocar');
	}

}
