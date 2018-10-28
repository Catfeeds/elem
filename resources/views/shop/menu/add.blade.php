@extends("shop.layouts.main")

@section("content")
    <div class="container-fluid">

        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
        <div class="box-header with-border">
            <h3 class="box-title">菜品添加</h3>
        </div>
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">菜品名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="菜品名" name="goods_name" >
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
                    <input type="text" class="form-control" id="name" placeholder="价格" name="goods_price" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">描述</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="描述" name="description" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">月销量</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="月销量" name="month_sales" >
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">菜品图片</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="goods_img">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">满意度数量</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="满意度数量" name="satisfy_count" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">	满意度评分</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="	满意度评分" name="satisfy_rate" >
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">菜品状态</label>
                <div class="col-sm-10">
                    <input type="radio" name="status" value="1">上架
                    <input type="radio" name="status" value="0" >未上架
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