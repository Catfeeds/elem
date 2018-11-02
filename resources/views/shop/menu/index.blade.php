@extends("shop.layouts.main")

@section("content")
    <div class="row">
        <div class="col-md-4">
            <a href="/menu/add" class="btn btn-info">添加</a>
        </div>
        <div class="col-md-8">
            <form class="form-inline pull-right" method="get">
                <div class="form-group">
                    <select name="shop_id" class="form-control">
                        <option value="">请选择分类</option>
                        @foreach($cate as $a)
                            <option value="{{$a->id}}">{{$a->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{request()->get("minPrice")}}">
                </div>
                -
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice"  value="{{request()->get("maxPrice")}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keword")}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>
    <br/><br/>

<table  class="table table-bordered" >
    <tr>
        <th>菜品ID</th>
        <th>菜品名</th>
        <th>所属分类</th>
        <th>价格</th>
        <th>描述</th>
        <th>月销量</th>
        <th>菜品图片</th>
        <th>满意度数量</th>
        <th>满意度评分</th>
        <th>菜品状态</th>
        <th>操作</th>
    </tr>
    @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->goods_name}}</td>
            <td>
                {{$menu->cate->name}}
            </td>
            <td>{{$menu->goods_price}}</td>
            <td>{{$menu->description}}</td>
            <td>{{$menu->month_sales}}</td>
              <td> <img src="{{$menu->goods_img}}" height="60" alt=""></td>
            {{--<td><img src="{{env("ALIYUN_OSS_URL").$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_40,h_40" height="60" width="60"></td>--}}
            <td>{{$menu->satisfy_count}}</td>
            <td>{{$menu->satisfy_rate}}</td>
            <td>@if($menu->status == 1)
                    <span class="btn  btn-success">已上架</span>
                @elseif($menu->status == 0)
                    <span class="btn  btn-info">未上架</span>
                @endif
            </td>
            <td>
                <a href="{{route("shop.menu.edit",["$menu->id"])}}" class="btn btn-success">编辑</a>
                <a href="{{route("shop.menu.del",["$menu->id"])}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
</table>
    {{$menus->appends($url)->links()}}
@endsection