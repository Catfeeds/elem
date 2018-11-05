@extends("shop.layouts.main")

@section("content")
    <div class="col-md-15">
        <form class="form-inline pull-right" method="get">
            <div class="form-group">
                <select name="status" class="form-control">
                    <option value="">订单状态</option>
                    @foreach(\App\Models\Order::$statusText as $k=>$v)
                        <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
            </div>
            <button type="submit" class="btn btn-primary">搜索</button>
        </form>
    </div>
    <br/><br/>

<table  class="table table-bordered" >
    <tr>
        <th>ID</th>
        <th>订单编号</th>
        <th>地址</th>
        <th>姓名</th>
        <th>电话</th>
        <th>金额</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_code}}</td>
            <td>{{$order->detail_address}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->tel}}</td>
            <td>{{$order->total}}</td>
            <td>@if($order->status == -1)
                    <span class="btn  btn-danger">已取消</span>
                @elseif($order->status == 0)
                    <span class="btn  btn-default">代付款</span>
                @elseif($order->status == 1)
                    <span class="btn  btn-info">代发货</span>
                @elseif($order->status == 2)
                    <span class="btn  btn-info">待确认</span>
                @elseif($order->status == 3)
                    <span class="btn  btn-success">完成</span>
                @endif
                {{---1=>"已取消",0=>"代付款",1=>"代发货", 2 => "待确认", 3 => "完成"--}}
            </td>
            <td>
                @if($order->status==0)<a href="{{route("order.changeStatus",[$order->id,1])}}" class="btn btn-info">发货</a>@endif
                @if($order->status==1)<a href="{{route("order.changeStatus",[$order->id,2])}}" class="btn btn-info">确认</a>@endif
                @if($order->status==2)<a href="{{route("order.changeStatus",[$order->id,3])}}" class="btn btn-info">完成</a>@endif

            @if($order->status!==-1 && $order->status!==3)
                    <a href="{{route('order.changeStatus',[$order->id,-1])}}"
                       class="btn btn-sm btn-danger">取消</a>
                @endif

            </td>
        </tr>
    @endforeach
</table>
    {{$orders->links()}}
@endsection
