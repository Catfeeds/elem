@extends("admin.layouts.main")
@section("title","抽奖活动")
@section("content")
<a href="{{route("admin.event_prize.add")}}" class="btn btn-info">添加活动奖品</a>
<br/><br/>
    <table class="table">
        <tr>
            <th>奖品编号</th>
            <th>活动ID</th>
            <th>奖品名称</th>
            <th>奖品详情</th>

            <th>操作</th>
        </tr>
        @foreach($prizes as $prize)
            <tr>
                <td>{{$prize->id}}</td>
                <td>{{$prize->event_id}}</td>
                <td>{{$prize->name}}</td>
                <td>{{$prize->description}}</td>


                <td>
                    <a href="{{route("admin.event_prize.edit",[$prize->id])}}" class="btn btn-info">编辑</a>
                    <a href="{{route("admin.event_prize.del",[$prize->id])}}" class="btn btn-danger">删除</a>



                </td>
            </tr>
        @endforeach

    </table>


@endsection

