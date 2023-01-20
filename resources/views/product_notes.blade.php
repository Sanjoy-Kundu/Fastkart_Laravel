<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>product notes</title>
</head>

<body>
    <!-------------
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



        ---------->
</body>

</html>
