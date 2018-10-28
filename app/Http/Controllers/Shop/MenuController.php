<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends BaseController
{
    //显示所有菜品
    public function  index(Request $request){
        $url=$request->query();
        //搜索
        //接收
        $cateId=$request->get("shop_id");
//        dd($cateId);
        $keyword=$request->get("keyword");
        $minPrice=$request->get("minPrice");
        $maxPrice=$request->get("maxPrice");
        //得到所有并要有分页
        $query=Menu::orderBy("id")->where('shop_id',1);
        if ($keyword!==null){
            $query->where("goods_name","like","%{$keyword}%");
        }
        if ($cateId!==null){
            $query->where("shop_id",$cateId);
        }
        if ($minPrice!==null){
            $query->where("goods_price",">=",$minPrice);
        }
        if ($maxPrice!==null){
            $query->where("goods_price","<=",$maxPrice);
        }
        //得到所有数据
        $menus=$query->paginate(2);
        //引入视图分配数据
        $cate=MenuCategory::all();
        return view("shop.menu.index",compact("cate","menus","url"));

    }
    //添加菜品
    public function add(Request $request)
    {
        //接收数
        $data = $request->post();
        //判断数据提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [

            ]);
            //接收数
            $data['goods_img'] = $request->file("goods_img")->store("images", "image");
              //dd($data);
            if (Menu::create($data)) {
                session()->flash("success", "添加成功");
                return redirect("/menu/index");
            }
        } else {

            return view("shop.menu.add", compact('menus'));

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

            ]);
            //接收数
            $data = $request->post();
            //判断是否上传了图片
            if ($request->file("img") !== null) {
                $data['img'] = $request->file("img")->store("images", "image");
            } else {
                $data['logo'] = $menus->logo;
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


    public  function  del($id){
        $menu=Menu::find($id);
        if ($menu->delete()) {
            session()->flash("success", "删除成功");
            return redirect()->route('shop.menu.index')->with('success',"删除成功");
        }
    }

}
