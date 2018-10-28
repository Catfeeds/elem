<?php

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
Route::domain("admin1.elem.com")->namespace("Admin")->group(function (){


    //店铺分类增删改查
    Route::get("shopCate/index","ShopCategoryController@index")->name("admin.shopCate.index");
    Route::any("shopCate/add","ShopCategoryController@add")->name("admin.shopCate.add");
    Route::any("shopCate/edit/{id}","ShopCategoryController@edit")->name("admin.shopCate.edit");
    Route::any("shopCate/del/{id}","ShopCategoryController@del")->name("admin.shopCate.del");


    //管理员增删改查
    Route::get("admin/index","AdminController@index")->name("admin.admin.index");
    Route::any("admin/add","AdminController@add")->name("admin.admin.add");
    Route::any("admin/edit/{id}","AdminController@edit")->name("admin.admin.edit");
    Route::any("admin/del/{id}","AdminController@del")->name("admin.admin.del");
    //管理员登录
    Route::any('admin/login', "AdminController@login")->name('admin.admin.login');
    Route::any('admin/logout', "AdminController@logout")->name('admin.admin.logout');
    //修改个人密码
    Route::any('admin/change_password', "AdminController@changePassword")->name('admin.admin.change_password');

    //用户信息状态
    Route::get("shop/index","ShopController@index")->name("admin.shop.index");
    Route::any("shop/changeStatus/{id}","ShopController@changeStatus")->name("admin.shop.changeStatus");

});


Route::domain("shop1.elem.com")->namespace("Shop")->group(function (){
       //菜品分类
        Route::get("menuCate/index","MenuCategoryController@index")->name("shop.menuCate.index");
        Route::any("menuCate/add","MenuCategoryController@add")->name("shop.menuCate.add");
        Route::any("menuCate/edit/{id}","MenuCategoryController@edit")->name("shop.menuCate.edit");
        Route::any("menuCate/del/{id}","MenuCategoryController@del")->name("shop.menuCate.del");
        //菜品列表
        Route::get("menu/index","MenuController@index")->name("shop.menu.index");
        Route::any("menu/add","MenuController@add")->name("shop.menu.add");
        Route::any("menu/edit/{id}","MenuController@edit")->name("shop.menu.edit");
        Route::any("menu/del/{id}","MenuController@del")->name("shop.menu.del");


        //用户注册
    Route::get("user/index", "UserController@index")->name("shop.user.index");
    Route::any("user/reg", "UserController@reg")->name("shop.user.reg");
    Route::any("user/login", "UserController@login")->name("shop.user.login");
    Route::any("user/change_password", "UserController@changePassword")->name("shop.user.change_password");
        //商户申请店铺
    Route::any("shops/apply", "ShopController@apply")->name("shop.shops.apply");
        //商户退出登录
    Route::any("user/logout", "UserController@logout")->name("shop.user.logout");






    });
