<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\COntrollers\ReviewController;
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

Route::get('/', function () {
    return view('home');
});
Route::get('/home',function(){
    return redirect('/');
});
Route::get('/men',function(){
    return view('men');
});
Route::get('/women',function(){
    return view('women');
});
Route::get('/kid',function(){
    return view('kid');
});
Route::get('/product/{category}/{id}',function($category,$id){
    return view('viewproduct',['category'=>$category,'id'=>$id]);
});

Route::get('/cart',function(){
    return view('mycart');
})->middleware('auth');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/ordersuccess',function(){
    return view('ordersuccess');
});


//shopping cart
Route::prefix('api')->post('/cart',[ShoppingCartController::class,'addToCart']);
Route::prefix('api')->get('/cart',[ShoppingCartController::class,'cart']);
Route::prefix('api')->delete('/cart/{id}',[ShoppingCartController::class,'removeCart']);
Route::prefix('api')->put('/cart/{id}/quantity/{quantity}',[ShoppingCartController::class,'updateQuantity']);

// user

Route::prefix('api')->middleware(['api'])->get('/user',[UserController::class,'getAuthUser']);
Route::prefix('api')->middleware(['auth'])->get('/logout',[UserController::class,'logout']);
Auth::routes();

// search

Route::get('/search',[ProductController::class,'search']);


// Route::get('/api/user',function(){
//     return redirect('/');
// });

Route::middleware('auth')->get('/order',[OrderController::class,'allOrder']);

//comment
Route::middleware('auth')->post('/comment',[ReviewController::class,'store']);

//order
Route::middleware('auth')->get('/order/changeStatus/{id}',[OrderController::class,'changeStatus']);