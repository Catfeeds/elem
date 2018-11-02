<?php

namespace App\Http\Controllers\Shop;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    //
    public function index()
    {
        return view("shop.user.index");
    }

    //注册商家
    public function reg(Request $request)
    {
        if ($request->isMethod("post")) {
            //1. 验证
            $this->validate($request, [
                "name" => "required|unique:users",
                "password" => "required",
                "email" => "required"
            ]);
            //2. 接收数据
            $data = $request->post();
            //2.1密码加密
            $data['password'] = bcrypt($data['password']);
            //3. 入库

            User::create($data);
            //4. 跳转
            return redirect()->route("shop.user.login")->with("success", "注册成功");
        }
        return view("shop.user.reg");
    }

    //商户登录

    public function login(Request $request)
    {
        if ($request->isMethod("post")) {
            //验证
            $data = $this->validate($request, [
                "name" => "required",
                "password" => "required"
            ]);
            //判断账号密码是否正确

            if (Auth::attempt($data)) {
                //判断该用户是否有店铺
                $user = Auth::user();
                $shop = $user->shop;
                //通过用户找店铺
                if ($shop) {
                    //如果有店铺 状态 -1 0 1
                    switch ($shop->status) {
                        case -1:
                            //禁用
                            Auth::logout();
                            return back()->withInput()->with("danger", "店铺已禁用");
                            break;
                        case 0:
                            //未审核
                            Auth::logout();
                            return back()->withInput()->with("danger", "店铺还未通过审核");
                            break;
                    }
                } else {
                    //跳转到申请店铺
                    return redirect()->route("shop.shops.apply")->with("danger", "还未申请店铺");
                }

            }
            return redirect()->route("shop.user.index")->with("danger", "登录成功");
        }
        //显示视图
        return view("shop.user.login");

    }



    //修改个人密码
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
            $user = Auth::guard('user')->user();
            $oldPassword = $request->post('old_password');

//            dd($admin);
            //3.判断老密码是否正确
            if (Hash::check($oldPassword, $user->password)) {
                //3.1如果老密码正确 设置新密码
                $user->password = Hash::make($request->post('password'));
                //3.2 保存修改
                $user->save();
                //3.3 跳转
                return redirect()->route('shop/user/index')->with("success", "修改密码成功");
            }
            //4.老密码不正确
            return back()->with("danger", "老密码不正确");
        }
        //显示视图
        return view("shop.user.change_password");
    }
//退出登录
    public function logout()
    {
        Auth::logout();
        return redirect()->route("shop.user.index")->with("success", "退出登录成功");
    }


}
