<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("shop/index","Api\ShopController@index");
Route::any("shop/detail","Api\ShopController@detail");
Route::get("member/sms","Api\MemberController@sms");
Route::post("member/reg","Api\MemberController@reg");
Route::post("member/login","Api\MemberController@login");
Route::post("member/forget","Api\MemberController@forget");
Route::post("member/change","Api\MemberController@change");
Route::get("member/detail","Api\MemberController@detail");
Route::post("address/add","Api\AddressController@add");
Route::get("address/index","Api\AddressController@index");
Route::post("address/edit","Api\AddressController@edit");
Route::get("address/getOne","Api\AddressController@getOne");
Route::post("cart/add","Api\CartController@add");
Route::get("cart/index","Api\CartController@index");
//订单
Route::post("order/add","Api\OrderController@add");
Route::get("order/detail","Api\OrderController@detail");
Route::get("order/index","Api\OrderController@index");
//支付
Route::post("order/pay","Api\OrderController@pay");