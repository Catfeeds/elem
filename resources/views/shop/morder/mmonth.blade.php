@extends("shop.layouts.main")

@section("content")

                <br/><br/>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>日期</th>
                            <th>菜品订单数</th>
                            <th>总收入</th>
                        </tr>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{$data->date}}</td>
                                <td>{{$data->nums}}</td>
                                <td>{{$data->money}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection