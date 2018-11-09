@extends("admin.layouts.main")
@section("title","抽奖活动")
@section("content")
<a href="{{route("admin.event.add")}}" class="btn btn-info">添加抽奖活动</a>
<br/><br/>
    <table class="table">
        <tr>
            <th>活动编号</th>
            <th>活动标题</th>
            <th>活动内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>开奖时间</th>
            <th>报名人数限制</th>
            <th>是否开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->content}}</td>
                <td>{{date('Y-m-d H:i:s',$event->start_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$event->end_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$event->prize_time)}}</td>
                <td>{{$event->num}}</td>
                <td>
                @if($event->is_prize == 0)
                        <a href="{{route("admin.event.open",[$event->id])}}" class="btn btn-danger">未开奖</a>
                @elseif($event->is_prize == 1)
                        <a href="#" class="btn btn-info">已开奖</a>
                @endif
                </td>
                <td>
                    <a href="{{route("admin.event.edit",[$event->id])}}" class="btn btn-info">编辑</a>
                    <a href="{{route("admin.event.del",[$event->id])}}" class="btn btn-danger">删除</a>
                    <a href="{{route("admin.event.result",[$event->id])}}" class="btn btn-danger">中奖情况</a>

                </td>
            </tr>
        @endforeach

    </table>


@endsection

