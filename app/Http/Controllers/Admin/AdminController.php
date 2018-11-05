<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{
    //
    /**
     * 平台admin列表
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admin.index', compact('admins'));
    }
    /**
     * 添加用户
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')){
            //验证
            $this->validate($request, [
                "name" => "required|unique:admins",
                "email" => "required",
                "password" => "required|min:6",
            ]);
            //接收参数
            $data=$request->post();
            $data['password']=bcrypt($data['password']);
            //创建用户
            $admin=Admin::create($data);
            //给用户添加角色 同步角色

            $admin->syncRoles($request->post('role'));
            // $admin->roles();
            //跳转并提示
            return redirect()->route('admin.admin.index')->with('success','创建'.$admin->name."成功");
        }

        $roles=Role::all();

        return view('admin.admin.add',compact("roles"));
    }

   //删除平台管理员

    public function del($id)
    {
        //1号管理员不能删除
        if ($id == 1) {
            return back()->with("danger", "1不能删除");
        }
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.admin.index')->with("success", "删除成功");
    }
    //修改平台管理员
    public function edit(Request $request, $id)
    {
        //找到id
      $admin=Admin::find($id);
        $rol = $admin->getRoleNames()->toArray();
//        dd($rol);

        //判断提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "name" => "required|unique:admins",
                "email" => "required",

            ]);
            //接收数
            $data = $request->post();
//              dd($data);
            //给用户添加角色 同步角色

            $admin->syncRoles($request->post('role'));
            if ($admin->update($data)) {
                session()->flash("success", "修改成功");
                return redirect()->route("admin.admin.index");
            }
        } else {
            $roles=Role::all();

            return view("admin.admin.edit", compact("admin","roles","rol"));
        }

    }
// 管理员登录
    public function login(Request $request)
    {
        //判断是否POST提交
        if ($request->isMethod("post")) {
            //验证
            $data= $this->validate($request, [
                'name' => "required",
                'password' => "required"
            ]);
            //验证账号密码
            if (Auth::guard("admin")->attempt($data)) {
                // session()->flash("success","登录成功");
                //登录成功
                return redirect()->route("admin.admin.index")->with("success", "登录成功");
            } else {
                return redirect()->route("admin.admin.login")->with("danger", "账号或密码错误");
            }
        }
        return view("admin.admin.login");
    }


//    //修改个人密码
//    /**
//     * 更改密码
//     */
    public function changePassword(Request $request)
    {
        //判断是否POST提交
        if ($request->isMethod("post")) {
            //1.验证
            $this->validate($request, [
                'old_password' => 'required',
//                'password' => 'required|confirmed'
            ]);
            //2.得到当前用户对象
            $admin = Auth::guard('admin')->user();
            $oldPassword = $request->post('old_password');

//            dd($admin);
            //3.判断老密码是否正确
            if (Hash::check($oldPassword, $admin->password)) {
                //3.1如果老密码正确 设置新密码
                $admin->password = Hash::make($request->post('password'));
                //3.2 保存修改
                $admin->save();
                //3.3 跳转
                return redirect()->route('admin.admin.index')->with("success", "修改密码成功");
            }
            //4.老密码不正确
            return back()->with("danger", "老密码不正确");
        }
        //显示视图
        return view("admin.admin.change_password");
    }

    //退出登录
    public function logout()
    {
        Auth::guard("admin")->logout();
        session()->flash("success", "注销成功");
        return redirect()->route("admin.admin.login");
    }
}
