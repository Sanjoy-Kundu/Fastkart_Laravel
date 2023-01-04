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


?>
