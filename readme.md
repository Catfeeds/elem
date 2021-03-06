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
六.活动的增删改查
 
     1.添加时的编辑器
       1.安装
       composer require "overtrue/laravel-ueditor:~1.0"
       2.添加下面一行到 config/app.php 中 providers 部分  
         Overtrue\LaravelUEditor\UEditorServiceProvider::class,
         3.发布配置文件与资源
         $ php artisan vendor:publish --provider='Overtrue\LaravelUEditor\UEditorServiceProvider'
         4.这行的作用是引入编辑器需要的 css,js 等文件，所以你不需要再手动去引入它们。
           
           @include('vendor.ueditor.assets')
           5.<!-- 实例化编辑器 -->
             <script type="text/javascript">
                 var ue = UE.getEditor('container');
                 ue.ready(function() {
                     ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                 });
             </script>
             
             <!-- 编辑器容器 -->
             <script id="container" name="content" type="text/plain"></script>
             
             
七.数据接口

         1.把static,api.js接口文件放到public下
         2.index文件放到views下
         3.创建路由
         Route::get('/', function () {
             return view('index');
          4.创建控制器
          php artisan make:controller Api\ShopController
          读取数据库所有数据
 八.添加权限及角色
      
      1.安装 composer require spatie/laravel-permission -vvv
      
      2.生成数据迁移 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
      
      3.给权限表可以加个 intro 字段
      
      4.执行数据迁移 php artisan migrate
      
      5. 生成配置文件 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
      6.admin 模型中
        class Admin extends Authenticatable
        {
            use HasRoles;
            protected $guard_name = 'admin'; // 使用任何你想要的守卫
            protected $fillable=['name','password','email'];
        }
        
        
        
 1).添加权限
 
 
        7.PerController中
         public function add(Request $request)
            {
                if ($request->isMethod("post")){
        
        
                    $data=$request->post();
                    $data['guard_name']="admin";
                    Permission::create($data);
                }
                return view("admin.per.add");
        
        
            }
    8.RoleContrller
      public function add(Request $request)
        {
    
            if ($request->isMethod("post")){
    
                //1.接收参数 并处理数据
               $pers=$request->post('pers');
                //2.添加角色
                $role=Role::create([
                    "name"=>$request->post("name"),
                    "guard_name"=>"admin"
                ]);
                //3. 给角色同步权限
                if ($pers){
                    $role->syncPermissions($pers);
                }
            }
    
    
            //得到所有权限
            $pers = Permission::all();
    
    
            return view("admin.role.add",compact("pers"));
    
        }
        9.BaseController
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
2）修改权限PerController

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
    
    
3).权限修改
 视图
 
      <div class="form-group">
                  <label class="col-sm-2 control-label">权限</label>
                  <div class="col-sm-10">
                      @foreach( $pers as $per)
                      <input type="checkbox" name="pers[]"  value="{{$per->id}}" {{in_array($per->id,$rol)?'checked':""}}>
                      {{$per->intro}}
                      @endforeach
                  </div>
              </div>
       
       
  RoleController
       
       /修改角色
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

4）.添加权限
    
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
视图
       
       
       <div class="form-group">
                   <label class="col-sm-2 control-label">权限</label>
                   <div class="col-sm-10">
                       @foreach( $pers as $per)
                       <input type="checkbox" name="pers[]"  value="{{$per->id}}" >{{$per->intro}}
                      @endforeach
                   </div>
               </div>
               
5）.给指定用户加角色

     AdminController:
    $admin->syncRoles($request->post('role'));
    
    添加视图：
     <div class="form-group">
                            <label class="col-sm-2 control-label">角色</label>
                            <div class="col-sm-10">
                                @foreach( $roles as $per)
                                    <input type="checkbox" name="role[]"  value="{{$per->id}}" >{{$per->name}}
                                @endforeach
                            </div>
                        </div>
九.邮件发送


    1.首先在自己邮箱的设置里  账户设置开启邮箱服务得到授权码 
    2.在env里配置
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.qq.com
    MAIL_PORT=465
    MAIL_USERNAME=1241672563@qq.com
    MAIL_PASSWORD=srmfatbbxpfbhefc
    MAIL_ENCRYPTION=ssl
    MAIL_FROM_ADDRESS=1241672563@qq.com
    MAIL_FROM_NAME=hellow
    3.在web路由里
    /发送邮件
    Route::get('test', function () {
        //
        $shopName="牛牛牛火锅";
        $to='17723505839@163.com';
        $subject=$shopName.'通知';
        \Illuminate\Support\Facades\Mail::send(
            'emails.shop',
            compact("shopName"),
            function ($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            }
        );
    });
