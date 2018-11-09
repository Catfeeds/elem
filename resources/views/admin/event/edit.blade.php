@extends("admin.layouts.main")
@include('vendor.ueditor.assets')
@section("content")
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">抽奖活动名称</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" value="{{$event->title}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">最多报人人数</label>
            <div class="col-sm-10">
                <input type="text" name="num" class="form-control" value="{{$event->num}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <textarea  name="content" rows="5" cols="60">{{$event->content}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-10">
                <input type="date" name="start_time" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-10">
                <input type="date" name="end_time" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-10">
                <input type="date" name="prize_time" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">开奖状态</label>
            <div class="col-sm-10">
                <input type="radio" name="is_prize" value="1" <?php if(($event->is_prize==1)) echo "checked"?>>已开奖
                <input type="radio" name="is_prize" value="0" <?php if(($event->is_prize==0)) echo "checked"?>>未开奖
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
@endsection
