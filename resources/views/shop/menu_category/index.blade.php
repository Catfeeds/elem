@extends("shop.layouts.main")

@section("content")

<a href="/menuCate/add" class="btn btn-info">添加</a>
<br/><br/>
<table  class="table table-bordered" >
    <tr>
        <th>菜品ID</th>
        <th>菜品分类名</th>
        <th>菜品编号</th>
        <th>所属商家</th>
        <th>描述</th>
        <th>是否是默认分类</th>
        <th>操作</th>
    </tr>
    @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->name}}</td>
            <td>{{$menu->type_accumulation}}</td>
            <td>{{$menu->shop_id}}</td>
            <td>{{$menu->description}}</td>
            <td>{{$menu->is_selected}}</td>
            <td>
                <a href="{{route("shop.menuCate.edit",["$menu->id"])}}" class="btn btn-success">编辑</a>
                <a href="{{route("shop.menuCate.del",["$menu->id"])}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
</table>
{{$menus->links()}}
@endsection