@extends('layouts.StoreAdmin')

@section('content')
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
	<div class="widget am-cf"> 
		<div class="widget-head am-cf"> 
			<div class="widget-title am-fl">
				店铺基本设置
			</div> 
			<div class="widget-function am-fr"> 
				<a href="javascript:;" class="am-icon-cog"></a> 
			</div> 
		</div>
		@if(session('error'))
            <p style="background:#f0ad4e">  {{session('error')}}</p>
        @endif 
    <div class="widget-body am-fr">
   
	<form action="{{ url('store/setup/basicsetup') }}" method="post" class="am-form tpl-form-border-form tpl-form-border-br" id="mer_form">
	{{ csrf_field() }}
	<input type="hidden" name="merchant_id" value="{{ $data['merchant_id'] }}">
		<div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label"> 店铺logo <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <div class="am-form-group am-form-file" style="width:500px">
                    <table>
                        <tbody><tr>
                            <td>
                                <input type="text" name="merchant_logo" id="merchant_logo" style="width:300px;" value="{{ $data['merchant_logo'] }}">
                                <input type="file" name="file_upload1" id="file_upload1" value=""><br>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <img src="" alt="" name="logo_pic" id="logo_pic" style="width:70px;margin-left:-280px; height:70px; display:none;">
                            </td>
                        </tr>

                    </tbody></table>
                </div>

            </div>
        </div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺名称</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="merchant_name" value="{{ $data['merchant_name'] }}" class="tpl-form-input am-margin-top-xs " id="user-name" placeholder="" /> 
			</div> 
		</div> 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺标题</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="merchant_title" value="{{ $data['merchant_title'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺关键字</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="merchant_keywords" value="{{ $data['merchant_keywords'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label"> 店铺头部图片 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <div class="am-form-group am-form-file" style="width:500px">
                    <table>
                        <tbody><tr>
                            <td>
                                <input type="text" name="merchant_pic" id="merchant_pic" style="width:300px;" value="{{ $data['merchant_pic'] }}">
                                <input type="file" name="file_upload2" id="file_upload2" value=""><br>
                                

                               

                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <img src="" alt="" name="pic2" id="pic2" style="width:708px;margin-left:-324px; height:150px; display:none;">
                            </td>
                        </tr>

                    </tbody></table>
                </div>

            </div>
        </div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">客服QQ</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="service_qq" value="{{ $data['service_qq'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">客服电话</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="service_phone" value="{{ $data['service_phone'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-phone" class="am-u-sm-3 am-form-label">店铺类型</label> 
			<div class="am-u-sm-9"> 
			<select name="merchant_style" style="color:black;">
				<option @if($data['merchant_style']==1) selected @endif value="1">包包</option>
				<option @if($data['merchant_style']==2) selected @endif value="2">配饰</option>
				<option @if($data['merchant_style']==3) selected @endif value="3">内衣</option>
				<option @if($data['merchant_style']==4) selected @endif value="4">运动户外</option>
				<option @if($data['merchant_style']==5) selected @endif value="5">男装</option>
				<option @if($data['merchant_style']==6) selected @endif value="6">女装</option>
				<option @if($data['merchant_style']==7) selected @endif value="7">家用电器</option>
				<option @if($data['merchant_style']==8) selected @endif value="8">手机数码</option>
				<option @if($data['merchant_style']==9) selected @endif value="9">鞋子</option>
				<option @if($data['merchant_style']==10) selected @endif value="10">家居建材</option>
				<option @if($data['merchant_style']==11) selected @endif value="11">食品</option>
			</select>
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-phone" class="am-u-sm-3 am-form-label">店铺营业状态</label> 
			<div class="am-u-sm-9"> 
			<select name="close_merchant" style="color:black;">
				<option @if($data['close_merchant']==1) selected @endif value="1">营业中</option>
				<option @if($data['close_merchant']==2) selected @endif value="2">非营业</option>
			</select>
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">关闭店铺的原因</label> 
			<div class="am-u-sm-9"> 
				<textarea class="" name="close_reason" value="" rows="10" id="user-intro" placeholder="">{{ $data['close_reason'] }}</textarea> 
			</div> 
		</div>
		
		<div class="am-form-group"> 
			<div class="am-u-sm-9 am-u-sm-push-3"> 
				<button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">确定</button> 
			</div>
		</div>
		
	</form>
    </div> 
	</div> 
   </div>
   <script type="text/javascript">
    $(function () {
        $("#file_upload1").change(function () {
        	var img = $('#logo_pic');
        	var path = $('#merchant_logo');
        	var file_upload = $(this);
            uploadImage(file_upload,img,path);
        });
        $("#file_upload2").change(function () {
        	var img = $('#pic2');
        	var path = $('#merchant_pic');
        	var file_upload = $(this);
            uploadImage(file_upload,img,path);
        });
    });

    function uploadImage(file_upload,img,path) {
		//判断是否有选择上传文件
        var imgPath = file_upload.val();
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
        var name = file_upload.attr('name');
        var formData = new FormData($('#mer_form')[0]);
        $.ajax({
            type: "POST",
            url: "/store/setup/upload/"+name,
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
				// alert("上传成功");
                img.attr('src','http://php182.oss-cn-beijing.aliyuncs.com/'+data);
                img.show();
                path.val(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("上传失败，请检查网络后重试");
            }
        });
    }
</script>
@endsection
