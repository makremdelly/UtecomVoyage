<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use DB, Hash, Mail;
use App\PasswordReset;
use App\Models\Api\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\PasswordResetRequest;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *   path="/login",
     *   summary="API Login",
     *   tags={"Auth"},
     *   security={{"x-api-key": {}}},
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="API Authentification Success",
     *   )
     * )
     */
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken('Bearer '.$token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    /**
     * @OA\Post(
     *   path="/me",
     *   summary="API Me",
     *   tags={"Auth"},
     *   security={{"api_token": {}}},
     *   @OA\Response(
     *     response=200,
     *     description="API Get Authenticated User Success"
     *   )
     * )
     */
    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * @OA\Post(
     *   path="/logout",
     *   summary="API Logout",
     *   tags={"Auth"},
     *   security={{"api_token": {}}},
     *   @OA\Response(
     *     response=200,
     *     description="API Logout Success"
     *   )
     * )
     */
    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Déconnecté']);
    }

    /**
     * @OA\Post(
     *   path="/refresh",
     *   summary="API Refresh",
     *   tags={"Auth"},
     *   security={{"api_token": {}}},
     *   @OA\Response(
     *     response=200,
     *     description="API Token Refresh Success"
     *   )
     * )
     */
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    /**
     * @OA\Post(
     *   path="/register",
     *   summary="API Register",
     *   tags={"Auth"},
     *   security={{"x-api-key": {}}},
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="API Registeration Success"
     *   )
     * )
     */
    /**
     * API Register
     *
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $name = $request->name;
        $email = $request->email;

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($request->password);

        $activation_token = str_random(64);
        $user->activation_token = $activation_token;
        $user->save();

        $subject = "Hotel PMS - Confirmation de compte";
        Mail::send('email.verify', ['name' => $name, 'activation_token' => $activation_token],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), 'admin@pms.fr');
                $mail->to($email, $name);
                $mail->subject($subject);
            });
        $message = "Merci pour votre inscription ! Vérifiez votre boite email pour terminer l'inscription.";
        return response()->json(['success'=> true, 'message'=> $message, 'activation_token' => $activation_token]);
    }

    /**
     * @OA\Post(
     *   path="/verify",
     *   summary="API Verify",
     *   tags={"Auth"},
     *   security={{"x-api-key": {}}},
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="activation_token",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="API Registeration Success"
     *   )
     * )
     */
    /**
     * API Register
     *
     * @param String $activation_token
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $activation_token = $request->activation_token;
        $user = User::where('activation_token', $activation_token)->first();
        if(!is_null($user)){
            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Ce compte est déjà vérifié.'
                ]);
            }
            $user->update(['is_verified' => 1]);
            $user->update(['activation_token' => null]);
            return response()->json([
                'success'=> true,
                'message'=> 'Adresse email vérifié avec succés.'
            ]);
        }
        return response()->json(['success'=> false, 'error'=> "Code de vérification invalide"]);
    }

    /**
     * @OA\Post(
     *   path="/reset-password-token",
     *   summary="API Reset Password Token",
     *   tags={"Auth"},
     *   security={{"x-api-key": {}}},
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="API Reset Password Token Success"
     *   )
     * )
     */
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPasswordToken(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            $error_message = "Adresse email inexistante";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }
        $name =$user->name;
        $token = str_random(64);
        $passwordReset = new PasswordReset();
        $passwordReset->email = $email;
        $passwordReset->token = $token;
        $passwordReset->save();
        $subject = "Hotel PMS - Réinitialisation Mot de Passe";
        Mail::send('email.reset', ['name' => $name, 'token' => $token],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), 'admin@pms.fr');
                $mail->to($email, $name);
                $mail->subject($subject);
        });

        $message = "Veuillez vérifiez votre boite email pour réinitialiser le mot de passe.";
        return response()->json(['success'=> true, 'message'=> $message, 'token' => $token]);
    }

    /**
     * @OA\Post(
     *   path="/reset-password",
     *   summary="API Reset Password",
     *   tags={"Auth"},
     *   security={{"x-api-key": {}}},
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="token",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="API Reset Password Success"
     *   )
     * )
     */
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(PasswordResetRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if(!is_null($passwordReset))
        {
            $user = User::where('email', $passwordReset->email)->first();
            $user->password = Hash::make($request->password);
            $user -> save();
            PasswordReset::where('token', $request->token)->delete();
            return response()->json([
                'success'=> true,
                'message'=> 'Mot de passe changé avec succés.'
            ]);
        }
        return response()->json(['success'=> false, 'error'=> "Token Expiré."]);
    }
}
