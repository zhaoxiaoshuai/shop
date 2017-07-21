<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\http\Model\StoreAdmin;
use App\http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * 商家后台登录
     * @param 参数:无
     * @return 返回后台登录页面
     * @author 邹鹏
     * @Date 2017-7-13 
     */
    public function getLogin(Request $request)
    {
        // 从session中或登录用户的信息
        $res = session('logins');

        // 判断是否登录
        if($res){

            // 如果不是商家返回到商家登录
            if($res['status'] == 2){

            $cookie = $request->cookie('store_admin');
            // // dd($cookie);
            // //返回登录视图
            return view('store.login.login',['cookie'=>$cookie]);
            }else{
                // 如果不是商家就返回到申请入驻
                // echo '<script>alert("亲,您    还不是商家，去申请入驻！")</script>';
                return redirect('home/MerApplication2');
            }
           
        }else{
            // 如果没登陆就返回前台登录视图
            // echo '<script>alert("亲,您还没有登录，去登录！")</script>';
            return redirect('home/login');
        }

        
    }

     /**
     * 商家后台登录(用于商家中的管理员登录)
     * @param 参数:无
     * @return 返回后台登录页面
     * @author 邹鹏
     * @Date 2017-7-13 
     */
    public function login2(Request $request)
    {
        $cookie = $request->cookie('store_admin');
        // // dd($cookie);
        // //返回登录视图
        return view('store.login.login',['cookie'=>$cookie]);
        
        
    }
    /**
     * 判断登录
     * @param 参数:用户请求数据Request $request
     * @return 返回
     * @author zxs
     * @Date 2017-7-13
     */
    public function postDologin(Request $request)
    {
        
        //接受数据
        $data = $request -> except('_token');
        // dd($data);
        //验证规则
        $rule = [
            'store_admin_name' => 'required',
            'store_admin_password' => 'required',
        ];
        
        //提示信息
         $mess=[
            'store_admin_name.required'=>'必须输入管理员名',
            'store_admin_password.required'=>'必须输入密码',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        
        if ($validator->fails()) {
            return redirect('/store/admin/login')->withErrors($validator)->withInput();
        }else{
            //查询这个用户的密码
            $admin = StoreAdmin::where('store_admin_name',$data['store_admin_name'])->first();
            //判断用户是否存在
            if($admin){
                //Crypt解析必须是自己加密的,否则回报错
                $res = Crypt::decrypt($admin['store_admin_password']);
                //判断密码是否正确
                if($res == $data['store_admin_password']){
                    //判断是否记住密码
                    if(!empty($data['remember'])){
                        Cookie::queue('store_admin',$data,10080);
                     }else{
                        Cookie::queue('store_admin','',-1);
                    }
                    //设置标志位  将用户信息存入session
                    session(['store_adminFlag'=>true]);
                    session(['store_admin'=>$admin]);
                    //跟新用户最后登录时间
                    $lasttime=['store_admin_lasttime'=>time()];
                    StoreAdmin::where('store_admin_name',$data['store_admin_name'])->update($lasttime);
                    //判断用户是否第一次登录
                    if($admin['store_admin_lasttime']){
                        $str = ',上次登录时间为'.date('Y年m月d日H时i分s秒',$admin['store_admin_lasttime']);
                    }else{
                        $str = ',这是您第一次登录';
                    }
                    //返回后台首页
                    return redirect('store/admin/index')->with('store_success','登录成功,现在时间为'.date('Y年m月d日H时i分s秒',time()).$str);
                    
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
     * @Date 2017-7-13
     */
    public function postProving(Request $request)
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
     * @Date 2017-7-13
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
        //生成
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
    /**
     * 商家后台首页
     * @param 参数:无
     * @return 返回 后台首页
     * @author zxs
     * @Date 2017-7-13 
     */
    public function getIndex()
    {
        return view('store.index.index');
    }

    /**
     * 退出
     * @param 参数:无
     * @return 返回 登录页
     * @author zxs
     * @Date 2017-7-13
     */
    public function getLogout()
    {
        session()->forget('store_admin');
    }

    /**
     * 修改密码
     * @param 参数:无
     * @return 返回 修改密码页
     * @author 邹鹏
     * @Date 2017-7-16
     */
    public function getUpassword()
    {
        // 获取管理员的id
        $store_admin = session('store_admin');
        // 加载修改密码页
        return view('store.login.upassword',compact('store_admin'));
    }

    /**
     * 执行修改密码修改密码
     * @param 参数:无
     * @return 
     * @author 邹鹏
     * @Date 2017-7-16 11:15
     */
    public function postDopassword(Request $request)
    {
        // 接收指定参数
        $data = $request->except('_token');
        
        // 查询管理员信息
        $store_admin = StoreAdmin::where('store_admin_id',$data['store_admin_id'])->first();

        //  decrypt()函数解密
        $password = Crypt::decrypt($store_admin['store_admin_password']);

        // 判断原密码是否一致
        if($data['pwd'] != $password){
             return back()->with('error','您输入的原密码不正确');
        }

        // 判断新密码是否一致
        if($data['newpwd'] != $data['rnewpwd']){
            return back()->with('error','您输入的新密码不一致');
        }

        // 判断新密码不能和原密码一致
        if($data['newpwd'] == $password){
            return back()->with('error','新密码不能与原密码一样');
        }else{
            // 对新密码加密
            $newpassword = Crypt::encrypt($data['newpwd']);
            // 执行对 shop_atore_admin表 修改密码
            $res1 = StoreAdmin::where('store_admin_id',$data['store_admin_id'])->update(['store_admin_password'=>$newpassword]);
            $res2 = User::where('user_id',$store_admin['user_id'])->update(['user_password'=>$newpassword]);

            return redirect('store/admin/index');
        }
        
    }
}
