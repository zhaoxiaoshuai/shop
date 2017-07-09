@extends('layouts.admin')

@section('content')
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl"><font><font>系统配置</font></font></div>
                <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                </div>
            </div>
            <div class="widget-body am-fr">

                <form method="post" action="{{ url('admin/config/1') }}" id="conf_form" class="am-form tpl-form-border-form tpl-form-border-br">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label"><font><font>网站标题</font></font><span class="tpl-form-line-small-title"><font><font>标题</font></font></span></label>
                        <div class="am-u-sm-9">
                            <input type="text" class="tpl-form-input" id="conf_title" name="conf_title" value="{{ $data->conf_title }}" placeholder="请输入标题文字">
                            <small><font><font>请填写标题文字10-20字左右。</font></font></small>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-intro" class="am-u-sm-3 am-form-label">网站描述</label>
                        <div class="am-u-sm-9">
                            <textarea class="" rows="10" id="conf_description" name="conf_description" value="" placeholder="请输入描述内容">{{ $data->conf_description }}</textarea>
                        </div>
                    </div>


                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label"><font><font>关键字</font></font><span class="tpl-form-line-small-title"><font><font>搜索引擎优化</font></font></span></label>
                        <div class="am-u-sm-9">
                            <input type="text" id="conf_keywords" name="conf_keywords" value="{{ $data->conf_keywords }}" placeholder="输入关键字">
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-weibo" class="am-u-sm-3 am-form-label"><font><font>网站LOGO</font></font><span class="tpl-form-line-small-title"><font><font>图片</font></font></span></label>
                        <div class="am-u-sm-9">
                            <div class="am-form-group am-form-file">
                                <div class="tpl-form-file-img">
                                    <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$data->conf_logo}}" name="logo_pic" id="logo_pic" alt="" >
                                    <input type="hidden" name="logo_thumb" value="" id="logo_thumb">
                                </div>
                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                    <i class="am-icon-cloud-upload"></i><font><font> 修改网站LOGO</font></font></button>
                                <input id="conf_logo" type="file" name="conf_logo"  value="" multiple="" >
                            </div>
                            <script>
                                $('#conf_logo').change(function(){

                                    uploadImage();
                                })

                                function uploadImage(){
                                    //判断是否有文件上传

                                    var imgPath = $('#conf_logo').val();
                                    if(imgPath == ''){
                                        alert('请选择图片上传');
                                        return;
                                    }

                                    //判断上传文件的后缀名
                                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                    if (strExtension != 'jpg' && strExtension != 'gif'
                                        && strExtension != 'png' && strExtension != 'bmp') {
                                        alert("请选择图片文件");
                                        return;
                                    }

                                    var formData = new FormData($('#conf_form')[0]);

                                    $.ajax({
                                        type: "POST",
                                        url: "admin/upload",
                                        data: formData,
                                        async: true,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        success: function(data) {
                                            // console.log(data);
                                            // alert("上传成功");
                                            $('#logo_pic').attr('src','http://php182.oss-cn-beijing.aliyuncs.com/'+data);
                                            $('#logo_thumb').val(data);

                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            alert("上传失败，请检查网络后重试");
                                        }
                                    });
                                }
                            </script>

                        </div>
                    </div>


                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success "><font><font>提交</font></font></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection