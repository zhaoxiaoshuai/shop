@extends('layouts.admin')

@section('content')
	<form class="am-form tpl-form-line-form" action="{{url('admin/mgood/'.$data->good_id)}}" method="post"  id="good_form" enctype="multipart/form-data">
        {{csrf_field()}}
        @if(session('error'))
            <p style="background:#f0ad4e">  {{session('error')}}</p>
        @endif
        <div class="am-form-group">
            <input type="hidden" name="_method" value="put">
            <label for="user-name" class="am-u-sm-3 am-form-label">商品名称 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="good_name" value="{{$data->good_name}}" readonly>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">商品分类 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <select data-am-selected="{searchBox: 0}"  name="type_id" disabled="disabled">
                    <option value="">请选择</option>
                    @foreach($types as $k=>$v)
                        <?php
                        $n = substr_count( $v['type_npath'] ,'-')-2;
                        $v['type_name'] = str_repeat('&nbsp;',$n*8).'|--'.$v['type_name'];
                        ?>
                        <option value="{{ $v['type_id'] }}" @if($v['type_id'] == $type['type_id'])   selected     @endif>
                            {{ $v['type_name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">商品状态 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <select data-am-selected="{searchBox: 0}"  name="good_status">
                    <option value="">请选择</option>
                        <option @if($data->good_status==2)  selected @endif value="2">下架</option>
                        <option @if($data->good_status==1)  selected @endif value="1">上架</option>
                        <option @if($data->good_status==0)  selected @endif value="0">新品</option>
                </select>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">商品价格 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="good_price" value="{{$data->good_price}}" readonly>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label"> 商品图片 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <div class="am-form-group am-form-file">
                    <table>
                        <tr>
                            <th>缩略图：</th>
                            <td>
                                <input type="text" name="good_pic" id="good_pic" style="width:300px;" value="{{$data->good_pic}}" readonly>
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
                    url: "/store/upload",
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
//                                    console.log(data);
//                                    alert("上传成功");

                        $('#pic').attr('src','http://php182.oss-cn-beijing.aliyuncs.com/'+data);

                        $('#pic').show();
                        $('#good_pic').val(data);

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
                                <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$data->good_pic}}" alt="" name="pic" id="pic" style="width:100px;" >
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">商品库存 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="good_count" placeholder="请输入商品库存" value="{{$data->good_count}}" readonly>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-intro" class="am-u-sm-3 am-form-label">商品描述</label>
            <table readonly>
                <tr>
                    <td>
                        {!! $data->good_desc !!}
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