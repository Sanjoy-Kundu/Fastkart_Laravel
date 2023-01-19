<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreation;
use Illuminate\Support\Facades\Auth;


class GithubController extends Controller
{
    //
    function index(){
        return Socialite::driver('github')->redirect();
    }


    function callback(){
        $user = Socialite::driver('github')->user();
       // print_r($user);
       $genarate_password = Str::random(8);
       User::insert([
           'name' => $user->getName(),
           'email' => $user->getEmail(),
           'password' => bcrypt($genarate_password),
           'created_at' => Carbon::now(),
           'role' => 'customer'
       ]);

      /*   Auth::attempt([
            'email' => $user->getEmail(),
            'password' =>  $genarate_password
        ]); */

        if( Auth::attempt([
            'email' => $user->getEmail(),
            'password' =>  $genarate_password
        ])){

            $info = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'role' => 'customer',
                'password' => $genarate_password
            ];

            Mail::to($user->getEmail())->send(new AccountCreation($info));

            return redirect('dashboard');
    }

}

}
