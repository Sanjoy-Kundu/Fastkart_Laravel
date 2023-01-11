<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;

class GithubController extends Controller
{
    //
    function index(){
        return Socialite::driver('github')->redirect();
    }


    function callback(){
        $user = Socialite::driver('github')->user();
        print_r($user);
    }
}
