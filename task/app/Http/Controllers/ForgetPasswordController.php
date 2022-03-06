<?php

namespace App\Http\Controllers;

use App\Mail\resetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
  
    public function sendToken(Request $request){
        $validateData = $request->validate([
            'email' => ['required'],
         ]);
        $user = User::where('email',$request->email)->first();
       if(!isset($user->id)){
           return response()->json(['errors'=>['email'=>['this user is\'t registerd before']]],401);
              };
              $token = Str::random(8); ;
        Mail::to($user)->send(new resetPasswordMail($token));
  
        $passwordReset = new PasswordReset();
        $passwordReset->email = $user->email;
        $passwordReset->token = $token;
        $passwordReset->save();
      }
  
      public function validate_token(Request $request){
          $passwordReset = PasswordReset::where('token',$request->token)->first();
          if(!isset($passwordReset->email)){
              return response()->json(['errors'=>['token'=>['token invalid']]],401);
          }
          $user = User::where('email',$passwordReset->email)->first();
          return response()->json($user,200);
      }
      
      public function resetPassword(Request $request){
        $validateData = $request->validate([
            'password' => ['required'],
         ]);
          $user = User::find($request->user_id)->first();
          $passwordReset = PasswordReset::where('email',$user->email)->first();
          $passwordReset->delete();
          $user->password = bcrypt($request->password);
          $user->save();
        }


        public function validate_customer(Request $request){
            $validateData = $request->validate([
                'token' => ['required'],
             ]);
            $passwordReset = PasswordReset::where('token',$request->token)->first();
            if(!isset($passwordReset->email)){
                return response()->json(['errors'=>['token'=>['token invalid']]],401);
            }
            $user = User::where('email',$passwordReset->email)->first();
            $passwordReset->delete();
            $user->email_verified_at = date("Y-m-d h:i:sa");
            $user->save();
            return response()->json($user,200);
        }
}
