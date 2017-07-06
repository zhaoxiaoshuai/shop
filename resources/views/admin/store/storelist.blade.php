@extends('layouts.admin')

@section('content')
  <div class="row-content am-cf"> 
   <div class="row"> 
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
     <div class="widget am-cf"> 
      <div class="widget-head am-cf"> 
       <div class="widget-title  am-cf">
        文章列表
       </div> 
      </div>
      <form>
      	<div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
       <div>搜索</div> 
        <div action="{{ url('admin/astore') }}" method="get" class="am-form-group tpl-table-list-select" style="margin-left:50px;margin-top:-25px;"> 
         <select name="keywords1" data-am-selected="{btnSize: 'sm'}" style="display: none;">
         	<option value=" ">入驻商等级</option>
         	<option value="1">初级</option>
         	<option value="2">中级</option>
         	<option value="3">高级</option>
         </select> 
        </div> 
       </div>
       <div class="am-u-sm-12 am-u-md-12 am-u-lg-3" style="right:455px;"> 
        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p" > 
         <input type="text" name="keywords2" class="am-form-field" placeholder="请输入店铺名称" /> 
         <span class="am-input-group-btn"> <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit">搜索</button> </span> 
        </div> 
       </div>
      </form> 
        
       <div class="am-u-sm-12"> 
        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r"> 
         <thead> 
          <tr> 
           	<th>会员名称</th> 
        	<th>入驻商用户</th> 
        	<th>店铺名称</th> 
        	<th>店铺等级</th> 
        	<th>联系电话</th> 
        	<th>平台使用费</th> 
        	<th>分成利率</th>
        	<th>状态</th>
        	<th>状操作</th> 
          </tr> 
         </thead> 
         <tbody>
         <?php 
      		$arr = ['1'=>'未审核','审核通过','审核不通过'];
      		$arr2 = ['1'=>'初级','中级','高级'];
      		?>
      	@foreach($data as $k=>$v) 
          <tr class="gradeX"> 
          	<td>{{ $v['user_name'] }}</td> 
        	<td>{{ $v['store_username'] }}</td> 
        	<td>{{ $v['merchant_name'] }}</td> 
        	<td>{{ $arr2[$v['merchant_leverl']] }}</td> 
        	<td>{{ $v['store_phone'] }}</td> 
        	<td>{{ $v['platform_use_fee'] }}</td> 
        	<td>{{ $v['percent'] }}</td> 
        	<td>{{ $arr[$v['audit_status']] }}</td> 
           <td> 
            <div class="tpl-table-black-operation"> 
             <a href="{{ url('admin/astoreindex/'.$v['store_id']) }}"> <i class=""></i> 查看 </a> 
             <a href="javascript:;"> <i class=""></i> 店铺 </a>
             <a href="javascript:;" onclick="DelStore({{ $v['store_id'] }})" class="tpl-table-black-operation-del"> <i class="am-icon-trash"></i> 删除 </a> 
            </div> </td> 
          </tr> 
        @endforeach
          <!-- more data --> 
         </tbody> 
        </table> 
       </div>
       <?php
                    $key1 = empty($key1)?'':$key1;
                	
                    ?>
       <div class="am-u-lg-12 am-cf" style="float:left;">
        {!! $data->appends(['keywords1' => $key1])->render() !!}
        <div class="am-fr"> 
         <ul class="am-pagination tpl-pagination"> 
          <li class="am-disabled"><a href="#">&laquo;</a></li> 
          <li class="am-active"><a href="#">1</a></li> 
          <li><a href="#">2</a></li> 
          <li><a href="#">3</a></li> 
          <li><a href="#">4</a></li> 
          <li><a href="#">5</a></li> 
          <li><a href="#">&raquo;</a></li> 
         </ul> 
        </div> 
       </div> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div>

  <script type="text/javascript">
  	
  	function DelStore(store_id){
  		// 询问框
  		layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                // url ==> admin/astore/{astore}   http://project182.com/admin/user/2
                $.post("{{url('admin/astore/')}}/"+store_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
                if(data.status == 0){
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 5});
                }else{
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 6});
                }
                });


            }, function(){

            });
  	};
  </script>
@endsection