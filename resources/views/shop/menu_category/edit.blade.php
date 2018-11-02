@extends("shop.layouts.main")

@section("content")
    <div class="container-fluid">


        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
        <div class="box-header with-border">
            <h3 class="box-title">菜品分类修改</h3>
        </div>
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">菜品名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="菜品名称" name="name" value="{{$cates->name}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">菜品编号</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="菜品编号" name="type_accumulation" value="{{$cates->type_accumulation}}">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">描述</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="描述" name="description" value="{{$cates->description}}">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">是否是默认分类</label>
                <div class="col-sm-10">
                    <input type="radio" name="is_selected" value="是" <?php if($cates["is_selected"]===1) echo "checked"?>>是
                    <input type="radio" name="is_selected" value="否" <?php if($cates["is_selected"]===0)echo "checked"?>>否
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">修改</button>
                </div>
            </div>
        </form>


    </div>




@endsection