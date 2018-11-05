@extends("admin.layouts.main")

@section("content")
    <a href="{{route("admin.role.add")}}" class="btn btn-info">添加权限</a>
    <table  class="table table-bordered" >
        <tr>
            <th>角色ID</th>
            <th>角色名称</th>
            <th>角色权限</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{ str_replace(['[',']','"'],'', $role->permissions()->pluck('name')) }}</td>


                <td>
                    <a href="{{route("admin.role.edit",[$role->id])}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.role.del",[$role->id])}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection