@extends("shop.layouts.main")

@section("content")

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
                <a href="{{route("shop.active.look",["$active->id"])}}" class="btn btn-success">查看</a>

            </td>
        </tr>
    @endforeach
</table>
    {{--{{$actives->appends($url)->links()}}--}}
@endsection