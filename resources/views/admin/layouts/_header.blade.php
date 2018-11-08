

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">后台管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商户管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.shopCate.index")}}" >店铺分类</a></li>--}}
                        {{--<li><a href="{{route("admin.shop.index")}}" >用户状态</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{route("admin.user.index")}}">商户管理</a></li>--}}

                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单统计 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.order.day")}}" >订单日统计</a></li>--}}
                        {{--<li><a href="{{route("admin.order.month")}}" >订单月统计</a></li>--}}
                        {{--<li><a href="{{route("admin.order.total")}}" >订单总计</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品销量统计 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.order.mday")}}" >菜品日统计</a></li>--}}
                        {{--<li><a href="" >菜品月统计</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限及角色管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.per.index")}}" >权限列表</a></li>--}}
                        {{--<li><a href="{{route("admin.role.index")}}" >角色管理</a></li>--}}

                    {{--</ul>--}}
                {{--</li>--}}

            </ul>
            <!-- <form class="navbar-form navbar-left">
                 <div class="form-group">
                     <input type="text" class="form-control" placeholder="Search">
                 </div>
                 <button type="submit" class="btn btn-default">Submit</button>
             </form>-->
            <ul class="nav navbar-nav navbar-right">

                @auth("admin")
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("admin.admin.change_password")}}">修改个人密码</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="{{route("admin.admin.logout")}}">退出登录</a></li>
                        </ul>
                    </li>
                @endauth

                @guest("admin")
                    <li><a href="{{route("admin.admin.login")}}">登录</a></li>

                @endguest



            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
