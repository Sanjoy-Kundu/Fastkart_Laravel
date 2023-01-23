<?php
/*
        ==================Product Entry ====================
        1. Akta product entry dewar somoy tar Name janan lagbe
            i. Product Name

        2. Product Price product price 3 dhoroner thakte pare
            ii. product making cost ==> 300(supose)
            ii. regular price ==> 350 taka
            iii. discount price ==> 400 taka
        product e koto take  lab holo (50) taka

        3.Poduct Description (Short Description)

        4.Product Descripiton (Long Descripton)

        5. Additonal Information

        6.Care Instructions

        7.Product thumbnail Photo -01

        8.Product Features Photo - multi
        ==================Product Entry end =================
        Product er kaj korar jonno amder ProductControlller lagbe + Model lagbe + migration lagbe + migration er maddhome amder sokol akj korte hobe

        ai sob gulo kaj amra commad er maddhome korbo sei command holo
        ***php  artisan make:model Product -mcr *****
        (m= migration, c= controller , r= resourcefull controller)
            resourcefull controller means
                1. insert form ====> insert (function/ method lagbe)
                2. to database insert ===> store (function/method database e data pathano)
                3. list show                ====> index (function/method list show korar jonno )
                4.product deatails  ======> show    (details dekhanor jonno show function use korbo)
                5.edit form  ============> edit    (edit korar jonno edit function use korbo)
                7. to edit     =============> update    (update korar joono update form user korbo)
                8. delete    ==============> destroy    (delete korar jonno destroy function use korbo )

            CRUD KORAR JOONO START
            php  artisan make:model Product -mcr
            CRUD KORAR JOONO END




=================web.php ==========================
            web.php te function or method gulo excess korar system
            amra chaile alada alada kore kore parbo
            or akshate korte parbo

            AMRA CHAILE SINGLE VABE LIKTE PARI
 Route::get('product', [ProductController::class, 'index'])->name('product.index'); //list show
Route::get('product/create',[ProductController::class, 'create'])->name('product.create'); //form show
Route::get('product/store', [ProductController::class, 'store'])->name('product.store'); //db store
Route::get('product/show', [ProductController::class, 'show'])->name('product.show');//info show korar jonno
Route::get('product/edit', [ProductController::class, 'edit'])->name('product.edit'); //form show korar jonno
Route::get('product.update', [ProductController::class, 'update'])->name('product.update');//update korar jonno
Route::get('product.destroy', [ProductController::class, 'destroy'])->name('product.destroy'); //delete korar jonno

ABAR CHAILE AMRA AK SHARE LIKTE PARI SEITA KE BOLE RESOURCEFULL CONTROLLER

Route::resource('product', ProductController::class);
and route chek korar jonno commad likbo
php artisan route:list






Akhon amder kaj hobe dashboard marste e giye product list.html ===> {{ route('product.index') }} likbo


product er sokol form add korlam
product er data je submit hobe seita kon route e hobe seita hobe route('product.store') ai route e
akhon store function er giye return request kore dekbo

Data insert korar jonno amder table create korte hobe migration eee giye

create_product_table e giye form er fill gulo fillup korlam and database e migrate korlam


=========================PRODUCT DISCOUNT CALCULATION ====================
amader product er form ee first e je jinish nite hobe seita hoilo
::::::::::: steps-01 ::::::::::::::
amra bolbo je (regular price 100 takay discount dibo 10%) akhon 10% e je 90 taka ase seita form er moddey dekhabe na seita dekhabe database eee tar jonno database e discount name akta field nibo.
DATABASE E discount koto hobe seitar output newar jonno discount_price name akta field nilam aita auto genarate hobe


:::::::::::::steps-02 :::::::::::::
NEXT :: amder discout check korte hobe je discoutn field e koto perset discoutn dibe orthat jodi discount file fillup   thake tahole bolo je discount ace r naile bolo discoutn nai

    if($request->product_discount_price){
    echo "discount ace";
    }else{
        echo "discount nai";
    }
akhon jodi discount na dey tahole ki hobe
databaser e discount dwar por je taka ase tar field ke dhorte hobe and jehetu discount nai
tai sei field ee regular price ja ace tai hobe
orthat
  if($request->product_discount_price){
    echo "discount ace";
    }else{
        echo "discount nai";
        $discount_price = $request->regular_product_price;
    }


    ::::::::::steps-03 :::::::::
                            jodi discount thake tahole discount hobe kisher upore seita khail korte hobe
                            discount hobe regular price er upor eee
aita holo discout taka
             $request->regular_price *($requst->discount_price / 100);
akhon amay ber korte hobe je discount bade koto taka ase
regular price theke discount korte koto taka ase seita bad dite hobe ;
  if($request->product_discount_price){
    echo "discount ace";
    $discount_price = ($request->regular_product_price * ($request->product_discount_price / 100)); //discount taka
    $discount_price = $request->regular_product_price - ($request->regular_product_price * ($request->product_discount_price / 100)); //discount bade koto taka ase;
    }else{

    }


Product er database e Features photo dhukbe na feacture photo er jonno amader alada database create kora lagbe




::::::::::::::::::::::::::::::::::::PRODUCT TA KE UPLOAD DICI KINA  SEITA DEKHAR JONNO ::::::::::::::::::::::::::::::::::::::::::::::::::::::
akhon vendor hoitece pran company orthat vendor onek gulo product upload korbe pran 10 ta product  upload korce sei 10 ta product dekhar jonno amder pran orthat vendor er id lagbe. akhon sei vendor orthat pran er id ace users table e sei table theke product table e id niye asar rules ki ?

tar joono ander product table e user_id name akta field nilam and ai field ei verndor er id dibo
akn ai vendor er id pabo auth()->id "users_id" => auth()->id() thkeke je product add korbe tar nam pabo

Product Image Detai hobe tai amder validation lagbe na

=======================================================
Product Thumbnail Image Upload dewar jonnno
=========================================================
    public function store(Request $request)
    {
      $product_thumbnail_name = auth()->id().'-'.'product'.'-'.Str::lower(Str::random(20)).'.'.$request->file('product_thumbnail')->extension();

      $product_image_path = 'uploads/products_photos/'.$product_thumbnail_name;
       // return $request->file('product_thumbnail');
       Image::make($request->file('product_thumbnail'))->resize(300, 200)->save($product_image_path);

       die()

    }

==============================
    akhon ai code ke amra return back er age paste korbo and and database e update janiye dibo
======================================
          //return $product_id;
        // Product thumbnai photo upload start
        $product_thumbnail_name = auth()->id().'-'.'product'.'-'.Str::lower(Str::random(20)).'.'.$request->file('product_thumbnail')->extension();
        $product_image_path = 'uploads/products_photos/'.$product_thumbnail_name;
         // return $request->file('product_thumbnail');
         Image::make($request->file('product_thumbnail'))->resize(150, 200)->save($product_image_path);
        // Product thumbnai photo upload end

        //database update start
        Product::find($product_id)->update([
            'product_thumbnail' => $product_thumbnail_name
        ]);
       // database update end
        return back()->withSuccess("Product Inserted Successfully");


 ======================================================

 ==========================
 FEATURES PHOTOS UPLAOD SYSTEM
===================================================================
Features photo te amader akadhik image thakte pare sei image guloke amader alada kore rakhar jonno amader alada akta migration kora lagbe and model lagbe ja maddhome amra database new file khule rakte pari.

::::::::::::::::::::::::::::::::::::::::::::::::::Steps:01:::::::::::::::::::::::::::::::::::
 model + migration table  banabo
 php artisan make:model Featured_photo -m


 ::::::::::::::::::::::::::::::::::::::Steps:02:::::::::::::::::::::::::::::::::::::::::::
 jehetu featured photo amra banabo tai each featured photo kono na kono product er sathe connect thakete hobe r connect thakbe product er id dara. tai name dilam product_id ==> integer

 and featured photo name dite hobe featured_photo_name
 jar dara ami dhorte pari ke konta
 ================== php artisan migrate kore dibo =================




 :::::::::::::::::::::::::::::::::::::::Steps:03:::::::::::::::::::::::::::::::::
 Akhon amra featured photo niye upload er kaj korbo kothey ProductController er moddey karon featured photo hoitece product er tai kaj aikhane kora lagbe
 tai kaj korar purbe sokol code comment kore nibo


 :::::::::::::::::::::::::::::::::Steps:4::::::::::::::::::::::::::::::::::::::::::
Jehetu featured photo niye kaj kobo tai amder mathay rakte hobe featured photo ak ba akadhik thakte para tai amader input file er oikhane giye amder kicu kotha likte hobe seigulo holo
muliple photo chose korar jonno amader input field ee likte hobe multiple
and jokhoni ami aker odik file ke add korbo tokhon name er pase arraykore dibo

as like as:::
<input class="form-control" type="file" name="product_features_photo"> to ==>
<input class="form-control" type="file" name="product_features_photo[]" multiple>

akhon amder output dekhanor jonno
  return $request->product_features_photo; aita dekbo je koyta array aschy. jei koyta image select korbo sei koyta array asbe


  ::::::::::::::::::::::::::::::::::::::::::::Steps:5 ::::::::::::::::::::::::::::::::::::::
  akhon jehetu akta array asche tai amder array er upor foreach chalaiye akta akta kore show korate hobe
      //return $request->product_features_photo;
        foreach($request->product_features_photo as $single_features_photo){
            echo $single_features_photo;
        }

        Output hishebe asbe C:\Users\Sonjoy\AppData\Local\Temp\php5065.tmp aita dekhaile to hobe na amader image er nam dekhaite hobe . tar jonno
Ai gula korte hobe
       //FEATURED IMAGE START
     // return $request->file('product_features_photo[');
      //return $request->product_features_photo;
      //foreach start
        foreach($request->product_features_photo as $single_features_photo){
          $feature_image_name = $product_id."Features_photo".Str::lower(Str::random(20)).".".$single_features_photo->extension();
          $features_image_path = 'uploads/features_photos/'.$feature_image_name;
        Image::make($single_features_photo)->resize(150, 200)->save($features_image_path);

        //database insert start
        Featured_photo::insert([
            'product_id'=>$product_id,
            'featured_photo_name' => $feature_image_name,
            'created_at' => Carbon::now()
        ]);
        //database insert end
        }
        //foreach end
       return back()->withSuccess("Product Inserted Successfully");

*/
?>
