<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //订单统计量
public function day(){
//读取商家所有订单
    $datas=Order::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,SUM(total) as nums,shop_id"))
        ->groupBy('date','shop_id')
        ->get();

    return view("admin.order.day", compact("datas"));
}
//按月统计
public function month(){
    $datas=Order::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,SUM(total) as nums,shop_id"))
        ->groupBy('date','shop_id')
        ->get();
    return view("admin.order.day", compact("datas"));

}

//总计
    public function total(){
        $datas=Order::select(DB::raw("COUNT(*) as nums,SUM(total) as money,shop_id"))
            ->groupBy('shop_id')
            ->get();
        return view('admin.order.total', compact('datas'));

    }


    //菜单日月总体销售统计
    public function mday(Request $request){
       // 查询出商家
        $shops =Shop::all();
        //接受数据
        $shopId =$request->get("shop_id");
        $start =$request->get("start");
        $end =$request->get("end");
       //订单id
        $ordersId=Order::where("shop_id",$shopId)->pluck("id");
        $query= OrderGood::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$ordersId)
            ->groupBy('date');
//       dd($query);
        //判断
        if($start !==null ){
            $query->where("created_at",">=","$start");
        }
        if( $end !==null){
            //  exit("111");
            $query->where("created_at","<=",$end);
        }
        $datas = $query->get();
//        dd($datas);
        return view("admin.menu.mday",compact("shops","datas"));

    }




}
