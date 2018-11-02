<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends BaseController
{
    //
    public function index(){


        $shops=Shop::paginate(3);
        $cates=ShopCategory::all();
//        $cates = ShopCategory::where("status", 1)->get();
//            dd($shops);

        return view("admin.shop.index",compact("shops","cates"));
    }

//后天直接添加商户




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
  //删除商户信息
    public function del($id)
    {
        DB::transaction(function () use ($id){
            //1. 删除用户
            User::findOrFail($id)->delete();
            //2. 删除用户对应店铺
            Shop::where("user_id", $id)->delete();
        });
        return back()->with("success", "删除成功");
    }

    //申请店铺
    public function apply(Request $request,$id)
    {

//        $id=User::find($id);
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
            $data['user_id']=$id;
            $data['status']=1;

//             dd($data);
            $data['shop_img'] = $request->file("shop_img")->store("images", "image");
//             dd($data);
            Shop::create($data);
            session()->flash("success", "申请店铺成功。");
            return redirect("shop/index");

        }
        //得到所有商家分类
        $cates = ShopCategory::all();
        return view("admin/user/apply",compact("cates"));
    }



}
