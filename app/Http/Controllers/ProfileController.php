<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index(){
        return view('backend.profile.profile');
    }




    //PROFILE PHOTO CHANGE CO
    public function photoChange(Request $request){
        $current_id = auth()->user()->id;
       // return $request;
      // return $request->profile_name;
      if($request->hasFile('profile_photo')){
        $db_image_name = User::find($current_id)->profile_photo;

        if($db_image_name != NULL){
           // echo  asset('uploads/user_photos/').$db_image_name;echo "change";
       unlink(public_path('uploads/user_photos/').$db_image_name);
        }

         $imageNewName = Str::lower(Str::random(20)).".".$request->file('profile_photo')->extension();
         $imagePath = 'uploads/user_photos/'.$imageNewName;
        Image::make($request->file('profile_photo'))->save($imagePath);

        //database update start
        User::find($current_id)->update([
            'profile_photo' => $imageNewName
        ]);
        //database update end
      }

       User::find($current_id)->update([
        'name' => $request->profile_name
       ]);
       return back();
    }






//PROFILE PASSWORD CHANGE CORNER

    public function passwordChange(Request $request){

        $request->validate([
            '*' => 'required'
   
        ]);
          //  echo  $request->current_password;
           // echo  auth()->user()->password;

            if(Hash::check($request->current_password,  auth()->user()->password)){
                echo "password milse";
            }else{
                return back()->withError("Password does't match");
            }
    }




}
