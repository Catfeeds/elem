<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/shop/dist/img/user1-128x128.jpg" alt="User Image">
            </div>
            <div class="pull-left info">

                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">控制模块</li>

            <li class="treeview">
                <a href="">
                    <i class="fa fa-dashboard"></i> <span>菜品分类管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("shop.menuCate.index")}}"><i class="fa fa-circle-o"></i> 菜品分类列表</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i> 其他</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>菜品</span>
                    <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("shop.menu.index")}}"><i class="fa fa-circle-o"></i> 菜品列表</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i>其他 </a></li>
                </ul>
            </li>
            <li class="header">火爆活动</li>
            <li><a href="{{route("shop.active.index")}}"><i class="fa fa-circle-o text-red"></i> <span>活动列表</span></a></li>
            <li><a href="{{route("shop.event.index")}}"><i class="fa fa-circle-o text-red"></i> <span>抽奖活动列表</span></a></li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>商家订单统计</span>
                    <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("shop.order.index")}}"><i class="fa fa-circle-o text-red"></i> <span>订单列表</span></a></li>
                    <li><a href="{{route("shop.order.day")}}"><i class="fa fa-circle-o text-red"></i> <span>按日统计</span></a></li>
                    <li><a href="{{route("shop.order.month")}}"><i class="fa fa-circle-o text-red"></i> <span>按月统计</span></a></li>
                    <li><a href="{{route("shop.order.total")}}"><i class="fa fa-circle-o text-red"></i> <span>总计</span></a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>菜品销量统计</span>
                    <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("shop.morder.mday")}}"><i class="fa fa-circle-o text-red"></i> <span>按日统计</span></a></li>
                    <li><a href="{{route("shop.morder.mmonth")}}"><i class="fa fa-circle-o text-red"></i> <span>按月统计</span></a></li>
                    <li><a href="{{route("shop.morder.menuTotal")}}"><i class="fa fa-circle-o text-red"></i> <span>总计</span></a></li>
                </ul>
            </li>








        </ul>
    </section>
    <!-- /.sidebar -->
</aside>