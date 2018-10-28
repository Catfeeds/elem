@extends("admin.layouts.main")
@section('content')

    <h1 class="text-center">平台登录</h1>




        <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>

        <form class="form-horizontal" method="post" action="" >
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">管理员姓名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="管理员姓名" name="name" value="{{old("name")}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">登录</button>
                </div>
            </div>
        </form>


        </div>




@endsection