@extends("admin.layouts.main")

@section("content")
    <div class="container-fluid">

        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
        <div class="box-header with-border">
            <h3 class="box-title">活动添加</h3>
        </div>
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="titlie" class="col-sm-2 control-label">活动名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="titlie" placeholder="活动名称" name="titlie" >
                </div>
            </div>

            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">活动详情</label>
                <div class="col-sm-10">
                    <!-- 编辑器容器 -->
                    <script id="container" name="content" type="text/plain" ></script>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">活动开始时间</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="name" placeholder="活动开始时间" name="start_time" >
                </div>
            </div>
            <div class="form-group">
                <label for="send_time" class="col-sm-2 control-label">活动结束时间</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="end_time" placeholder="活动结束时间" name="end_time" >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">添加</button>
                </div>
            </div>
        </form>


    </div>




@endsection
