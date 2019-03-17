<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function checkUser(){
        if(Auth::check()){
            return response()->json(['status' => 1, 'user' => Auth::user()]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
}
