@extends("admin.layouts.main")

@section("content")
    <div class="row">
        <div class="col-md-4">
            <a href="{{route("admin.active.add")}}" class="btn btn-info">添加活动</a>
        </div>
        <div class="col-md-8">
            <form class="form-inline pull-right" method="get">
                <div class="form-group">
                    <select name="time" class="form-control">
                        <option value="">请选择时间</option>
                        {{--@foreach($cate as $a)--}}
                            {{--<option value="{{$a->id}}">{{$a->name}}</option>--}}
                        {{--@endforeach--}}
                        <option value="1">活动进行中</option>
                        <option value="2">已结束活动</option>
                        <option value="3">未开展活动</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>

    <br/><br/>

    <br/> <br/>
<table  class="table table-bordered" >
    <tr>
        <th>活动ID</th>
        <th>活动名称</th>
        <th>活动详情</th>
        <th>活动开始时间</th>
        <th>活动结束时间</th>
        <th>操作</th>
    </tr>
    @foreach($actives as $active)
        <tr>
            <td>{{$active->id}}</td>
            <td>{{$active->titlie}}</td>
            <td>{!! $active->content !!}</td>
            <td>{{$active->start_time}}</td>
            <td>{{$active->end_time}}</td>
            <td>
                <a href="{{route("admin.active.edit",["$active->id"])}}" class="btn btn-success">编辑</a>
                <a href="{{route("admin.active.del",["$active->id"])}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
</table>
    {{$actives->appends($url)->links()}}
@endsection