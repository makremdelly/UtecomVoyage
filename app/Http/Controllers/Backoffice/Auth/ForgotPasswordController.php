<?php

namespace App\Http\Controllers\Backoffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use Illuminate\Http\Request;


use App\Role;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email',$email)->first();
        if($user->hasRole('Administrator')){
            
        $this->middleware('guest');

        }else{
            \Session::flush();
            abort(403);
    }
}}





  // if ($user != null) {
        //     dd('email does not exist');
        // }else{
        //     if ($user->hasRole('Administrator')) {
                
        //     }else{
        //         $this->middleware('guest');
        //     }
        // }


// $user->hasRole('Administrator')
