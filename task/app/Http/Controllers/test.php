<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class test extends Controller
{
    public function AllUsers(){
         $user = User::all();
         return response()->json($user);
    }
}
