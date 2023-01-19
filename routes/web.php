<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//FrontendController
Route::get('/', [FrontendController::class, 'index']);



/* Route::get('/', [BackendController::class, 'index']); */
Route::get('dashboard', [BackendController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */


//CATEGORY
Route::get('category/list', [CategoryController::class, 'index']);
Route::get('category/add', [CategoryController::class, 'add']);
Route::post('category/insert', [CategoryController::class, 'insert']);
Route::get('category/edit/{category_id}', [CategoryController::class, 'edit']);
Route::post('category/update/{category_id}', [CategoryController::class, 'update']);
Route::get('category/delete/{category_id}', [CategoryController::class, 'delete']);
Route::get('category/restore/{category_id}', [CategoryController::class, 'restore']);
Route::get('category/permanent/delete/{category_id}', [CategoryController::class, 'pdelete']);




//PRODUCT
Route::resource('product', ProductController::class);
/* Route::get('product', [ProductController::class, 'index'])->name('product.index'); //list show
Route::get('product/create',[ProductController::class, 'create'])->name('product.create'); //form show
Route::get('product/store', [ProductController::class, 'store'])->name('product.store'); //db store
Route::get('product/show', [ProductController::class, 'show'])->name('product.show');//info show korar jonno
Route::get('product/edit', [ProductController::class, 'edit'])->name('product.edit'); //form show korar jonno
Route::get('product.update', [ProductController::class, 'update'])->name('product.update');//update korar jonno
Route::get('product.destroy', [ProductController::class, 'destroy'])->name('product.destroy'); //delete korar jonno */




//USER
Route::get('user/add', [UserController::class, 'index']);
Route::get('user/list', [UserController::class, 'list']);
Route::post('user/insert', [UserController::class, 'insert']);



//Profile
Route::get('profile/index', [ProfileController::class, 'index']);
Route::post('profile/photo', [ProfileController::class, 'photoChange']);
Route::post('profile/password/change', [ProfileController::class, 'passwordChange']);



//Github
Route::get('github/redirect', [GithubController::class, 'index']);
Route::get('github/callback', [GithubController::class, 'callback']);


//google
Route::get('google/redirect', [GoogleController::class, 'index']);
Route::get('google/callback', [GoogleController::class, 'callback']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
