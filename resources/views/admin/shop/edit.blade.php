@extends("admin.layouts.main")

@section("content")
    <div class="container-fluid">


        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">店铺名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="店铺名称" name="shop_name" value="{{$shops->shop_name}}" >
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label">店铺图片</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="shop_img">
                    <img src="/{{$shops->logo}}" alt="">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">是否品牌</label>
                <div class="col-sm-10">
                    <input type="radio" name="brand" value="是" <?php if($shops["brand"]===1) echo "checked"?>>是
                    <input type="radio" name="brand" value="否" <?php if($shops["brand"]===0)echo "checked"?>>否
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">是否蜂鸟</label>
                <div class="col-sm-10">
                    <input type="radio" name="fengniao" value="是" <?php if($shops["fengniao"]===1) echo "checked"?>>是
                    <input type="radio" name="fengniao" value="否" <?php if($shops["fengniao"]===0)echo "checked"?>>否
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">审核状态</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="审核状态" name="status" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">商户名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="商户名称" name="user_id" >
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