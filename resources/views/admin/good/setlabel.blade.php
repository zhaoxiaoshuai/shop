@extends('layouts.admin')

@section('content')
    <div class="widget-body am-fr">

        <form action="{{ url('admin/good/dosetlabel') }}" method="POST" class="am-form tpl-form-border-form tpl-form-border-br">
            @if (count($errors) > 0)
                <ul style="margin-left:350px;color:red">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            {{ csrf_field() }}
            @foreach($arr as $k=>$v)
            <input type="hidden" name='good_id' value='{{$id}}'>
             <div class="am-form-group">
                <label for="user-phone" class="am-u-sm-3 am-form-label">{{$v['label_name']}} <span class="tpl-form-line-small-title"></span></label>
                <div class="am-u-sm-9">
                    <select data-am-selected="{searchBox: 0}"  name="label_attr_id[]">
                        <option value="">请选择</option>
                        @foreach($v['attr'] as $m=>$n)
                            <option value="{{$n['la_id']}}">{{$n['label_attr_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
            <div class="am-form-group">
                <div class="am-u-sm-9 am-u-sm-push-3">
                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success "><font><font>提交</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection


