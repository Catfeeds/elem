@extends("admin.layouts.main")

@section("content")
    <div class="container-fluid">


        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>

        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">分类名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="分类名称" name="name" >
                </div>
            </div>


            <div class="form-group">
                <label  class="col-sm-2 control-label">店铺图片</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="img">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">店铺状态</label>
                <div class="col-sm-10">
                    <input type="radio" name="status" value="1">营业
                    <input type="radio" name="status" value="0">未营业
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