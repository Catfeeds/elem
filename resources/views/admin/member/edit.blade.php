@extends("shop.layouts.main")

@section("content")
    <div class="container-fluid">

        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
        <div class="box-header with-border">
            <h3 class="box-title">菜品修改</h3>
        </div>
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">菜品名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="菜品名" name="goods_name" value="{{$menus->goods_name}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">所属商家</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="所属商家" name="type_accumulation" >
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">所属分类</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="所属分类" name="type_accumulation" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">价格</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="价格" name="goods_price"value="{{$menus->goods_price}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">描述</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="描述" name="description"  value="{{$menus->description}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">月销量</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="月销量" name="month_sales" value="{{$menus->month_sales}}" >
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">菜品图片</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="goods_img">
                    <img src="{{env("ALIYUN_OSS_URL").$menus->goods_img}}" alt="">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">满意度数量</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="满意度数量" name="satisfy_count"  value="{{$menus->satisfy_count}}">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">	满意度评分</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="	满意度评分" name="satisfy_rate" value="{{$menus->satisfy_rate}}">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">菜品状态</label>
                <div class="col-sm-10">
                    <input type="radio" name="status" value="1" <?php if($menus["status"]===1) echo "checked"?>>上架
                    <input type="radio" name="status" value="0" <?php if($menus["status"]===0) echo "checked"?> >未上架
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