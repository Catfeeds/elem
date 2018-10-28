<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends BaseController
{
    //
    public function index(){


        $shops=Shop::all();
        $cates=ShopCategory::all();
        $cates = ShopCategory::where("status", 1)->get();

        return view("admin.shop.index",compact("shops","cates"));
    }


    //审核
    //通过审核
    public function changeStatus($id)
    {
        //得到一个对象
        $shop = Shop::findOrFail($id);
        $shop->status = 1;
        $shop->save();
        return back()->with("success", "通过审核");
    }

}
