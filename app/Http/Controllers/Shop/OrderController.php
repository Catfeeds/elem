<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //订单列表
    public function index(Request $request){
//        $orders=Order::all();

        $status =$request->get("status");
        $keyword = $request->get("keyword");
//        dd($status);
        $query = Order::orderBy("id");
//        dd($query);
         $shopId=Auth::user()->shop->id;
//       dd($shopId);
        if( $status !== null ){
            $query->where("status",$status);
        }
        //-1=>"已取消",0=>"代付款",1=>"代发货", 2 => "待确认", 3 => "完成"
       //内容搜索
        if($keyword !== null){
            $query->where("order_code","like","%{$keyword}%");
        }
//       $orders=Order::where("shop_id",$shopId)->paginate(3);
        $orders =$query->paginate(3);
      return view("shop.order.index",compact("orders"));
    }
//更改订单状态
    public function changeStatus($id,$status)
    {
//        dd(1);
//        dd( Auth::id());
   $result = Order::where("id", $id)->where("shop_id",Auth::user()->shop->id)->update(['status' => $status]);
////   dd($result);
if ($result) {
    return redirect()->route("shop.order.index")->with("success", "更改状态成功");
}

        }


        //按日统计
    public function day(Request $request){
        $shopId=Auth::user()->shop->id;
       $query=Order::where("shop_id",$shopId)->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day,SUM(total) AS money,count(*) AS count"   ))->groupBy("day")->orderBy("day", 'desc')->limit(30);
        //接收参数
        $start=$request->input('start');
        $end=$request->input('end');
        //如果有起始时间
        if($start!==null){
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }
        //得到每日数据
        $orders=$query->get();
        return view("shop.order.day",compact("orders"));
    }
//按月统计
public function month(Request $request){
    $shopId=Auth::user()->shop->id;
    $query=Order::where("shop_id",$shopId)->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as day,SUM(total) AS money,count(*) AS count"))->groupBy("day")->orderBy("day", 'desc')->limit(30);
    //接收参数
    $start=$request->input("start");
    $end=$request->input("end");
    //如果有起始时间
    if($start!==null){
        $query->whereDate("created_at", ">=", $start);
    }
    if ($end !== null) {
        $query->whereDate("created_at", "<=", $end);
    }
    //得到每月数据
    $orders=$query->get();
    return view("shop.order.month",compact("orders"));
}
//总计
public function total(){
    $shopId=Auth::user()->shop->id;
    $datas = Order::where("shop_id",$shopId)
        ->select(DB::raw("COUNT(*) as nums,SUM(total) as money"))
        ->get();
    return view('shop.order.total', compact('datas'));

}

//菜品销量日统计
public function mday(Request $request){
    //默认显示当前的菜品销量
    $date=$request->day??date("Y-m-d",time());
    //读取商家所有订单
    $shopId=Auth::user()->shop->id;
    $order=Order::where("shop_id",$shopId)->whereIn("status",[1,2,3])->pluck("id");
    $datas=OrderGood::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,SUM(amount) as nums,SUM(amount * goods_price) as money"))
        ->whereIn("order_id",$order)
        ->groupBy('date')
        ->get();

// dd($datas);
    return view("shop.morder.mday", compact("datas"));
}
//按月统计
    public function mmonth(Request $request)
    {
        //读取商家所有订单
        $shopId = Auth::user()->shop->id;
        $order = Order::where("shop_id", $shopId)->whereIn("status", [1, 2, 3])->pluck("id");
        $datas = OrderGood::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$order)
            ->groupBy('date')
            ->get();
// dd($datas);
        return view("shop.morder.mmonth", compact("datas"));
    }

    //菜单订单总计
    //菜品总销量
    public function menuTotal(){
        //找到当前店铺所有的订单ID
        $ids = Order::where("shop_id",Auth::user()->shop->id)->pluck("id");
        $datas= OrderGood::select(DB::raw("SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$ids)
            ->get();
        return view('shop.morder.menuTotal', compact('datas'));
    }


}
