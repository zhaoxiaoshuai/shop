@extends('layouts.StoreAdmin')

@section('content')
	<form class="am-form tpl-form-line-form" action="{{url('admin/good/'.$data->good_id)}}" method="post"  id="good_form">
        {{csrf_field()}}
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
                    <option value="1">{{$data->type_name}}</option>
                </select>
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">商品标签 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <input type="text" class="tpl-form-input" id="user-name" name="good_price" value="{{$mtype_name}}" readonly>
                
            </div>
        </div>
        <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">店铺商品分类 <span class="tpl-form-line-small-title"></span></label>
            <div class="am-u-sm-9">
                <select data-am-selected="{searchBox: 0}"  name="good_label" disabled="disabled">
                    <option value=""></option>
                    <option value="1">下架</option>
                    <option value="2">上架</option>
                    <option value="3">新品</option>
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
                            <th></th>
                            <td>
                                <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$data->good_pic}}" alt="" name="pic" id="pic" style="width:100px;" readonly>
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
        <div class="am-form-group" readonly="false">
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
				<button type="button" onclick="history.go(-1)" class="am-btn am-btn-primary tpl-btn-bg-color-success ">返回</button> 
			</div>
        </div>
    </form>
@endsection