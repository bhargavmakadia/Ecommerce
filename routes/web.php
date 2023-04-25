<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product','App\Http\Controllers\Productcontroller');

Route::get('shop','App\Http\Controllers\UserSideController@ProductListing');

Route::get('productdetails/{id}','App\Http\Controllers\UserSideController@ProductDetails');

Route::post('add-cart-process/{id}','App\Http\Controllers\UserSideController@AddtoCartProcess');

Route::get('cart','App\Http\Controllers\UserSideController@CartListing_session');

Route::get('remove-cart/{id}','App\Http\Controllers\UserSideController@RemoveCart');

Route::post('update-cart/{id}','App\Http\Controllers\UserSideController@UpdateCart');

Route::post('placeorder','App\Http\Controllers\UserSideController@PlaceOrder');

Route::get('thankyou','App\Http\Controllers\UserSideController@thankyou');