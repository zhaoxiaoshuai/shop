

$(function(){
	var ok1=false;
    var ok2=false;
    var ok3=false;
    var ok4=false;
    var ok5=false;
    var ok6=false;
    var ok7=false;
    var ok8=false;
    var ok9=false;
    var ok10=false;
    var ok11=false;
    var ok12=false;
    var ok13=false;
    var ok14=false;
    // 1.验证店铺名
    var preg1 = /^[\u4E00-\u9FA5]{1,6}$/;
    $('input[name="merchant_name"]').focus(function(){
        $(this).parent().parent().next().text('请输入店铺名').removeClass().addClass('state2');;
    }).blur(function(){
        if(preg1.test($(this).val())){
            $(this).parent().parent().next().text('输入店铺名成功').removeClass().addClass('state4');
            ok1=true;
        }else{
            $(this).parent().parent().next().text('请输入店铺名为1-6位汉字').removeClass().addClass('state3');
        }
         
    });

    // 2.验证店铺标题
    var preg2 = /^[\u4E00-\u9FA5]{3,15}$/;
    $('input[name="merchant_title"]').focus(function(){
        $(this).parent().parent().next().text('请输入店铺标题').removeClass().addClass('state2');;
    }).blur(function(){
        if(preg2.test($(this).val())){
            $(this).parent().parent().next().text('输入店铺标题成功').removeClass().addClass('state4');
            ok2=true;
        }else{
            $(this).parent().parent().next().text('店铺标题为3-15位汉字').removeClass().addClass('state3');
        }
    });

    // 3.验证姓名
    var preg3 = /^[\u4E00-\u9FA5]{2,4}$/;
    $('input[name="store_username"]').focus(function(){
        $(this).parent().parent().next().text('请输入您的姓名').removeClass().addClass('state2');;
    }).blur(function(){
        if(preg3.test($(this).val())){
            $(this).parent().parent().next().text('输入姓名成功').removeClass().addClass('state4');
            ok3=true;
        }else{
            $(this).parent().parent().next().text('姓名为2-4位汉字').removeClass().addClass('state3');
        } 
    });

    // 4.验证手机
    var preg4 = /^1[3|4|5|7|8]\d{9}$/;
    $('input[name="store_phone"]').focus(function(){
        $(this).parent().parent().next().text('请输入11位的手机号').removeClass().addClass('state2');
    }).blur(function(){
        if(preg4.test($(this).val())){
            $(this).parent().parent().next().text('输入手机号成功').removeClass().addClass('state4');
            ok4=true;
        }else{
            $(this).parent().parent().next().text('请输入11位常用的手机号').removeClass().addClass('state3');
        }
    });

    // 5.验证邮箱
    // var preg = /^[0-9a-zA-Z_]+@[0-9a-zA-Z]+(\.[a-z]+)+$/;
	$('input[name="store_email"]').focus(function(){
	    $(this).parent().parent().next().text('请输入EMAIL').removeClass().addClass('state2');
	}).blur(function(){
	    if($(this).val().search(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/)==-1){
	        $(this).parent().parent().next().text('请输入正确的EMAIL格式').removeClass().addClass('state3');
	    }else{                  
	        $(this).parent().parent().next().text('EMAIL输入成功').removeClass().addClass('state4');
	        ok5=true;
	    } 
	});

    // 6.验证地址
    $('#province').mouseover(function(){
        $(this).parent().parent().next().text('请选择省份').removeClass().addClass('state2');;
    }).change(function(){
    	$(this).parent().parent().next().text('请选择城市').removeClass().addClass('state2');
    });
    $('#city').change(function(){
        $(this).parent().parent().next().text('请选择地区').removeClass().addClass('state2');;
    })
    $('#area').change(function(){
    	$(this).parent().parent().next().text('地址选择完毕').removeClass().addClass('state4');
    	ok6=true;
    });

    // 7.验证详细地址
    $('input[name="detailed_address"]').focus(function(){
        $(this).parent().parent().next().text('请输入详细地址').removeClass().addClass('state2');;
    }).blur(function(){
        if($(this).val()!=''){
            $(this).parent().parent().next().text('详细地址输入成功').removeClass().addClass('state4');
            ok7=true;
        }else{
            $(this).parent().parent().next().text('请输入详细地址').removeClass().addClass('state3');
        } 
    });

    // 8.验证身份证
    var preg8 = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
    $('input[name="number_id"]').focus(function(){
        $(this).parent().parent().next().next().text('请输入身份证号').removeClass().addClass('state2');
    }).blur(function(){
        if(preg8.test($(this).val())){
            $(this).parent().parent().next().next().text('输入身份证号成功').removeClass().addClass('state4');
            ok8=true;
        }else{
            $(this).parent().parent().next().next().text('请输入15或18位正确的身份证号').removeClass().addClass('state3');
        }
    });

    // 9.验证银行开户名
    var preg9 = /^[\u4E00-\u9FA5]{2,4}$/;
    $('input[name="bank_username"]').focus(function(){
        $(this).parent().parent().next().text('请输入您的银行开户名').removeClass().addClass('state2');;
    }).blur(function(){
        if(preg9.test($(this).val())){
            $(this).parent().parent().next().text('输入银行开户名成功').removeClass().addClass('state4');
            ok9=true;
        }else{
            $(this).parent().parent().next().text('姓名为2-4位汉字').removeClass().addClass('state3');
        } 
    });

    // 10.个人银行账户
    var preg10 = /(^\d{16}$)|(^\d{19}$)/;
    $('input[name="bank_account"]').focus(function(){
        $(this).parent().parent().next().text('请输入您的个人银行账户').removeClass().addClass('state2');;
    }).blur(function(){
        if(preg10.test($(this).val())){
            $(this).parent().parent().next().text('输入个人银行账户成功').removeClass().addClass('state4');
            ok10=true;
        }else{
            $(this).parent().parent().next().text('请输入16或19位长度数字').removeClass().addClass('state3');
        } 
    });

    // 11.验证开户银行名称
    var preg11 = /^[\u4E00-\u9FA5]{4,10}$/;
    $('input[name="bank_name"]').focus(function(){
        $(this).parent().parent().next().text('请输入您的开户银行名称').removeClass().addClass('state2');;
    }).blur(function(){
        if(preg11.test($(this).val())){
            $(this).parent().parent().next().text('输入开户银行名称成功').removeClass().addClass('state4');
            ok11=true;
        }else{
            $(this).parent().parent().next().text('开户银行名称为4-10位汉字').removeClass().addClass('state3');
        } 
    });

    // 12.验证平台使用费
    $('input[name="platform_use_fee"]').focus(function(){
        $(this).parent().parent().next().text('请输入您在平台的使用费').removeClass().addClass('state2');;
    }).blur(function(){
		if(!isNaN($(this).val() ) && $(this).val()!=''){
            $(this).parent().parent().next().text('输入成功').removeClass().addClass('state4');
			ok12=true;
		}else{
		  $(this).parent().parent().next().text('请输入数值，建议费用在1000-100000之间').removeClass().addClass('state3');
		}
    });

    // 13.商家保证金
     $('input[name="store_margin"]').focus(function(){
        $(this).parent().parent().next().text('请输入保证金').removeClass().addClass('state2');;
    }).blur(function(){
		if(!isNaN($(this).val() ) && $(this).val()!=''){
            $(this).parent().parent().next().text('输入成功').removeClass().addClass('state4');
			ok13=true;
		}else{
		  $(this).parent().parent().next().text('请输入数值，建议保证金在1000-100000之间').removeClass().addClass('state3');
		}
    });

    // 14.分成百分比
    $('input[name="percent"]').focus(function(){
        $(this).parent().parent().next().text('请输入分成').removeClass().addClass('state2');;
    }).blur(function(){
		if(!isNaN($(this).val() ) && $(this).val()!=''){
            $(this).parent().parent().next().text('输入成功').removeClass().addClass('state4');
			ok14=true;
		}else{
		  $(this).parent().parent().next().text('请输入数值，分成为1，2，3，，，等等').removeClass().addClass('state3');
		}
    });

    

    //提交按钮,所有验证通过方可提交
 
    $('#submit').click(function(){
    	var ok = ok1 && ok2 && ok3 && ok4 && ok5 && ok6 && ok7 && ok8 && ok9 && ok10 && ok11 && ok12 && ok13 && ok14;
        if(ok){
            $('form').submit();
        }else{
            return false;
        }
    });
     

});