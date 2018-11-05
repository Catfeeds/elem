@extends("admin.layouts.main")

@section("content")
    <a href="{{route("admin.per.add")}}" class="btn btn-info">添加权限</a>
    <table  class="table table-bordered" >
        <tr>
            <th>权限ID</th>
            <th>权限名称</th>
            <th>权限详情</th>
            <th>操作</th>
        </tr>
        @foreach($pers as $per)
            <tr>
                <td>{{$per->id}}</td>
                <td>{{$per->name}}</td>
                <td>{{$per->intro}}</td>
                <td>
                    <a href="{{route("admin.per.edit",[$per->id])}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.per.del",[$per->id])}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection