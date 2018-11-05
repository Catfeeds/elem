<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth:admin", [
            "except" => ["login"]
        ]);

        //有没有权限
        $this->middleware(function ($request,\Closure $next){
            //如果没有权限 停在这里
               //得到当前访问路由

            $route=Route::currentRouteName();
//            dd($route);
              //设置一个白名单
            $allow=[
                "admin.login",
                "admin.logout"
            ];
            //判断当前登录用户有没有权限
             if(!in_array($route,$allow) && !Auth::guard("admin")->user()->can($route) && Auth::guard("admin")->id()!==2){
                 exit(view("admin.gun"));
             }
             return $next($request);
        });
    }
}