十.导航栏
  
      添加导航
        
        
         //添加
        public function add(Request $request){
              if($request->isMethod("post")){
                  $this->validate($request,[
                   'name'=>'required',
                  ]);
                  if($request->post('url')==null){
                      $data=$request->except('url');
                  }else{
                      $data=$request->post();
                  }
                  $nav=Nav::create($data);
                 return redirect()->refresh()->with('success','添加'.$nav->name.'成功');
              }
              //得到所有路由
            $routes=Route::getRoutes();
            //定义数组
            $urls=[];
            foreach ($routes as $k=>$value){
                //dd($value->action);
                if ($value->action['namespace']==="App\Http\Controllers\Admin"){
                    if (isset($value->action['as'])){
                        $urls[]=$value->action['as'];
                    }
                }
            }
            $navs=Nav::where('parent_id',0)->orderBy('sort')->get();
        //    dd($navs);
            return view('admin.nav.add',compact('navs','urls'));
        }
        
        }
   
   
   header视图
      
      
      <ul class="nav navbar-nav">
                      <li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a></li>
      
                      @foreach(\App\Models\Nav::where('parent_id',0)->get() as $k1=>$v1)
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$v1->name}} <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              @foreach(\App\Models\Nav::where('parent_id',$v1->id)->get() as $k2=>$v2)
                              <li><a href="{{route($v2->url)}}" >{{$v2->name}}</a></li>
                              @endforeach
                          </ul>
                      </li>
                      @endforeach
  
    
十一. 抽奖
    
    平台
    
  抽奖活动管理[报名人数限制、报名时间设置、开奖时间设置]
  
    做简单的增删改查
 抽奖报名管理[可以查看报名的账号列表]
    
  活动奖品管理[开奖前可以给该活动添加、修改、删除奖品]
  
    首先做简单的增删改查
    
 开始抽奖[根据报名人数随机抽取活动奖品,将活动奖品和报名的账号随机匹配]
       
 
            public function open(Request $request,$id)
            {
                //1.通过当前活动ID把已经报名的用户ID取出来、
                $userIds = DB::table('event_users')->where('event_id', $id)->pluck('user_id')->toArray();
       //           dd($userId);
                //打乱ID
                shuffle($userIds);
                //找出当前活动的奖品 并随机打乱
                $prizes = EventPrize::where("event_id", $id)->get()->shuffle();
       //         dd($prizes);
                //奖品表
                foreach ($prizes as $k => $prize) {
                    //给用户赋值
                    $prize->user_id = $userIds[$k];
                    //给中奖用户发邮件
                   //得到用户信息
                    $userId=User::find($prize->user_id);
       
                    //得到用户邮箱
                    $email=$userId['email'];
                    //用户名字
                    $name =$userId['name'];
                    //
                    $shopName=$name;
                    $to=$email;
                    $subject=$shopName.'中奖通知';
                    \Illuminate\Support\Facades\Mail::send(
                        'emails.prize',
                        compact("shopName"),
                        function ($message) use($to, $subject) {
                            $message->to($to)->subject($subject);
                        }
                    );
       
                    //保存修改状态
                    $prize->save();
       
                 
       
                }
                //修改活动状态
                $event=Event::findOrFail($id);
                $event->is_prize=1;
                $event->save();
                return redirect()->route('admin.event.index')->with('success','开奖成功');
            }

    抽奖完成时，给中奖商户发送中奖通知邮件
       
  给中奖用户发邮件
  
  
    //得到用户信息
    $userId=User::find($prize->user_id);
              
    //得到用户邮箱                         $email=$userId['email'];
       //用户名字
    $name =$userId['name'];
                           //
    $shopName=$name;
     $to=$email;
    $subject=$shopName.'中奖通知';           \Illuminate\Support\Facades\Mail::send(
    'emails.prize',
     compact("shopName"),
      function ($message) use($to, $subject) {                        $message->to($to)->subject($subject);
                               }
                           );
   
  商户
    
    抽奖活动列表
    
  报名抽奖活动
          
          
          //报名抽奖活动
              public function sign($id){
                  $event=Event::find($id);
          //        dd (111);
                 //得到当前报名人数
                  $num=EventUser::where("event_id",$event->id)->count();
          
                  $user=EventUser::where("user_id",Auth::user()->id)->first();
                  //dd($user);
                  if($num > $event->num ){
                      return back()->with("success","报名已满");
                  }
                  //得到当前用户ID
                  $data['user_id']=Auth::user()->id;
          //        dd($data['user_id']);
                  if(isset($user->user_id)){
                      return back()->with("warning","你已报名");
                  }
                  EventUser::create($data);
                  return back()->with("success","报名成功 等待开奖");
          
              }
   查看抽奖活动结果
      
       public function result($id){
              $eventPrizes=EventPrize::where("event_id",$id)->get();
              return view("shop.event.result",compact("eventPrizes"));
      
          }

    
  