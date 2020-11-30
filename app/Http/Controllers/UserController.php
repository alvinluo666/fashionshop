<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function getAuthUser(){
        if(Auth::check()){
            return response()->json(Auth::user(),200);
        }else{
            return response()->json('',200);
        }   
    }
    public function logout(){
        if(Auth::check()){
            Auth::logout();
     }
    }
}
