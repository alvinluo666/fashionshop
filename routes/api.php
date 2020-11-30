<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/suggestedProducts',[ProductController::class,'suggestedProducts']);
Route::get('/productToday',[ProductController::class,'productToday']);
Route::get('/productType/{category}',[ProductTypeController::class,'index']);
Route::get('/productColor/{category}',[ProductController::class,'color']);

Route::get('/products/{category}',[ProductController::class,'getProducts']);

//get single product
Route::get('/{category}/{id}',[ProductController::class,'getSingleProduct']);




//shipping
Route::get('/shipping',[ShippingController::class,'getShipping']);

//order
Route::post('/order',[OrderController::class,'placeOrder']);




