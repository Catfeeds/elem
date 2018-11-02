<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends BaseController
{
    //
    public function index()
    {
//        $id =Auth::user()->shop->id;
//        dd($id);
//        $menus=MenuCategory::where("shop_id",$id)->get();
        $menus=MenuCategory::where("shop_id",Auth::user()->shop->id)->get();

        return view("shop.menu_category.index", compact('menus'));

    }

    //添加菜品
    public function add(Request $request)
    {
//        $id=Auth::user()->shop->id;
//        dd($id);
        //接收数
        $data = $request->post();
        //判断数据提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                'name'=>'required',
                'description'=>'required',
                'is_selected'=>'required',
            ]);
//              dd($data);
//            $data["is_selected"]=$data["is_selected"];
//            if($data["is_selected"]==1)
//            {
//                DB::table("menu_categories")->where("shop_id",)->update(["is_selected"=>0]);
//
//            }
            //name不能在本店铺重复
            //当前用户
            //得到shop_id
            $shopId=Auth::user()->shop->id;
            //得到重名的个数
            $count=MenuCategory::where("shop_id",$shopId)->where('name',$request->post('name'))->count();
            //判断
            if ($count){
                //如果存在 返回
                return back()->with('danger',"已存在相同的名称")->withInput();
            }
            //接收参数
            $data=$request->all();
            $data['shop_id']=$shopId;
            //判断
            if ($request->post('is_selected')) {
                //把表里所的is_selected设置0
                MenuCategory::where("is_selected", 1)->where('shop_id', $shopId)->update(['is_selected' => 0]);
            }
            //入库
            MenuCategory::create($data);
            //跳转并提示
            return redirect()->route('shop.menuCate.index')->with('success',"添加成功");
        }

            return view("shop.menu_category.add", compact('cates'));


    }

    //修改菜品分类
    public function edit(Request $request, $id)
    {
        //找到id
        $cates = MenuCategory::find($id);
        //判断提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "name" => "required|",

            ]);
            //接收数
            $data = $request->post();
            if ($cates->update($data)) {
                session()->flash("success", "修改成功");
                return redirect()->route("/menuCate/index");
            }
        } else {

            return view("shop.menu_category.edit", compact('cates'));
        }

    }




////删除
    public function del($id){
        //得到当前分类
        $cate=MenuCategory::findOrFail($id);
        //得到当前分类对应的店铺数
        $shopCount=Menu::where('category_id',$cate->id)->count();
        //判断当前分类店铺数
        if ($shopCount){
            //回跳
            return  back()->with("danger","当前分类下有店铺，不能删除");
        }
        //否则删除
        $cate->delete();
        //跳转
        return redirect()->route('shop.menuCate.index')->with('success',"删除成功");
    }
}
