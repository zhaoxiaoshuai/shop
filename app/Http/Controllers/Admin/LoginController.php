<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;

class LoginController extends Controller
{
    /**
     * 后台登录
     * @param 参数:无
     * @return 返回后台登录页面
     * @author zxs
     * @Date 2017-7-6 
     */
    public function login()
    {
        //返回登录视图
        return view('Admin.login.login');
    }
    /**
     * 判断登录
     * @param 参数:用户请求数据Request $request
     * @return 返回
     * @author zxs
     * @Date 2017-7-6 
     */
    public function dologin(Request $request)
    {
        
    }
    public function captcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 130, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        session(['milkcaptcha'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
