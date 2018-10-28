@extends("admin.layouts.main")

@section("content")

<a href="/shopCate/add" class="btn btn-info">添加</a>

<table  class="table table-bordered" >
    <tr>
        <th>店铺编号</th>
        <th>店铺名</th>
        <th>店铺图片</th>
        <th>店铺状态</th>
        <th>操作</th>
    </tr>
    @foreach($cates as $cate)
        <tr>
            <td>{{$cate->id}}</td>
            <td>{{$cate->name}}</td>
            <td><img src="/{{$cate->img}}" height="70" alt=""></td>
            <td>@if($cate->status == 1)
                    <spaan class="btn  btn-success">营业中</spaan>
                @elseif($cate->status == 0)
                    <span class="btn  btn-info">未营业</span>
                @endif
            </td>
            <td>
                <a href="{{route("admin.shopCate.edit",["$cate->id"])}}" class="btn btn-success">编辑</a>
                <a href="{{route("admin.shopCate.del",["$cate->id"])}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
</table>
{{$cates->links()}}
@endsection