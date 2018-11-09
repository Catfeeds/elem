<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{


    //所有角色
    public function index()
    {
        $roles=Role::all();
        return view('admin.role.index',compact('roles'));
    }

    //添加角色
    public function add(Request $request){
        if ($request->isMethod("post")) {
            //接收参数并处理数据
             $pers=$request->post('pers');
//
//            dd($data['pers']);
             // 添加角色
            $role=Role::create([
                "name"=>$request->post("name"),
                "guard_name"=>"admin"
            ]);
//            dd($pers);
            //给角色同步权限
            if($pers){
                $role->syncPermissions($pers);
            }
        }
        //得到所有权限
         $pers=Permission::all();
//
        return view("admin.role.add",compact("pers"));
    }
//修改角色
public function edit(Request $request,$id){

        //得到当前角色
    $roles=Role::find($id);
    $rol = $roles->permissions()->pluck("id")->toArray();
//    dd($rol);

    //判断提交方式
    if ($request->isMethod("post")) {
        //接收参数
         $data['name']=$request->post('name');
         //创建角色
        $roles->update($data);
        //给角色添加权限 $role->syncPermissions(['权限名1','权限名2']);
        $roles->syncPermissions($request->post('pers'));
        //跳转
        session()->flash("success", "修改成功");
        return redirect("role/index");
    }
    //得到当前权限
    $pers=Permission::all();
    return view("admin.role.edit",compact("roles","pers","rol"));
}

//删除角色
    public function del($id){
        $role=Role::find($id);
        if($role->delete()){
            session()->flash("success", "修改成功");
            return redirect("role/index");
        }
    }
}
