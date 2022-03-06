<?php

namespace App\Http\Controllers;

use App\Mail\resetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login','signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $validateData = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);



        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['errors'=>['email'=>['email or paswswword are invalid']]], 401);
        }

        $user = User::where('email',$request->email)->first();
        if($user->hasVerifiedEmail()){
            return $this->respondWithToken($token);
        }else{
            return response()->json(['errors'=>['email'=>['user not verified yet']]], 401);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function signup(Request $request){
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
         ]);
   
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['is_admin'] = $request->is_admin;
        $data['password'] = Hash::make($request->password);
        DB::table('users')->insert($data);
   
        return response()->json($data);
   
   
   
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
            'expires_in' => auth()->factory()->getTTL() * 60,
             'name' =>auth()->user()->name,
             'user_id' =>auth()->user()->id,
             'email' =>auth()->user()->email,
             'is_admin' =>auth()->user()->is_admin,
        ]);
    }

}
