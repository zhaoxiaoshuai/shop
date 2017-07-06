@extends('admin.layouts.index')

@section('content')
<div class="row-content am-cf">
  <div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
      <div class="widget am-cf">
        <div class="widget-head am-cf">
          <div class="widget-title  am-cf">查看分类</div></div>
        <div class="widget-body  am-fr">
          <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
            <div class="am-form-group">
              <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                  <button type="button" class="am-btn am-btn-default am-btn-success">
                    <a href="{{url('admin/atype/create')}}"><span class="am-icon-plus"></span>新增</a></button>
                </div>
              </div>
            </div>
          </div>
          <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
            <div class="am-form-group tpl-table-list-select">
              <select data-am-selected="{btnSize: 'sm'}" style="display: none;">
                <option value="option1">所有类别</option>
                <option value="option2">IT业界</option>
                <option value="option3">数码产品</option>
                <option value="option3">笔记本电脑</option>
                <option value="option3">平板电脑</option>
                <option value="option3">只能手机</option>
                <option value="option3">超极本</option>
              </select>
              
            </div>
          </div>
          <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
              <input type="text" class="am-form-field ">
              <span class="am-input-group-btn">
                <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
              </span>
            </div>
          </div>
          <div class="am-u-sm-12">
            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">

              <thead>

                <tr>
                  <th>ID</th>
                  <th>分类名称</th>
                  <th>是否显示</th>
                  <th>分类描述</th>
                  <th>操作</th>
                </tr>

              </thead>
               @foreach($data as $k=>$v)

              <tbody>
                <tr class="gradeX">
                  <td>{{ $v['type_id'] }}</td>
                  <td>{{ $v['type_name'] }}</td>
                  <td>{{ $v['type_show'] }}</td>
                  <td>{{ $v['type_describe'] }}</td>
                    
                <td>
                    <div class="tpl-table-black-operation">
                      <a href="{{ url('admin/atype/'.$v['type_id'].'/edit')}}">
                        <i class="am-icon-pencil"></i>编辑</a>
                      <a href="javascript:;" onclick="DelType({{ $v['type_id'] }})" class="tpl-table-black-operation-del">
                        <i class="am-icon-trash"></i>删除</a>
                    </div>
                  </td>
                </tr>
                
                
                
                
                
                <!-- more data --></tbody>
                @endforeach
            </table>
          </div>
          <div class="am-u-lg-12 am-cf">
            <div class="am-fr">
              <ul class="am-pagination tpl-pagination">
                <li class="am-disabled">
                  <a href="#">«</a></li>
                <li class="am-active">
                  <a href="#">1</a></li>
                <li>
                  <a href="#">2</a></li>
                <li>
                  <a href="#">3</a></li>
                <li>
                  <a href="#">4</a></li>
                <li>
                  <a href="#">5</a></li>
                <li>
                  <a href="#">»</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function DelType(type_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){ 
                //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                $.post("{{url('admin/atype/1')}}/"+type_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
                if(data.status == 0){
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 6});
                }else{
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 5});
                }
                });


            }, function(){

            });

        }
</script>
@endsection