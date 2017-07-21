<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Store;
use App\Http\Model\StoreAdmin;
use App\Http\Model\User;
use App\Http\Model\User_details;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Self_;
use App\Services\OSS;
use App\Http\Controllers\PhoneController;

class UserController extends Controller
{
    /*
     *  作者 lp
     *  邮箱注册用户
     *  
     */

    public function getRegister()
    {
        //返回注册视图
        return view('home.user.register');
    }

    //ajax查询用户是否注册
    public function getEmailajax(Request $request)
    {
        //获取输入的邮箱
        $email=$request->input('email');
        //查询邮箱是否注册
        $res = User::where('user_email','=',$email)->first();

        if($res){
            //存在
            $data = [
                'status'=>2,
                'msg'=>'邮箱已存在'
            ];
        }else{
            //不存在
            $data = [
                'status'=>1,
                'msg'=>'邮箱可用'
            ];
        }
        return $data;
    }

    //邮箱添加用户操作
    public function postCreate(Request $request)
    {
        //验证用户输入的信息
        $inputs = $request -> except('_token');
        $rule=[
            'user_email'=>'required',
            'user_email'=>['regex:/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/'],
            'user_password'=>'required|between:6,18',
            'user_repassword'=>'required|same:user_password',
        ];
        $mess=[
            'user_email.required'=>'用户名必须输入',
            'user_email.between'=>'用户名在6到18位之间',
            'user_password.required'=>'密码必须输入',
            'user_password.between'=>'密码在6-18位之间',
            'user_repassword.required'=>'重复密码必须输入',
            'user_repassword.same'=>'两次密码输入不一致',
        ];

        $validator =  Validator::make($inputs,$rule,$mess);

        if($validator->passes()){
            //获取数据
            $input = $request -> except('_token','user_repassword');
            $input['user_password'] = Crypt::encrypt($input['user_password']);
            $input['user_name'] = str_random(5);
            $input['createtime'] = time();
            $input['token'] = str_random(50);
            //添加用户
            $res = User::insertGetId($input);
            $deta_name = str_random(10);
            $re = User_details::insert(['user_id'=>$res,'deta_name'=>$deta_name]);
            if($res && $re){
//            dd(1111);
                //发送激活邮件
                $email = $input['user_email'];
//            dd($email);
                $id = $res;

                $token = $input['token'];
                //调用发送邮件方法
                self::mailto($id,$email,$token);

                return redirect('home/user/activate');
            }else{
                //发送失败 返回
                return back()->with('error','注册失败');
            }
        }else{
            return back()->withErrors($validator);
        }

    }

    /*
     * 发送邮箱验证方法
     */
    public static function mailto($id,$email,$token)
    {

         Mail::send('home.mail.index', ['id' => $id,'email'=>$email,'token'=>$token], function ($m) use ($email) {

            $m->to($email)->subject('这是一封注册邮件!');
        });
    }

    /*
     * 邮箱找回密码验证
     * */
    public static function mailfindpwd($id,$email,$token)
    {

        Mail::send('home.mail.findpwd', ['id' => $id,'email'=>$email,'token'=>$token], function ($m) use ($email) {

            $m->to($email)->subject('修改密码邮件!');
        });
    }

    public function getActivate()
    {
        //加载静态页面
        return view('home.mail.activate');
    }

