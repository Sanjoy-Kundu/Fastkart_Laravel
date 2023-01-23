<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //

    function index(){
        $all_categories = Category::all();
        $all_products = Product::all();
        return view('frontend.index', compact('all_categories', 'all_products'));
    }


}
