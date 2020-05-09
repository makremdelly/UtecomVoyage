<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Requests\SettingPostRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Softon\SweetAlert\Facades\SWAL;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Reservation;
use Session;
use \Illuminate\Support\Str;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $u = auth()->user()->id;
        $user=User::find($u);
        $counthotels = Hotel::all()->count();
        $countres = Reservation::all()->count();
        return view('setting')
            ->with([
                'user'      => $user,
                'hotels'     => $counthotels ,
                'reservations'    => $countres
                ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingPostRequest $request, $id)
    {
    
        $u = auth()->user()->id;
        $user=User::find($u);
        $user1=$user;
        $pic = $request->input('picture');
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $bool=0;

        if ($request->hasFile('picture')){
        // get File name with extension 
        $filenameWithExt = $request->file('picture')->getClientOriginalName();
        //get just the file name 
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get extension 
        $extension = $request->file('picture')->getClientOriginalExtension();
        //create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        //upload image 
        $path= $request->file('picture')->storeAs('public/img', $filenameToStore);
        $user->picture = $filenameToStore;
        $bool=1;
        
        $extarray= ['png','jpeg','jpg','avg','PNG','JPEG','JPG','AVG'];
            if (!(in_array($extension,$extarray))){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'picture' => ['Image invalide'],         
                    ]);
                    throw $error;
                    return back()->withErrors($error)->withInput();
            }
        }else{
            $user->picture = $user->picture ;
        }
        $password = auth()->user()->password;
        $password_old = $request->input('password');
        $password_new = $request->input('new_password');
        $hashednew = Hash::make($password_new);



        if (($user1->name === $request->input('name')) && 
        ($user1->email === $request->input('email')) && 
        ($user1->last_name === $request->input('last_name')) && 
        ($bool==0) && ($password_old === null)   ){
            SWAL::message('Bref','Y pas de changement','error',['timer'=>4000]);
            return redirect('/parametre');
        }
        else
        if (Hash::check($password_old,$password)==false && $password_old != null) 
            {   
            $error = \Illuminate\Validation\ValidationException::withMessages([
            'password' => ['Incorrecte ancienne mot de passe'],         
            ]);
            throw $error;
            return back()->withErrors($error)->withInput();
            }else{
                if ($password_new!=null){
                    $user-> password = $hashednew;
                    $user->save();
                    SWAL::message('Bien','votre changement a été effectuée avec succès','success',['timer'=>4000]);
                    return redirect('/parametre');
                }else{
                    $user->save();
                    SWAL::message('Bien','votre changement a été effectuée avec succès','success',['timer'=>4000]);
                    return redirect('/parametre');
                }
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
