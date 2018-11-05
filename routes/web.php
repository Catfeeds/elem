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
    return view('index');
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
    Route::any("admin.shop.del/{id}","ShopController@del")->name("admin.shop.del");
    Route::any("shop/changeStatus/{id}","ShopController@changeStatus")->name("admin.shop.changeStatus");
    //添加商户
    Route::get("admin.user.index","UserController@index")->name("admin.user.index");
    Route::any("admin.user.reg","UserController@reg")->name("admin.user.reg");
    Route::any("admin/user/apply/{id}", "ShopController@apply")->name("admin.user.apply");
    Route::any("admin.user.del/{id}","ShopController@del")->name("admin.user.del");

    //活动
    Route::get("active/index", "ActiveController@index")->name("admin.active.index");
    Route::any("active/add", "ActiveController@add")->name("admin.active.add");
    Route::any("active/edit/{id}", "ActiveController@edit")->name("admin.active.edit");
    Route::any("active/del/{id}", "ActiveController@del")->name("admin.active.del");
    //订单
    Route::any("order/day", "OrderController@day")->name("admin.order.day");
    Route::any("order/month", "OrderController@month")->name("admin.order.month");
    //菜品统计
    Route::any("order/mday", "OrderController@mday")->name("admin.order.mday");
    Route::any("order/mmonth", "OrderController@mmonth")->name("admin.order.mmonth");
    Route::any("order/total", "OrderController@total")->name("admin.order.total");

     //会员
    Route::get("member/index", "MemberController@index")->name("admin.member.index");
    Route::any("member/status/{id}", "MemberController@status")->name("admin.member.status");

    //添加权限
    Route::any("per/add", "PerController@add")->name("admin.per.add");
    Route::any("per/index", "PerController@index")->name("admin.per.index");
    Route::any("per/edit/{id}", "PerController@edit")->name("admin.per.edit");
    Route::any("per/del/{id}", "PerController@del")->name("admin.per.del");


    //添加角色
    Route::any("role/add", "RoleController@add")->name("admin.role.add");
    Route::any("role/index", "RoleController@index")->name("admin.role.index");
    Route::any("role/edit/{id}", "RoleController@edit")->name("admin.role.edit");
    Route::any("role/del/{id}", "RoleController@del")->name("admin.role.del");

   //权限不够页面
    Route::any("admin/gun", "RoleController@gun")->name("admin.admin.gun");

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


    //图片
    Route::any("user/upload", "MenuController@upload")->name("shop.user.upload");
    //前台查看活动列表
    Route::get("active/index", "ShopController@index")->name("shop.active.index");
   //商户查看详情
    Route::any("active/look/{id}", "ShopController@look")->name("shop.active.look");
  //订单管理
    Route::get("order/index", "OrderController@index")->name("shop.order.index");
    Route::get('order/changeStatus/{id}/{status}', "OrderController@changeStatus")->name('order.changeStatus');
    //订单按日统计
    Route::any("order/day", "OrderController@day")->name("shop.order.day");
    Route::any("order/month", "OrderController@month")->name("shop.order.month");
    //菜品按日统计
    Route::any("morder/mday", "OrderController@mday")->name("shop.morder.mday");
    Route::any("morder/mmonth", "OrderController@mmonth")->name("shop.morder.mmonth");
    Route::any("order/total", "OrderController@total")->name("shop.order.total");
    Route::any("morder/menuTotal", "OrderController@menuTotal")->name("shop.morder.menuTotal");
    });
