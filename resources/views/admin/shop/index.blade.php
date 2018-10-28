@extends("admin.layouts.main")

@section("content")


<br/><br/>
<table  class="table table-bordered" >
    <tr>
        <th>店铺编号</th>
        <th>店铺名称</th>
        <th>店铺类别</th>
        <th>店铺图片</th>
        <th>是否品牌</th>
        <th>是否蜂鸟</th>
        <th>商户名称</th>
        <th>审核状态</th>
        <th>操作</th>
    </tr>
    @foreach($shops as $shop)
        <tr>
            <td>{{$shop->id}}</td>
            <td>{{$shop->shop_name}}</td>
            @foreach($cates as $cate )
                <td>
                    @if($shop->shop_cate_id===$cate->id)
                    {{$cate->name}}
                    @endif
                </td>


                @endforeach

            <td><img src="/{{$shop->shop_img}}" height="70" alt=""></td>
            <td>{{$shop->brand}}</td>
            <td>{{$shop->fengniao}}</td>
            <td>{{$shop->user_id}}</td>
            <td>@if($shop->status == 1)
                    <spaan class="btn  btn-success">已审核</spaan>
                @elseif($shop->status == 0)
                    <span class="btn  btn-info">待审核</span>
                @elseif($shop->status == -1)
                    <span class="btn btn-danger">已禁用</span>
                @endif
            </td>
            <td>
                <a href="#" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>
                @if($shop->status===0)
                    <a href="{{route("admin.shop.changeStatus",["$shop->id"])}}" class="btn btn-success">通审</a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
{{--{{$users->links()}}--}}
@endsection