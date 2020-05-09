<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgrammePostRequest;
use Illuminate\Http\Request;
use Softon\SweetAlert\Facades\SWAL;
use App\Models\Programme;
use App\Models\Voyage;
use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ProgrammeController extends Controller
{
  function add(Request $request)
  {

    if ($request->ajax()) {

      $rules = array(
        'jour.*'  => 'required',
        'programme.*'  => 'required',
      );
      $error = Validator::make($request->all(), $rules);
      if ($error->fails()) {
        return response()->json([
          'error'  => $error->errors()->all()
        ]);
      }
      //   dd($request->jour);
      $Jour = $request->jour;
      $Programme = $request->programme;
      $Voyage = $request->get('voyage');
      // dd($Voyage);
      $insert_data = [];
      for ($count = 0; $count < count($Jour); $count++) {
        $data = new Programme(array(
          'Date' => $Jour[$count],
          'Programme'  => $Programme[$count],
          'voyage_id'  => $Voyage
        ));
        $data->save();
        $insert_data[] = $data;
      }
      //   Programme::insert($insert_data);
      return response()->json([
        'success'  => 'Data Added successfully.'
      ]);
    }
  }

  public function allprogrammes()
  {
    $programme = Voyage::select(
      [
        'programmes.*',
        'voyages.type',
      ]
    )
      ->join('programmes', 'voyages.id', '=', 'programmes.voyage_id')
      ->get()->toArray();
    // dd($programme);

    return datatables($programme)->toJson();
    //get all programmes
    $allprogramme = $this->getTrait();
    //count programmes
    $count = Programme::all()->count();
  }






  public function updateProgramm($id, Request $request)
  {
    $voyages = Voyage::find($id);
    $programme = Programme::where('voyage_id', '=', $id)->first();

    $programme->Date = $request->input('jour');
    $programme->Programme = $request->input('programme');
    $voyages->save();
    // SWAL::message('Bien', 'votre changement a été effectuée avec succès', 'success', ['timer' => 4000]);
    // return redirect('/parametre');
  }


  function showprog()
  {
    return view('showprogramme');
  }

  function fetch_data(Request $request)
  {
    $Voyage = $request->voyage_id;
    if ($request->ajax()) {
      $data = DB::table('programmes')->where('voyage_id',$Voyage)->orderBy('id', 'asc')->get();
      echo json_encode($data);

    }
  }

  function add_data(Request $request)
  {
    
    if ($request->ajax()) {
      $data = array(
        // 'jour'  => 'required',
        'programme'  => 'required',
      );
      // $Jour = $request->jour;
      $Programme = $request->programme;
      $Voyage = $request->voyage_id;

      $insert_data = [];
      $data = new Programme(array(
        // 'Date' => $Jour,
        'Programme'  => $Programme,
        'voyage_id'  => $Voyage

      ));
      // dd($Voyage);
      $data->save();
      $insert_data[] = $data;
    }
        // echo '<div class="alert alert-success">Data Inserted</div>';
      
    }








  function update_data(Request $request)
  {
    if ($request->ajax()) {
      $data = array(
        $request->column_name       =>  $request->column_value
      );
      DB::table('programmes')
        ->where('id', $request->id)
        ->update($data);
      // echo '<div class="alert alert-success">Data Updated</div>';
    }
  }

  function delete_data(Request $request)
  {
    if ($request->ajax()) {
      DB::table('programmes')
        ->where('id', $request->id)
        ->delete();
      echo '<div class="alert alert-success">Data Deleted</div>';
    }
  }
}