<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function index(){
        return view('backend.user.adduser');
    }

    function list(){
        return view('backend.user.userlist');
    }
}
