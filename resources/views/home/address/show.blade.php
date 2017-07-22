@extends('layouts.home_user')

@section('content')


<div class="mem_tit">
    <span id="content">亲,你还没有添加购物地址,请点击添加购物地址!!!</span>  
</div>   
<div class="mem_tit">
    <a href="{{'address/create'}}">
        <span style="color:red;">新增收货地址</span>
    </a>
</div>
<script>    
        var c = document.getElementById('content');
        var text = c.innerHTML;
        var i = 0;
        setInterval(function(){
            // 通过截取字符串 拼接字符
            var str = text.substr(0,i);  //0  1
            str += '<span style="font-size:30px;color:red">'+text[i]+'</span>';
            str += text.substr(i+1);
            // 将拼接好的字符串 赋值到h3标签里面
            c.innerHTML = str;
            // 如果长度大于或等于字符串长度则从0零开始
            i++;
            if(i >= text.length){
                i = 0;
            }
        },500);
        

        
    </script>   

@endsection