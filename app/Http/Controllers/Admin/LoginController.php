<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\http\Model\admin;
use Illuminate\Support\Facades\Crypt;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * 后台登录
     * @param 参数:无
     * @return 返回后台登录页面
     * @author zxs
     * @Date 2017-7-6 
     */
    public function login(Request $request)
    {
        $cookie = $request->cookie('admin');
        // dd($cookie);
        //返回登录视图
        return view('Admin.login.login',['cookie'=>$cookie]);
    }
    /**
     * 判断登录
     * @param 参数:用户请求数据Request $request
     * @return 返回
     * @author zxs
     * @Date 2017-7-7
     */
    public function dologin(Request $request)
    {
        
        //接受数据
        $data = $request -> except('_token');

        //验证规则
        $rule = [
            'admin_name' => 'required',
            'admin_password' => 'required',
        ];

        //提示信息
         $mess=[
            'admin_name.required'=>'必须输入管理员名',
            'admin_password.required'=>'必须输入密码',
        ];

        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        
        if ($validator->fails()) {
            return redirect('/admin/login')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            //查询这个用户的密码
            
             $admin = Admin::where('admin_name',$data['admin_name'])->first();
            
            //判断用户是否存在
            if($admin){

                //Crypt解析必须是自己加密的,否则回报错
                $res = Crypt::decrypt($admin['admin_password']);
                //判断密码是否正确
                if($res == $data['admin_password']){
                    //判断是否记住密码
                    if(!empty($data['remember'])){
                        Cookie::queue('admin',$data,10080);
                     }else{
                        Cookie::queue('admin','',-1);
                    }
                    //设置标志位  将用户信息存入session
                    session(['adminFlag'=>true]);
                    session(['admin'=>$admin]);
                    //跟新用户最后登录时间
                    $lasttime=['admin_lasttime'=>time()];
                    Admin::where('admin_name',$data['admin_name'])->update($lasttime);
                    //判断用户是否第一次登录
                    if($admin['admin_lasttime']){
                        $str = ',上次登录时间为'.date('Y年m月d日H时i分s秒',$admin['admin_lasttime']);
                    }else{
                        $str = ',这是您第一次登录';
                    }
                    //返回后台首页
                    return redirect('admin/index')-> with('success','登录成功,现在时间为'.date('Y年m月d日H时i分s秒',time()).$str);
                    
                }else{
                    //返回错误
                    return back()->with('error','账户或密码错误');
                }
            }else{
                //返回错误
                return back()->with('error','账户不存在');
            }
        }   
    }
    /**
     * 判断验证码
     * @param 参数:用户请求数据Request $request
     * @return 返回 状态码
     * @author zxs
     * @Date 2017-7-6 
     */
    public function proving(Request $request)
    {
        $code = $request->input('code');

        if($code != session('captcha')){
            $data = [
                'status'=>1,
                'msg'=>'验证码不正确！'
           ];
       }else{
         $data = [
                'status'=>0,
                'msg'=>'验证码正确！'
           ];
       }
       return $data;
    }
    /**
     * 验证码生成
     * @param 参数:无
     * @return 返回 状态码
     * @author zxs
     * @Date 2017-7-7 
     */
    public function captcha()
    {
    	$phraseBuilder   = new PhraseBuilder(2);
    	// $str = $phraseBuilder -> build();
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder(null,$phraseBuilder);
        //可以设置图片宽高及字体
        $builder->build($width = 130, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        session(['captcha'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
    /**
     * 判断验证码
     * @param 参数:无
     * @return 返回 后台首页
     * @author zxs
     * @Date 2017-7-7 
     */
    public function index()
    {
        return view('admin.index.index');
    }
    /**
     * 退出
     * @param 参数:无
     * @return 返回 登录页
     * @author zxs
     * @Date 2017-7-8 
     */
    public function logout()
    {
        session()->flush();
    }
}
