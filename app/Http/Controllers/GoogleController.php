<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    //
    function index(){
        return Socialite::driver('google')->redirect();
    }


    function callback(){
        $user = Socialite::driver('google')->user();
        //print_r($user);
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
