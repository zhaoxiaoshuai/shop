@extends('layouts.admin')
@section('content')
    <form class="am-form tpl-form-line-form" action="{{url('admin/good')}}" method="post" enctype="multipart/form-data" id="good_form">
        {{csrf_field()}}
        @if (count($errors) > 0)
            <div class="mark" style="color:red;margin-left:300px" >
                <ul style="background-color: yellow">
                    @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        <li>{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif
        <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">商品名称 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="good_name" placeholder="请输入商品名称">
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">商品分类 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <select data-am-selected="{searchBox: 0}"  name="type_id">
                    <option value="">请选择</option>
                    @foreach($type as $k=>$v)
                        <?php
                        $n = substr_count( $v['type_npath'] ,'-')-2;
                        $v['type_name'] = str_repeat('&nbsp;',$n*8).'|--'.$v['type_name'];
                        ?>
                        <option value="{{ $v['type_id'] }}">{{ $v['type_name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">商品标签 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <select data-am-selected="{searchBox: 0}"  name="good_label">
                    <option value=""></option>
                    <option value="1" selected>家电</option>
                    <option value="2">服装</option>
                </select>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">商品状态 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <select data-am-selected="{searchBox: 0}"  name="good_status">
                    <option value=""></option>
                    <option value="2" selected>下架</option>
                    <option value="1">上架</option>
                    <option value="0">新品</option>
                </select>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">商品价格 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="good_price" placeholder="请输入商品价格">
                {{--<small>请填写标题文字10-20字左右。</small>--}}
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label"> 商品图片 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <div class="am-form-group am-form-file" style="width:500px">
                    <table>
                        <tr>
                            <th>点击上传商品大图：</th>
                            <td>
                                <input type="text" name="good_pic" id="good_pic" style="width:300px;" value="">
                                <input type="file" name="file_upload" id="file_upload" value="" ><br>
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

                                        var formData = new FormData($('#good_form')[0]);

                                        $.ajax({
                                            type: "POST",
                                            url: "/admin/goods/upload",
                                            data: formData,
                                            async: true,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(data) {
//                                    console.log(data);
//                                    alert("上传成功");
//                                                for(var i=0;i<data.length;i++){
//                                                    $('#pic').clone(true).insertAfter('#pic');
//                                                    $('#good_pic').clone(true).insertAfter('#good_pic');
                                                    $('#pic').attr('src','http://php182.oss-cn-beijing.aliyuncs.com/'+data);
                                                    $('#pic').show();
                                                    $('#good_pic').val(data);
//                                                }



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
                                <img src="" alt="" name="pic" id="pic" style="width:70px; height:100px; display:none;" >
                            </td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>
        <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">上传商品缩略图 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="file" class="tpl-form-input" id="user-name" name="good_pics[]" placeholder="点击上传商品缩略图" multiple>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">商品库存 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="good_count" placeholder="请输入商品库存">
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-intro" class="am-u-sm-3 am-form-label">商品描述</label>
            <table>
                <tr>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" type="text/plain" name="good_desc" style="width:800px;height:300px;"></script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>

                    </td>
                </tr>
            </table>
        </div>
        <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success " style="width:200px">提交</button>
            </div>
        </div>
    </form>
@endsection