@extends("admin.layouts.main")
@section("title","商户注册")

@section("content")
    <div class="row">


        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">欢迎店铺申请</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="名称" name="shop_name">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺名</label>

                        <div class="col-sm-10">
                         <select name="shop_cate_id">
                             <option value="">请选择店铺类别</option>
                             @foreach($cates as $cate)
                                 <option value="{{$cate->id}}">{{$cate->name}}</option>

                             @endforeach
                         </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label">店铺图片</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="shop_img">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">起送金额</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="起送金额" name="start_send">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="配送费" name="send_cost">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺公告</label>

                        <div class="col-sm-10">
                            <textarea name="notice" cols="50" rows="5"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>

                        <div class="col-sm-10">
                            <textarea name="discount" cols="50" rows="5"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺信息</label>
                        <input type="checkbox" name="brand" value="1" @if (old("brand")==1) checked @endif>品牌连锁店
                        <input type="checkbox" name="on_time" value="1" @if (old("on_time")==1) checked @endif/>准时送达
                        <input type="checkbox" name="fengniao" value="1" @if (old("fengniao")==1) checked @endif/>蜂鸟配送
                        <input type="checkbox" name="bao" value="1" @if (old("bao")==1) checked @endif/>保
                        <input type="checkbox" name="piao" value="1" @if (old("piao")==1) checked @endif/>票
                        <input type="checkbox" name="zhun" value="1" @if (old("zhun")==1) checked @endif/>准
                    </div>

                <!-- /.box-body -->


                <div class="box-footer">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <button type="submit" class="btn btn-info pull-left">提交</button>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- /.box-footer -->
            </form>
        </div>

    </div>
@endsection
