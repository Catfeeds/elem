<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //
    public  function index(Request $request){
        $keyword = $request->get("keyword");
       // $query = Shop::orderBy("id");

//        dd($shops);
        //内容搜索
        if($keyword !== null){
            $shops=Shop::where("shop_name","like","%{$keyword}%")->where('status',1)->get();
        }else{
            $shops=Shop::where("status",1)->get();
        }
    //追加 距离
        foreach ($shops as  $k=>$v){
            $shops[$k]->distance = rand(1000, 5000);
            $shops[$k]->estimate_time = ceil($shops[$k]['distance'] / rand(100, 150));

        }
return $shops;
    }

    //
    public function detail(){
    $id=\request()->get('id');
    $shop=Shop::find($id);
    $shop->service_code = 4.6;
//        dd($shop->toArray());
        $shop->evaluate = [
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"],
            ["user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"],
            ["user_id" => 123244,
            "username" => "z******y",
            "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
            "time" => "2017-2-22",
            "evaluate_code" => 4.5,
            "send_time" => 30,
            "evaluate_details" => "分量足很好吃！！"]
];
        $cates=MenuCategory::where('shop_id',$id)->get();
        //dd($cates->toArray());
        //当前分类有哪些商品
        foreach ($cates as $k=>$cate){
               $cates[$k]->goods_list = $cate->menus;
        }
      $shop->commodity=$cates;
//dd($shop->toArray());
        return $shop;
}
}
