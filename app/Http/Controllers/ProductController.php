<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Featured_photo;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.product_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = Category::all();
        return view('backend.products.add_product', compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'category_name'=> "required",
        //     "product_name" => 'required',
        //     "purches_product_price" => 'required',
        //     "regular_product_price" => 'required',
        //     "product_discount" => 'required',
        //     "short_description" => 'required',
        //     "long_description" => 'required',
        //     "additonal_information" => 'required',
        //     "care_instruction" => 'required',
        //     "product_thumbnail" => 'required || mimes:jpg,bmp,png, svg, jpeg'
        // ],
        // [
        //     'category_name.required' => "Please select one Category",
        //     'product_name.required' => "Product name is required",
        //     'purches_product_price.required' => "Purches Price is required",
        //     'regular_product_price.required' => "Regular price is required",
        //     'product_discount.required' => "Product discount is required",
        //     'short_description.required' => "Short Description field is required",
        //     'long_description.required' => "Long Description field is required",
        //     'additonal_information.required' => "Additional Information field is required",
        //     'care_instruction.required' => "Care Instruction field is required",
        //     'product_thumbnail.required' => "Product Thumbnail is required",
        //     'product_thumbnail.mimes' => "Photo Extension must be jpg, svg, png, bmp, jpeg",

        // ]);



        if($request->product_discount_price){
            //echo "discount ace";
            //$discount_price = $request->regular_product_price * ($request->product_discount_price / 100);
            $discount_price = $request->regular_product_price -  ($request->regular_product_price * ($request->product_discount_price / 100));
        }else{
            //echo "discount nai"; discount na thake hobe product er regular price
            $discount_price = $request->regular_product_price;
        }
        //echo $discount_price;
       $product_id =  Product::insertGetId([
            'category_id'=>$request->category_name,
            "users_id" => auth()->id(),
            'product_name'=>$request->product_name,
            'purches_product_price'=>$request->purches_product_price,
            'regular_product_price'=>$request->regular_product_price,
            'product_discount'=>$request->product_discount_price,
            'discount_price'=>$discount_price,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'additonal_information'=>$request->additonal_information,
            'care_instruction'=>$request->care_instruction,
            'product_thumbnail'=>$request->product_thumbnail,
            'created_at'=>Carbon::now(),
        ]);

        //return $product_id;


        // Product thumbnai photo upload start
        $product_thumbnail_name = auth()->id().'-'.'product'.'-'.Str::lower(Str::random(20)).'.'.$request->file('product_thumbnail')->extension();
        $product_image_path = 'uploads/products_photos/'.$product_thumbnail_name;
         // return $request->file('product_thumbnail');
         Image::make($request->file('product_thumbnail'))->resize(200, 200)->save($product_image_path);
        // Product thumbnai photo upload end

        //database update start
        Product::find($product_id)->update([
            'product_thumbnail' => $product_thumbnail_name
        ]);
       // database update end

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
    }










    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
