@extends("shop.layouts.main")

@section("content")
    @include('vendor.ueditor.assets')
    <div class="container-fluid">

        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
        {{--<div class="box-header with-border">--}}
            {{--<h3 class="box-title">活动添加</h3>--}}
        {{--</div>--}}
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}


            {{--<!-- 实例化编辑器 -->--}}
                {{--<script type="text/javascript">--}}
                    {{--var ue = UE.getEditor('container');--}}
                    {{--ue.ready(function() {--}}
                        {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.--}}
                    {{--});--}}
                {{--</script>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="username" class="col-sm-2 control-label">活动详情</label>--}}
                    {{--<div class="col-sm-10">--}}
                        {{--<!-- 编辑器容器 -->--}}
                        {{--<script id="container" name="content" type="disabled">{{$active->content}}</script>--}}
                    {{--</div>--}}
                {{--</div>--}}
                  <textarea name="content" cols="30" rows="5">{!! $active->content !!}</textarea>

        </form>


    </div>




@endsection
