<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends BaseController
{
    //
    public function index(){
        $cates=ShopCategory::paginate(2);
        return view("admin.shop_category.index",compact('cates'));
    }

    //添加店铺
    public function add(Request $request)
    {
        //接收数
        $data = $request->post();
        //判断数据提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "name" => "required|",
                "img" => "required|",
            ]);
            //接收数
            $data['img'] = $request->file("img")->store("images", "image");
//              dd($data);
            if (ShopCategory::create($data)) {
                session()->flash("success", "添加成功");
                return redirect("/shopCate/index");
            }
        } else {

            return view("admin.shop_category.add", compact('cates'));

        }
    }


    //修改店铺数据
    public function edit(Request $request, $id)
    {
        //找到id
        $cate = ShopCategory::find($id);
//        $this->authorize('update', $user);
        //判断提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "name" => "required|",
                "img" => "required|",
            ]);
            //接收数
            $data = $request->post();
            //判断是否上传了图片
            if ($request->file("img") !== null) {
                $data['img'] = $request->file("img")->store("images", "image");
            } else {
                $data['logo'] = $cate->logo;
            }
            if ($cate->update($data)) {
                session()->flash("success", "修改成功");
                return redirect()->route("/shopCate/index");
            }
        } else {

            return view("admin.shop_category.edit", compact('cate'));
        }

    }


//删除
    public function del($id){
        //得到当前分类
        $cate=ShopCategory::findOrFail($id);
        //得到当前分类对应的店铺数
        $shopCount=Shop::where('shop_cate_id',$cate->id)->count();
        //判断当前分类店铺数
        if ($shopCount){
            //回跳
            return  back()->with("danger","当前分类下有店铺，不能删除");
        }
        //否则删除
        $cate->delete();
        //跳转
        return redirect()->route('shop_cate.index')->with('success',"删除成功");
    }
}
