<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
class PerController extends BaseController
{
    //

    //显示所有权限
    public function index(){
        $pers=Permission::all();
        return view("admin.per.index",compact("pers"));
    }

    //添加权限
    public function add(Request $request){
        //声明一个空数组来装路由名字
        $urls=[];
        //得到所有路由
        $routes = Route::getRoutes();
//        dd($routes);
         //循环得到单个路由
        foreach ($routes as $route){
            //判断是否是后台的命名空间
            if($route->action['namespace']=="App\Http\Controllers\Admin"){
                //取别名存到$urls中
                $urls[]=$route->action['as'];
            }
        }
//        dd($urls[]=$route->action['as']);
       //从数据库取出已存在的
        $pers=Permission::pluck("name")->toArray();
        //已存在的从$urls中去掉
        $urls=array_diff($urls,$pers);
      if($request->isMethod("post")){
          $data=$request->post();
          $data['guard_name']="admin";
          Permission::create($data);
      }
        return view("admin.per.add",compact("urls"));
    }
//修改权限
public function edit(Request $request,$id){
   $pers=Permission::find($id);
//   dd($pers);
   //判断提交方式
    if ($request->isMethod("post")) {
        //接收参数
        $data=$request->post();
        $data['guard_name']="admin";
      if($pers->update($data)){
          session()->flash("success", "修改成功");
          return redirect("per/index");
      }
    }
    return view("admin.per.edit",compact("pers"));

}

//删除权限
public function del($id){
        $pers=Permission::find($id);
        if($pers->delete()){
            session()->flash("success", "修改成功");
            return redirect("per/index");
        }
}


}
