<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        if($request->product_discount_price){
            //echo "discount ace";
            //$discount_price = $request->regular_product_price * ($request->product_discount_price / 100);
            $discount_price = $request->regular_product_price -  ($request->regular_product_price * ($request->product_discount_price / 100));
        }else{
            //echo "discount nai"; discount na thake hobe product er regular price
            $discount_price = $request->regular_product_price;
        }
        //echo $discount_price;
        Product::insert([
            'category_id'=>$request->category_name,
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
            'product_features_photo'=>$request->product_features_photo,
            'created_at'=>Carbon::now(),
        ]);
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
