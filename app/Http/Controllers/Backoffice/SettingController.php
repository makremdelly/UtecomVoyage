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
use App\Models\Voyage;
use Session;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



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
        // $users = User::select(
        //     [
        //         'users.*',
        //         'model_has_roles.role_id',
        //         'roles.name as role_name'
        //     ]
        // )
        //     ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //     ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //     ->where('model_type', '=', 'App\Models\User')
        //     ->where('roles.name', '=', 'Administrator')
        //     ->get()->toArray();
        // dd($users);

        $arr = array();

        $u = auth()->user()->id;
        $user = User::find($u);
        $counthotels = Hotel::all()->count();
        $countres = Reservation::all()->count();
        $voyages = Voyage::all()->count();
        $user_has_role = DB::table('model_has_roles')
            ->select('model_type', 'model_id', 'role_id', 'roles.name')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_type', '=', 'App\Models\User')
            ->where('roles.name', '=', 'Administrator')
            ->get();


        foreach ($user_has_role as $user_role) {
            array_push($arr, $user_role->model_id);
        }
        // dd($arr);
        $userRole = User::find($arr)->count();
        // dd($userRole);

        return view('setting')
            ->with([
                'user'      => $user,
                'hotels'     => $counthotels,
                'reservations'    => $countres,
                'voyages'    => $voyages,
                'admin'    => $userRole,
                // 'users'      => $users,

            ]);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'image|mimes:jpg,png,avg,jpeg,| max:1000',
        ]);
    }
    protected function create(Request $data)
    {
        if ($data->hasFile('image')) {
            $file = $data->file('image');
            // get File name with extension 
            $filenameWithExt = $file->getClientOriginalName();
            // dd($filenameWithExt);
            //get just the file name 
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get extension 
            $extension = $data->file('image')->getClientOriginalExtension();
            //create new filename
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            //upload image 
            $path = $data->file('image')->storeAs('public/img', $filenameToStore);
        } else {
            $filenameToStore = NULL;
        }
        $user = DB::table('users')->where('email', $data['email'])->first();
        // dd($user);
        if (!$user) {
            User::create([
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'picture' => $filenameToStore,
            ])->assignRole('Administrator');
            SWAL::message('Bien', 'votre hotel a été ajouté avec succès', 'success', ['timer' => 4000]);
            return redirect('parametre/');
        }
        if ($user) {
            SWAL::message('Erreur', 'E-mail déjà existe, essayez un autre e-mail', 'warning', ['timer' => 8000]);
            return redirect('parametre/');
        }
    }

    public function alladmins()
    {
        $admins = User::select(
            [
                'users.*',
                'model_has_roles.role_id',
                'roles.name as role_name'
            ]
        )
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_type', '=', 'App\Models\User')
            ->where('roles.name', '=', 'Administrator')
            ->get()->toArray();
        // dd($admins);
        return datatables($admins)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createe()
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
        $user = User::find($u);
        $user1 = $user;
        $pic = $request->input('picture');
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $bool = 0;

        if ($request->hasFile('picture')) {
            // get File name with extension 
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            //get just the file name 
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get extension 
            $extension = $request->file('picture')->getClientOriginalExtension();
            //create new filename
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            //upload image 
            $path = $request->file('picture')->storeAs('public/img', $filenameToStore);
            $user->picture = $filenameToStore;
            $bool = 1;

            $extarray = ['png', 'jpeg', 'jpg', 'avg', 'PNG', 'JPEG', 'JPG', 'AVG'];
            if (!(in_array($extension, $extarray))) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'picture' => ['Image invalide'],
                ]);
                throw $error;
                return back()->withErrors($error)->withInput();
            }
        } else {
            $user->picture = $user->picture;
        }
        $password = auth()->user()->password;
        $password_old = $request->input('password');
        $password_new = $request->input('new_password');
        $hashednew = Hash::make($password_new);



        if (($user1->name === $request->input('name')) &&
            ($user1->email === $request->input('email')) &&
            ($user1->last_name === $request->input('last_name')) &&
            ($bool == 0) && ($password_old === null)
        ) {
            SWAL::message('Bref', 'Y pas de changement', 'error', ['timer' => 4000]);
            return redirect('/parametre');
        } else
        if (Hash::check($password_old, $password) == false && $password_old != null) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'password' => ['Incorrecte ancienne mot de passe'],
            ]);
            throw $error;
            return back()->withErrors($error)->withInput();
        } else {
            if ($password_new != null) {
                $user->password = $hashednew;
                $user->save();
                SWAL::message('Bien', 'votre changement a été effectuée avec succès', 'success', ['timer' => 4000]);
                return redirect('/parametre');
            } else {
                $user->save();
                SWAL::message('Bien', 'votre changement a été effectuée avec succès', 'success', ['timer' => 4000]);
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
        // DB::table('model_has_roles')
        //     ->where('model_id', $id)
        //     ->delete();

        User::destroy($id);
    }
}