    /*
     * 激活邮箱验证
     * */
    public function getOkactivate(Request $request)
    {
        //获取数据
        $id = $request -> id;
        $token = $request -> token;
        //查询用户信息
        $tokens = User::where('user_id',$id)->select('token')->first();
        //修改用户状态  1为激活
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
    public function getPhoneajax(Request $request)
    {
        //获取手机号
        $phone = $request -> input('phone');
        //查询手机号是否注册
        $res = User::where('user_phone',$phone)-> first();
        if(!$res){
            //没有注册  调用发送手机验证码方法
            $re = self::phoneto($phone);
            return [$re,'code'=>session('phone_code')];
        }else{
            //已注册  返回
            echo json_encode(['code'=>'no']);
        }
    }

    /*
     * 发送手机验证码方法
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
    public function postPhonecreate(Request $request)
    {
        $inputs = $request -> except('_token');
        $rule=[
            'phonecode'=>'required',
            'user_email'=>'required',
            'user_email'=>['regex:/^1(3|4|5|7|8)\d{9}$/'],
            'user_password'=>'required|between:6,18',
            'user_repassword'=>'required|same:user_password',
        ];
        $mess=[
            'phonecode.required'=>'手机验证码必须输入',
            'user_email.required'=>'用户名必须输入',
            'user_email.between'=>'用户名在6到18位之间',
            'user_password.required'=>'密码必须输入',
            'user_password.between'=>'密码在6-18位之间',
            'user_repassword.required'=>'重复密码必须输入',
            'user_repassword.same'=>'两次密码输入不一致',
        ];
        $validator =  Validator::make($inputs,$rule,$mess);
        if($validator->passes()){
            //获取数据
            $input = $request -> except('_token','user_repassword','phonecode');
            //查询用户是否存在
            $re = User::where('user_phone',$input['user_phone']) -> first();
            if($re){
                //存在返回
                return back()->with('error','用户已存在');
            }else{
                //不存在 添加用户
                $input['user_password'] = Crypt::encrypt($input['user_password']);
                $input['user_name'] = str_random(5);
                $input['createtime'] = time();
                $input['status'] = 1;
                $input['token'] = str_random(50);
                //添加用户
                $res = User::insertGetId($input);
                $deta_name = str_random(10);
                $re = User_details::insert(['user_id'=>$res,'deta_name'=>$deta_name]);
                if($res && $re){
                    //注册成功跳转页面
                    return redirect('home/user/phonecreateto');
                }else{
                    //注册失败返回
                    return back()->with('error','注册失败');
                }
            }
        }else{
            return back()->withErrors($validator);
        }


    }

    public function getPhonecreateto()
    {
        //加载静态页面
        return view('home.user.okregister');
    }


    /*
     * 个人中心 用户详情
     * */
    public function getUserdetails(Request $request)
    {
//        $res = $request->session()->all(session('logins'));
        //查询用户信息
        $id = session('logins')['user_id'];
        $data = User::where('user_id',$id)->first();
        $deta = User_details::where('user_id',$data['user_id']) -> first();
        //将数据返回给页面
        return view('home.user.details',compact('data','deta'));
    }

    /*
     * 头像上传
     * */
    public function postUpload()
    {

        //将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('file_upload');
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

            //将图片上传到本地服务器

            // $path = $file->move(public_path() . '/uploads', $newName);

            //将图片上传到七牛云
            //\Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

            //oss上传
            $result = OSS::upload('uploads/'.$newName, $file->getRealPath());

            //返回文件的上传路径
            $filepath = 'uploads/' . $newName;
            return $filepath;
        }
    }

    /*
    *  修改信息
    */
    public function postUpdate(Request $request)
    {
//        dd($request->all());

        //获取用户信息
        $data = $request -> except('_token','file_upload');
        $data['deta_birthday'] = strtotime($request -> deta_birthday);
        $name = $request -> only('user_name');
        //修改信息
        $re = User_details::where('user_id',$data['user_id']) ->update($data);
        if($re){
            //修改成功跳转信息详情页
            return redirect('home/user/userdetails')->with('okupdate','修改成功');
        }else{
            //修改失败 返回上一步
            return back()->with('error');
        }
    }

    /*
     * 修改密码
     * */
    public function getEdit(Request $request,$id )
    {
        //加载修改密码页面  给页面返回用户id
        return view('home.user.editpassword',compact('id'));
    }

    /*
     * Ajax验证密码
     * */
    public function postEditpassword(Request $request)
    {
        //获取用户信息
        $input = $request->except('_token');
        $id = $input['id'];
        $password = $input['jpass'];
        $data = User::where('user_id',$id) -> first();
        //判断输入的密码是否和数据库密码一致
        if($password !=  Crypt::decrypt($data['user_password'])){
            return 1;
        }

    }

    /*
     * 确认修改密码
     * */
    public function postUpdatepassword(Request $request)
    {
        //获取数据
        $input = $request -> except('_token');
        //查询用户信息
        $re = User::where('user_id',$input['id']) -> first();
        $newpassword = Crypt::encrypt($input['newpassword']);
        //判断新输入的密码是否和数据库原来的密码一致
        if(Crypt::decrypt($re['user_password']) != $input['password']){
            //一致返回
            return back()->with('error');
        }else{
            //不一致确认修改
            User::where('user_id',$input['id']) -> update(['user_password'=>$newpassword]);
            StoreAdmin::where('user_id',$input['id']) -> update(['store_admin_password'=>$newpassword]);
            //修改成功返回用户详情页面
            return redirect('home/user/userdetails')->with('updateok','修改成功');
        }
    }

