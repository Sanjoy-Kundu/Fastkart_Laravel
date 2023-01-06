<?php


1. first e UserController ee giye form theke [name, email, password, role dhorbo]

2. mail pathanor  jonno maitrap e jabo sikhan thekhe php 7+ select kore code copy paste korbo

3. laravel.com ==> search ==> mail ==> sending mail ee click korbo and kicu steps amade follow korte hobe

    step-01 , mail er jonno name genaret korte hobe  (php artisan make:mail OrderShipped) aita dewa ace amra toyri korbo
                   ( php artisan make:mail AccountCreation)  ai name
    command eee amy location bole dibe je laravel\fastkart\app\Mail\AccoutntCreation.php created successfully


    step-02,  Akhon account creation er moddey jabo and Envelop likbo laravel documention er code dekhe.  and content er    moddey akta blade file banabo . and sei blade file ee ja likbo tai email e pathabe .


    step-03 , mail send korar jonno amder je code lagbe seita amra laravel documentation ei dekte pabo .

                laravel documentation ee sending mail e jabo and last e akta code lekha ace seita dekbo
                code is == Mail::to($request->user())->send(new OrderShipped($order));
                replace code is == Mail::to($request->user())->send(new AccountCreation());
                just ai code amra UserController e likbo



                akhon parameter er maddhome data pas korbo tar jonno akta array er moddey amr je info gulo dorkar hobe seigulo likbo
                    $info = [
                        'name' => $request->name,
                        'email' => $request ->email,
                        'role' => $request ->role,
                        'password' => $makePassword
                        ];
                sending code Mail::to($request->user())->send(new AccountCreation($info));



                akhon fist amra laravel documentation ee jabo next jabo via the next Parameter
                AccountCreation ee jabo
                public $information; //jekono name akta variable nibo
                public function __construct($info) //ai info hoitece sei array
                {
                    //
                    $this->information = $info;  //documentation dekhe $this nibo information nibo = sei arrayke nibo
                }
                aitar output dekar jonno amra creation.blade.php te jabo next
                print_r($information) korbo korle mailtrap ee amr information jabe





                Email er maddhome amara ja dekbo ta dekar jonno
                //Bellow This code
                //source: resource ==> backend ===> mail ==> creation.blade.php
                <body>
                {{--  <p>{{ print_r($information) }}</p> --}}
                <h1>Wellcome to FastKart</h1>
                <h2>Name: {{ $information['name'] }}</h2>
                <h3>Email: {{ $information['email'] }}</h3>
                <h3>Password: {{ $information['password'] }}</h3>
                <h4>Role: {{ $information['role'] }}</h4>
            </body>






//PASSWORD CHANGE
Steps-01 :
password change korar jonno at first amay current password ke change dhorte hobe . database er password and   current input field er password ke milaite hobe.


    public function passwordChange(Request $request){
            $request->validate([
                'current_password' => 'required',
                'password' => 'required || min:8',
                'confirm_password' => 'required || min:8'
            ],[
                'current_password.required' => 'Current password is required',
                'password.required' => "New  password is required",
                'new_password.min' => "Password minimum 8 characters",
                'confirm_password.required' => "Confirm password is required"
            ]);
            return $request->current_password; //current  password
            return auth()->user()->passowrd;      //database password
            }

Steps-02
akhon amder current password and database er passowrd milaite hobe. ai jonno amder if use kora jabe an amder laravel ei bole dibe laravel er documentation ee giye dekho password matching korar jonno se ki bole

                GOOLE ==> Laravel password check ==> Verifying That A Password Matches A Hash
                Hash::check('plain-text', databasePassword)


                new password and current password milanor jonno amder laravel.com ee jete hobe  next search korbo validation likhe
                find korbo confirm likhe next documentation dekhe code korbo

                new password name  == passowrd
                confirm password name == password_confirmation
                dibo


                akhon amy check korte hobe je amar database er password er sathe ki ami jei password likbo seita thik ace ki na.

                if(Hash::check($request->current_password, auth()->user()->password)){
                    echo "password milse";
                }else{
                    echo "password mile nai";
                }




                Route list dekhar jonno php artisan route:list








?>
