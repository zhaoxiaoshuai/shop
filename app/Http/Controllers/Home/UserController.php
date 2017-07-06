<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Self_;

use App\Http\Controllers\PhoneController;

class UserController extends Controller
{
    /*
     *  作者 lp
     *  邮箱注册用户
     *  
     */

    public function register()
    {

        //返回注册视图
        return view('home.user.register');
    }

    //ajax查询用户是否注册
    public function emailajax(Request $request)
    {
        //ajax验证邮箱
        $email=$request->input('email');

        $res = User::where('user_email','=',$email)->first();

        if($res){
            $data = [
                'status'=>2,
                'msg'=>'邮箱已存在'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'邮箱可用'
            ];
        }
        return $data;
    }

    //邮箱添加用户操作
    public function create(Request $request)
    {
        //获取数据
        $input = $request -> except('_token','user_repassword');
        $input['user_password'] = Crypt::encrypt($input['user_password']);
        $input['createtime'] = time();
        $input['token'] = str_random(50);
        //添加用户
        $res = User::create($input);
        if($res){
//            dd(1111);
            //发送激活邮件
            $email = $res['user_email'];
//            dd($email);
            $id = $res['user_id'];

            $token = $res['token'];

            self::mailto($id,$email,$token);
            return redirect('home/user/activate');
        }else{
            return back()->with('error','注册失败');
        }
    }

    /*
     * 发送邮箱验证
     */
    public static function mailto($id,$email,$token)
    {

        Mail::send('home.mail.index', ['id' => $id,'token'=>$token,'email'=>$email], function ($m) use ($email) {

            $m->to($email)->subject('这是一封注册邮件!');
        });
    }

    public function activate()
    {
        return view('home.mail.activate');
    }

    public function okactivate(Request $request)
    {
          $id = $request -> id;
          $token = $request -> token;
        $tokens = User::where('user_id',$id)->select('token')->first();
        if($tokens['token']==$token){
            $res = User::where('user_id',$id)->update(['status'=>1,'token'=>str_random(50)]);
            if($res){
                return view('home.mail.okactivate');
                dd();
            }
        }
    }
    
    
    
    /*
     * 手机注册用户
     */
    public function phoneajax(Request $request)
    {
        $phone = $request -> input('phone');
        if(!$res){
            $res = self::phoneto($phone);
            echo $res;
        }else{
            echo json_encode(['code'=>'no']);
        }
    }

    /*
     * 发送手机验证码
     */
    public static function phoneto($phone){

        $phone_code = rand(1000,9999);
        session(['phone_code'=>$phone_code]);
        $str = 'http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C13001825&password=28b3f7951fd54ff596293a79b7959405&format=json&mobile='.$phone.'&content=您的验证码是：'.$phone_code.'。请不要把验证码泄露给其他人。';
        $res = PhoneController::get($str);
        return $res;
    }
    
    /*
     *
     * 手机号添加用户操作
     */
    public function phonecreate(Request $request)
    {
        //获取数据
        $input = $request -> except('_token','user_repassword');
        $input['user_password'] = Crypt::encrypt($input['user_password']);
        $input['createtime'] = time();
        $input['token'] = str_random(50);
        //添加用户
        $res = User::create($input);
        if($res){
            return redirect('home/user/phonecreateto');
        }else{
            return back()->with('error','注册失败');
        }
    }

    public function phonecreateto()
    {
        return view('home.user.okregister');
    }
}
