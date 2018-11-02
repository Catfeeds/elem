<?php

namespace App\Http\Controllers\Shop;

use App\Models\Active;
use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    //
    //申请店铺
    public function apply(Request $request)
    {
        //判断当前用户是否已有店铺
        if (Auth::user()->shop){
            return back()->with("danger","已有店铺不能再创建");
        }
        //判断数据提交方式
        if ($request->isMethod("post")) {
            //1. 验证
            $this->validate($request, [
//                'shop_cate_id' => 'required|integer',
                'shop_name' => 'required|max:100|unique:shops',
                'shop_img' => 'required',
                'start_send' => 'required|numeric',
                'send_cost' => 'required|numeric',
                'notice' => 'string',
                'discount' => 'string',
            ]);
            //接收数
            $data = $request->post();
            $data['user_id']=Auth::user()->id;
//             dd($data);
            $data['shop_img'] = $request->file("shop_img")->store("images", "image");
//             dd($data);
             Shop::create($data);
            session()->flash("success", "申请店铺成功,等待审核。");
            return redirect("user/index");
//            if (Shop::create($data)) {
//                session()->flash("success", "申请店铺成功,等待审核。");
//                return redirect("user/index");
//            }
        }
        //得到所有商家分类
        $cates = ShopCategory::all();
        return view("shop/shops/apply",compact("cates"));
    }

    //显示活动列表
    public function index(){
        $actives=Active::where("end_time",">=",date('Y-m-d H:i:s', time()))->get();

        return view("shop.active.index",compact("actives"));

    }

    //查看详情
    public  function  look($id){
        $active=Active::find($id);
//        dd($active);
        return view("shop.active.look",compact("active"));
    }

}
