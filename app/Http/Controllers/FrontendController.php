<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //

    function index(){
        $all_categories = Category::all();
        return view('frontend.index', compact('all_categories'));
    }


}
