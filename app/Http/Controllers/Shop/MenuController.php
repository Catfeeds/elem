<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends BaseController
{
    //显示所有菜品
    public function index(Request $request)
    {
        $url = $request->query();
        //搜索
        //接收
        $cateId = $request->get("cate_id");
//        dd($cateId);
        $keyword = $request->get("keyword");
        $minPrice = $request->get("minPrice");
        $maxPrice = $request->get("maxPrice");
        //得到所有并要有分页
        $query = Menu::where("shop_id",Auth::user()->shop->id);
        if ($keyword !== null) {
            $query->where("goods_name", "like", "%{$keyword}%");
        }
        if ($cateId !== null) {
            $query->where("cate_id", $cateId);
        }
        if ($minPrice !== null) {
            $query->where("goods_price", ">=", $minPrice);
        }
        if ($maxPrice !== null) {
            $query->where("goods_price", "<=", $maxPrice);
        }
        //得到所有数据
        $menus = $query->paginate(3);
        //引入视图分配数据
        $cate = MenuCategory::where("shop_id",Auth::user()->shop->id)->get();
        return view("shop.menu.index", compact("cate", "menus", "url"));

    }

    //添加菜品
    public function add(Request $request)
    {

        //判断数据提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "goods_name"=>'required|unique:menus',
                "category_id"=>'required',
                "goods_price"=>'required',
                "description"=>'required',
                "month_sales"=>'required',
                "goods_img"=>'required|',
                "satisfy_count"=>'required|',
                "satisfy_rate"=>'required|',
                "status"=>'required|',
            ]);


            //接收数
            $data = $request->post();
            $shopId=Auth::user()->shop->id;
            //接收数
           // $data['goods_img'] = $request->file("goods_img")->store("images", "oss");
            //dd($data);
            $data["shop_id"]=$shopId;
            if (Menu::create($data)) {
                session()->flash("success", "添加成功");
                return redirect("/menu/index");
            }
        } else {
            $cate = MenuCategory::all();
//            dd($cate);
            return view("shop.menu.add", compact( "cate"));

        }
    }

    //修改数据
    public function edit(Request $request, $id)
    {
        //找到id
        $menus = Menu::find($id);
//        $this->authorize('update', $user);
        //判断提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "goods_name"=>'required|unique:menus',
                "category_id"=>'required',
                "goods_price"=>'required',
                "description"=>'required',
                "month_sales"=>'required',
                "goods_img"=>'required|',
                "satisfy_count"=>'required|',
                "satisfy_rate"=>'required|',
                "status"=>'required|',
            ]);
            //接收数
            $data = $request->post();


            //判断是否上传了图片
            if ($request->file("goods_img") !== null) {
                $data['goods_img'] = $request->file("goods_img")->store("menu");
                //dd($data['img']);
            } else {
                $data['goods_img'] = $menus->logo;
            }
            if ($menus->update($data)) {
                session()->flash("success", "修改成功");
                return redirect("/menu/index");
            }
        } else {

            return view("shop.menu.edit", compact('menus'));
        }

    }

    //删除


    public function del($id)
    {
        $menu = Menu::find($id);
        if ($menu->delete()) {
            session()->flash("success", "删除成功");
            return redirect()->route('shop.menu.index')->with('success', "删除成功");
        }
    }


    public function upload(Request $request)
    {
        //处理上传

        //dd($request->file("file"));

        $file = $request->file("file");


        if ($file) {
            //上传

            $url = $file->store("menu_cate");

            /// var_dump($url);
            //得到真实地址  加 http的址

            $url = Storage::url($url);

            $data['url'] = $url;

            return $data;
            ///var_dump($url);
        }


    }
  //按日统计菜品销售量
    public function month(Request $request){
        $shopId=Auth::user()->shop->id;
        $query=Menu::where("shop_id",$shopId)->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as day,SUM(total) AS money,count(*) AS count"))->groupBy("day")->orderBy("day", 'desc')->limit(30);
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



}