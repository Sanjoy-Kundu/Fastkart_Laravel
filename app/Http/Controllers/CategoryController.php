<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class CategoryController extends Controller
{
    //
    function index(){
        $categories = Category::latest()->get();
        $trashedCategory = Category::onlyTrashed()->latest()->get();
        return view('backend.category.categorylist', compact('categories','trashedCategory'));
    }

    //========adding form===========
    function add(){
        return view('backend.category.addcategory');
    }


    //==========category insert ===========
    function insert(Request $request){
        $request->validate([
            'category_name' => 'required || max:30 ||unique:categories,category_name',
            'category_description' => 'required',
            'category_image' => 'mimes:jpg,svg,png, jpeg,webp'
        ],[
            'category_name.required' => "Category Name is required",
            'category_description.required' => "Category Description is required",

        ]);

        $slug = Str::of($request->category_name)->slug('-');
       $category_id =  Category::insertGetId($request->except('_token') + [
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);


             //return $request->hasFile('category_image');
             if($request->hasFile('category_image')){
                $imageName = Str::random(20).".".$request->file('category_image')->extension();
                $image_path = "uploads/category_photos/$imageName";
                Image::make($request->file('category_image'))->save($image_path);


                //update database
                Category::find($category_id)->update([
                    'category_image' => $imageName
                ]);
                //update database
            }
return back()->withSuccess('Category Inserted Successfully');
    }





    //category edit
    function edit($category_id){
       $edit_info = Category::find($category_id);
        return view('backend.category.categoryedit', compact('edit_info'));
    }



    //update
    function update(Request $request, $category_id){


        if($request->hasFile('category_image')){
            //echo "Image ace";
           $category_db_image =  Category::find($category_id)->category_image;


           if($category_db_image != NULL){
            unlink(public_path('uploads/category_photos/').$category_db_image);
           }


            $imageName = Str::random(20).".".$request->file('category_image')->extension();
            $image_path = "uploads/category_photos/$imageName";
            Image::make($request->file('category_image'))->save($image_path);
            //image previous code copy and paste

            //database update start
                //update database
                Category::find($category_id)->update([
                    'category_image' => $imageName
                ]);
                //update database
            //database update end
           //return back();
        }
      Category::find($category_id)->update([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description
        ]);
        return back()->withSuccess('Category Updated Successfully');
    }




//==========delete===========
function delete($category_id){
Category::find($category_id)->delete();
return back()->withSuccess("Category Deleted succcessfully!");
}

//=========restore=======
function restore($category_id){
 // return $category_id;
  Category::onlyTrashed()->find($category_id)->restore();
  return back()->withTrashed("Category Restore Successfully");
}


//=======permanent delete======
function pdelete($category_id){
    Category::onlyTrashed()->find($category_id)->forceDelete();
    return back()->withTrashed("Category Permanent Delete Successfully");
}


}
