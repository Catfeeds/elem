@extends("admin.layouts.main")

@section("content")
    <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{$pers->name}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="intro" class="form-control" value="{{$pers->intro}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>
    </form>
@endsection