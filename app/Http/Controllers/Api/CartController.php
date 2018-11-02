<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //
    public function index(Request $request){
         //得到用户ID
        $userId=$request->input('user_id');

        //购物车的列表
        $carts = Cart::where('user_id',$userId)->get();
     //dd($carts);
     //声明一个空数组
        $goodsList=[];
        //声明总价
        $totalCost=0;
        //循环购物车
        foreach ($carts as $k => $v) {
            $good = Menu::where('id', $v->goods_id)->first(['id as goods_id','goods_name', 'goods_img', 'goods_price']);
             $good->amount=$v->amount;
           // $good->amount = $v->amount;
            //算总价
            $totalCost += $good->amount * $good->goods_price;
            $goodsList[] = $good;
            //var_dump($good->toArray());
        }
        return [
            'goods_list' => $goodsList,
            'totalCost' => $totalCost
        ];
    }
    //购物车添加
    public function add(Request $request){
        //验证
        //清空购物车
        Cart::where($request->post('user_id'))->delete();
       //接收参数
        $goods=$request->post('goodsList');
        $counts=$request->post('goodsCount');
       foreach ($goods as $k=>$good){
           $data=[
               'user_id'=>$request->post('user_id'),
               'goods_id'=>$good,
               'amount'=>$counts[$k]
           ];
           Cart::create($data);
       }
//       dd($data);
       return[
           'status'=>"true",
           'message'=>'添加成功'
       ];
    }
}
