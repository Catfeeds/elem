<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


饿了么点餐平台
项目介绍：
整个系统分为三个不同的网站，分别是

平台：网站管理者
商户：入住平台的餐馆
用户：订餐的用户
实现步骤：
1.composer create-project --prefer-dist laravel/laravel ele0620 "5.5.*" -vvv
2.
配置虚拟主机 设置三个域名 设置hosts,并重启
3.建立数据库 ele0620

4.修改配置文件.env
 数据库名，用户，密码

5.语言包，设置中文语言
1. composer require caouecs/laravel-lang:~3.0 -vvv
2. 复制vendor\caouecs\laravel-lang\src\zh-CN 目录到 resources\lang\zh-CN
3. 设置config\app.php 81行为 'locale' => 'zh-CN',
6.布局模板，分别再views下创建admin和shop两个目录，分别在其目录下复制layouts
7.数据迁移
修改app/Providers/AppServiceProvider.php 文件
  Schema::defaultStringLength(191);
  
  
 一.创建店铺分类模型
 
      1.php artisan make:model Models/ShopCategory -m
      2.databaese/migrations/添加所需字段
      3.数据迁移刷新数据库：
     php artisan migrate
      4.创建控制器：
     php artisan make:controller Admin/ShopCategoryController
     5.创建视图
     views/admin/shop_category/index.blade.php
     分别创建增删改查
        1.显示所有数据
        控制器
        
        模型要添加可修改字段
         protected $fillable=["name","img","status","sort"];
        路由（admin1
        Route::get("shopCate/index","ShopCategoryController@index")->name("admin.shopCate.index");）
        添加/修改/删除
     
 二.登录
            
            
            1.创建好视图amdin/amdin/login.band.php
            2.控制器AdminController里面
            3.模型里面加上
            use Illuminate\Foundation\Auth\User as Authenticatable;
            继承：Authenticatable
            4.设置保安config/auth.php
            复制添加
             'admin' => [
                        'driver' => 'session',
                        'provider' => 'admins',
                    ],
                    
                      'admins' => [
                                'driver' => 'eloquent',
                                'model' => App\Models\Admin::class,
                            ],
          5.登录成功后显示用户名
          {{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}
          6.退出登录
            1）控制器
            2）路由
            7.修改个人密码
            1)视图
            2）控制器
              注意 
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
                              

      

三.商户信息状态管理

       1.创建模型
        php artisan make:model Models/Shop -m
       2.添加字段
       3.创建控制器
       php artisan make:controller Admin/ShopController
         //得到一个对象
                 $shop = Shop::findOrFail($id);
                 $shop->status = 1;
                 $shop->save();
                 return back()->with("success", "通过审核");
       4.数据迁移刷新数据库
       php artisan migrate
四.菜品分类
    
        1.创建模型
        2.添加字段
        3.创建控制器
五.菜品列表
   
   
       1.创建模型
       2.添加字段
       3.创建控制器
       4.分页及搜索功能  !!!
六.
      
       

