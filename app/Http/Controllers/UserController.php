<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
//mail
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreation;


class UserController extends Controller
{
    //
    function index(){
        return view('backend.user.adduser');
    }

    function list(){
        $users = User::latest()->get();
        return view('backend.user.userlist', compact('users'));
    }





    function insert(Request $request){
         $request->validate([
            'name' => 'required || max:30',
            'email' => 'required',
            'role' => 'required'
         ],
        [
            'name.required' => "Name field is required",
            'email.required' => "Email field is required",
            'role.required' => 'Please Select One'
        ]);

         $makePassword = Str::upper(Str::random(8));
         $user_id = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($makePassword),
            'created_at' => Carbon::now(),
            'role' => $request->role
         ]);


         //return $request->file('user_photo');
         if($request->hasFile('user_photo')){
            $user_photo_name =  Str::lower(Str::random(20)).'.'.$request->file('user_photo')->extension();
             $photo_path = 'uploads/user_photos/'.$user_photo_name;
           Image::make($request->file('user_photo'))->save($photo_path);

           //database
           User::find($user_id)->update([
            'profile_photo' => $user_photo_name
           ]);
        }
            //email working start
            /* echo $request->name;
            echo $request->email;
            echo $makePassword;
            echo $request->role; */
            //email working end
            $info = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => $makePassword
            ];

            Mail::to($request->user())->send(new AccountCreation($info));
           return back()->withSuccess("User Information Create Successfully!");

    }
}
