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
                <label for="username" class="col-sm-2 control-label">所属分类</label>
                <div class="col-sm-10">
               <select name="category_id" class="form-control">
                  <option value="1">请选择类别</option>
                        @foreach($cate as $cat)
                       <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
               </select>
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
                    <input type="text" name="goods_img" value="" id="logo">
                    <!--dom结构部分-->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                    </div>
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
@section("js")
    <script>
        // 图片上传demo
        jQuery(function () {
            var $ = jQuery,
                $list = $('#fileList'),
                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,

                // 缩略图大小
                thumbnailWidth = 100 * ratio,
                thumbnailHeight = 100 * ratio,

                // Web Uploader实例
                uploader;

            // 初始化Web Uploader
            uploader = WebUploader.create({

                // 自动上传。
                auto: true,

                formData: {
                    // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
                    _token:'{{csrf_token()}}'
                },


                // swf文件路径
                swf: '/webuploader/Uploader.swf',

                // 文件接收服务端。
                server: '{{route("shop.user.upload")}}',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 只允许选择文件，可选。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            // 当有文件添加进来的时候
            uploader.on('fileQueued', function (file) {
                var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                    ),
                    $img = $li.find('img');

                $list.html($li);

                // 创建缩略图
                uploader.makeThumb(file, function (error, src) {
                    if (error) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }

                    $img.attr('src', src);
                }, thumbnailWidth, thumbnailHeight);
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = $('#' + file.id),
                    $percent = $li.find('.progress span');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = $('<p class="progress"><span></span></p>')
                        .appendTo($li)
                        .find('span');
                }

                $percent.css('width', percentage * 100 + '%');
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on('uploadSuccess', function (file,data) {
                $('#' + file.id).addClass('upload-state-done');

                $("#logo").val(data.url);
            });

            // 文件上传失败，现实上传出错。
            uploader.on('uploadError', function (file) {
                var $li = $('#' + file.id),
                    $error = $li.find('div.error');

                // 避免重复创建
                if (!$error.length) {
                    $error = $('<div class="error"></div>').appendTo($li);
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress').remove();
            });
        });
    </script>
@stop