@extends("admin.layouts.main")
@section("title","商户注册")

@section("content")
    <div class="row">


        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">管理员修改</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="用户名" name="name" value="{{$admin->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="{{$admin->email}}">
                        </div>
                    </div>


                <!-- /.box-body -->


                <div class="box-footer">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <button type="submit" class="btn btn-info pull-left">修改</button>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- /.box-footer -->
            </form>
        </div>

    </div>
@endsection
