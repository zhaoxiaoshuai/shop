@extends('layouts.admin')

@section('content')
    <form class="am-form tpl-form-line-form" action="{{url('admin/carousel/'.$data->id)}}" method="post" enctype="multipart/form-data" id="carousel_form">
        {{csrf_field()}}
        @if(session('error'))
            <p style="background:#f0ad4e">  {{session('error')}}</p>
        @endif
        <div class="am-form-group">
            <input type="hidden" name="_method" value="put">
            <label for="user-name" class="am-u-sm-3 am-form-label">轮播图片名称 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="carousel_name" placeholder="请输入轮播图名称" value="{{ $data->carousel_name }}">
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">轮播图片链接 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="carousel_url" placeholder="请输入图片链接" value="{{ $data->carousel_url }}">
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label"> 轮播图片来源 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <div class="am-form-group am-form-file" style="width:700px">
                    <table style="width:700px">
                        <tr >
                            <th>点击选择图片：</th>
                            <td>
                                <input type="text" name="carousel_pic" id="carousel_pic" style="width:500px;" value="{{ $data->carousel_pic }}">
                                <input type="file" name="file_upload" id="file_upload" value="">
                                <script type="text/javascript">
                                    $(function () {
                                        $("#file_upload").change(function () {

                                            uploadImage();
                                        });
                                    });

                                    function uploadImage() {
//                            判断是否有选择上传文件
                                        var imgPath = $("#file_upload").val();
                                        if (imgPath == "") {
                                            alert("请选择上传图片！");
                                            return;
                                        }
                                        //判断上传文件的后缀名
                                        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                        if (strExtension != 'jpg' && strExtension != 'gif'
                                            && strExtension != 'png' && strExtension != 'bmp') {
                                            alert("请选择图片文件");
                                            return;
                                        }

                                        var formData = new FormData($('#carousel_form')[0]);

                                        $.ajax({
                                            type: "POST",
                                            url: "/admin/upload",
                                            data: formData,
                                            async: true,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(data) {
//                                    console.log(data);
//                                    alert("上传成功");
                                                $('#pic').attr('src','http://php182.oss-cn-beijing.aliyuncs.com/'+data);
                                                $('#carousel_pic').val('http://php182.oss-cn-beijing.aliyuncs.com/'+data);

                                            },
                                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                alert("上传失败，请检查网络后重试");
                                            }
                                        });
                                    }

                                </script>

                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <img src="{{ $data->carousel_pic }}" alt="" name="pic" id="pic" style="width:200px;" >
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

        <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success " style="width:200px">提交</button>
            </div>
        </div>
    </form>
    @endsection