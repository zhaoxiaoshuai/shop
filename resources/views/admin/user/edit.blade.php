@extends('layouts.admin')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-head am-cf">
            <div class="widget-title am-fl"><a href="{{url('admin/user')}}">返回</a></div>
            <div class="widget-function am-fr">
                <a href="javascript:;" class="am-icon-cog"></a>
            </div>
        </div>
        <div class="widget-body am-fr">

            <form class="am-form tpl-form-border-form" action="{{ url('admin/user/').'/'.$data -> user_id  }}" method="post">
            {{csrf_field()}}
                @if(session('error'))
                    <script>
                        layer.msg('状态必须为1位数的数字',{icon:5});
                    </script>
                @endif
                <input type="hidden" name="_method" value="put">
                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-12 am-form-label am-text-left">用户账号<span class="tpl-form-line-small-title"> Phone | Email</span></label>
                    <div class="am-u-sm-12">
                        <input type="text" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="" readonly="" value="@if($data -> user_phone != ''){{$data['user_phone']}}@else{{$data['user_email']}}@endif">

                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-12 am-form-label am-text-left">用户创建时间<span class="tpl-form-line-small-title"> Time</span></label>
                    <div class="am-u-sm-12">
                        <input type="text" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder=""  readonly=""  value="{{date('Y-m-d H:i:s',$data -> createtime)}}">

                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-12 am-form-label am-text-left">用户token<span class="tpl-form-line-small-title"> token</span></label>
                    <div class="am-u-sm-12">
                        <input type="text" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder=""  readonly="" value="{{$data -> token}}">

                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-12 am-form-label am-text-left">用户状态<span class="tpl-form-line-small-title"> status</span></label>
                    <div class="am-u-sm-12">
                        <select class="am-form-field tpl-form-no-bg am-margin-top-xs" style="color:#0d86c4" name="status" id="" value="{{$data -> status}}">
                            <option value="0">0 --- 未激活用户</option>
                            <option value="1">1 --- 已激活用户</option>
                            <option value="2">2 --- 商家</option>
                        </select>
                    </div>
                    {{--<div class="am-u-sm-12">--}}
                        {{--<input type="text" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="" name="status"  value="{{$data -> status}}">--}}

                    {{--</div>--}}
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-12 am-u-sm-push-12">
                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection