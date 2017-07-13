@extends('layouts.home_user')

@section('content')

  	<div class="m_right">
        @if(session('error'))
                      <p style="background:#f0ad4e">  {{session('error')}}</p>
                    @endif
  		<div class="mem_tit">
            <h4 class="modal-title" id="exampleModalLabel">添加收货地址信息</h4>
        </div>
        <form action="{{ url('home/address/').'/'.$data -> address_id  }}" method="post">
         <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
        	<table border="0" class="add_tab" style="width:930px;"  cellspacing="0" cellpadding="0">
              <tr>
                <td width="135" align="right">配送地区</td>
                <td colspan="3" style="font-family:'宋体';">
                	<select name="province" id="province">
                          
                    </select>
                	<select name="city" id="city">
                           
                    </select>
                	<select name="area" id="area">
                          
                    </select><br>

                </td>
              </tr>
              <tr>
                <td align="right">收货人姓名</td>
                <td style="font-family:'宋体';"><input type="text" name="name" value="{{$data->name}}" class="add_ipt" />（必填）</td>
                <td align="right">手机</td>
                <td style="font-family:'宋体';"><input type="text" name="phone" value="{{$data->phone}}" class="add_ipt" />（必填）</td>
              </tr>
              <tr>
                <td align="right" >详细地址</td>
                <td style="font-family:'宋体';" colspan="3" ><input type="text" name="address" value="{{$arr[3]}}" class="add_ipt" style="width:400px" />（必填）</td>
               	
              </tr>
              
              
            </table>
            <div style="margin-left:20px;margin-top:20px;">
            	<input type="submit" value="保存地址信息">
            </div>
			
        </form>
  		
  	</div>
</div>
<script type="text/javascript">
          new PCAS("province","city","area","--省份--","--地级市--","--县/县级市--");
          $(document).ready(function() 
          {             
            $(".new-option-r").click(function() {
              $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
            });
            var $ww = $(window).width();
            if($ww>640) {
              $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
            }
          });
</script>
@endsection('content')