    /*
     * 找回密码页面
     * */
    public function getFindpwd()
    {
        return view('home.user.findpwd');
    }

    /*
     *找回密码操作
     * */
    public function getDofindpwd(Request $request)
    {
        //获取用户输入的账号
        $user = $request-> user;
        //判断账号是否存在
        $re = User::where('user_phone',$user) -> orwhere('user_email',$user)->first();
        if(!$re){
            echo '2';
        }
    }
    /*
     * 发送找回密码验证码
     * */
    public function postOkfindpwd(Request $request)
    {
        //获取用户信息
        $input = $request -> except('_token','code');
        //查询用户信息
        $user = User::where('user_phone',$input['user']) -> orwhere('user_email',$input['user']) -> first();
        $id = $user -> user_id;
        $token = $user -> token;
        //判断传过来的是否为邮箱
        $emails ="/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        $email = $input['user'];
        if(preg_match($emails,$email)){
            //如果是邮箱  发送邮箱验证
            self::mailfindpwd($id,$email,$token);
            return back()->with('okemail','邮件已发送');
        }
        $phones = "/^1(3|4|5|7|8)[1,2,3,4,5,6,7,8,9,0]{9}$/";
        $phone = $input['user'];
        if(preg_match($phones,$phone)){
            //如果是手机号  发送验证码
            self::phoneto($phone);
            $phonecode = session('phone_code');
            return view('home.user.phonefindpwd',compact('phonecode','phone'));
        }
    }

    /*
     * 手机修改密码
     * */
    public function postPhonefindpwd(Request $request)
    {
        //获去用户输入的账号
        $request -> except('_token','code');
        $user_phone = $request -> user_phone;
        return view('home.user.findpwdphone',compact('user_phone'));
    }

    /*
     *手机确认修改密码
     */
    public function postPhonepwdfind(Request $request)
    {
        //获取用户输入的账号
        $input = $request -> except('_token');
        //判断两次输入的密码是否一致
        if($input['newpassword'] != $input['repassword']){
            //不一致返回上一步
            return back()->with('error','密码输入不一致');
        }else{
            //一致  给新密码加密
            $password = Crypt::encrypt($input['newpassword']);
            //重写token
            $token = str_random(50);
            //修改用户密码
            User::where('user_phone',$input['user_phone']) -> update(['user_password'=>$password,'token'=>$token]);
            //修改成功  跳转登录页
            return redirect('home/login') -> with('okfindpwd','修改成功');
        }
    }

    /*
     * email修改密码
     * */
    public function getEmailfindpwd(Request $request)
    {
//        dd($request -> all());
        //获取用户信息
        $id = $request -> id;
        $token = $request -> token;
        //查询用户是否是点连接过来  带的token是否是数据库存的token
        $re= User::where('user_id',$id) -> where('token',$token) -> first();
        if($re){
            //将参数返回给页面
            return view('home.mail.okfindpwd',compact('id','token'));
        }else{
            //token不正确  跳转密码找回页
            return redirect('home/user/findpwd')->with('reemail','地址失效请重新发送邮件');
        }
    }

    /*
     * email确认修改密码
     * */
    public function postFindpwdok(Request $request)
    {
        //获取信息
        $input = $request -> except('_token');
        //判断两次密码是否输入一致
        if($input['newpassword'] != $input['repassword']){
            //不一致返回上一步
            return back()->with('error','密码输入不一致');
        }else{
            //一致 给新密码加密
            $newpassword = Crypt::encrypt($input['newpassword']);
            //重写token
            $token = str_random(50);
            //修改用户密码
            User::where('user_id',$input['id']) -> update(['user_password'=>$newpassword,'token'=>$token]);
            //修改成功  跳转登录页
            return redirect('home/login')->with('okfindpwd','修改成功');
        }
    }

    /*
     * 退出登录
     * */
    public function getExit(Request $request)
    {
        //清除session中存的用户信息
        session()->forget('logins');
        //跳转到主页
        return redirect('/') -> with('exit','已退出');
    }
}
