<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use App\Http\Model\User_details;
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

    public function activate()
    {
        return view('home.mail.activate');
    }

    /*
     * 激活邮箱验证
     * */
    public function okactivate(Request $request)
    {

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
    public function phoneajax(Request $request)
    {
        $phone = $request -> input('phone');
        $res = User::where('user_phone',$phone)-> first();

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
        $input = $request -> except('_token','user_repassword','phonecode');
        $re = User::where('user_phone',$input['user_phone']) -> first();
        if($re){
            return back()->with('error','用户已存在');
        }
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
            return redirect('home/user/phonecreateto');
        }else{
            return back()->with('error','注册失败');
        }
    }

    public function phonecreateto()
    {
        return view('home.user.okregister');
    }


    /*
     * 个人中心 用户详情
     * */
    public function user_details(Request $request)
    {
//        $res = $request->session()->all(session('logins'));
        $id = session('logins')['user_id'];
        $data = User::where('user_id',$id)->first();
        $deta = User_details::where('user_id',$data['user_id']) -> first();

        return view('home.user.details',compact('data','deta'));
    }

    /*
     * 头像上传
     * */
    public function upload()
    {

        //        将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('file_upload');
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

//            将图片上传到本地服务器

            // $path = $file->move(public_path() . '/uploads', $newName);

//            将图片上传到七牛云
//            \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

//            oss上传

            $result = OSS::upload('uploads/'.$newName, $file->getRealPath());


//        返回文件的上传路径
            $filepath = 'uploads/' . $newName;
            return $filepath;
        }
    }

    /*
    *  修改信息
    */
    public function update(Request $request)
    {
//        dd($request->all());
        $data = $request -> except('_token','file_upload');
//        $data['deta_face'] = 'http://php182.oss-cn-beijing.aliyuncs.com/'.$data['deta_face'];
        $name = $request -> only('user_name');
//        $res = User::where('user_id',$data['user_id']) -> update($name);
        $re = User_details::where('user_id',$data['user_id']) ->update($data);
        if($re){
            return redirect('home/user/user_details');
        }else{

            return back()->with('error');
        }
    }

    /*
     * 修改密码
     * */
    public function edit(Request $request,$id )
    {
        return view('home.user.editpassword',compact('id'));
    }

    /*
     * Ajax验证密码
     * */
    public function editpassword(Request $request)
    {

        $input = $request->except('_token');
        $id = $input['id'];
        $password = $input['jpass'];
        $data = User::where('user_id',$id) -> first();
        if($password !=  Crypt::decrypt($data['user_password'])){
            return 1;
        }

    }

    /*
     * 确认修改密码
     * */
    public function updatepassword(Request $request)
    {
        $input = $request -> except('_token');
        $re = User::where('user_id',$input['id']) -> first();
        $newpassword = Crypt::encrypt($input['newpassword']);

        if(Crypt::decrypt($re['user_password']) != $input['password']){
            return back()->with('error');
        }else{
            User::where('user_id',$input['id']) -> update(['user_password'=>$newpassword]);
            return redirect('home/user/user_details')->with('updateok','修改成功');
        }
    }

    /*
     * 找回密码页面
     * */
    public function findpwd()
    {
        return view('home.user.findpwd');
    }

    /*
     *找回密码操作
     * */
    public function dofindpwd(Request $request)
    {
        $user = $request-> user;
        $re = User::where('user_phone',$user) -> orwhere('user_email',$user)->first();
        if(!$re){
            echo '2';
        }
    }
    /*
     * 发送找回密码验证码
     * */
    public function okfindpwd(Request $request)
    {
        $input = $request -> except('_token','code');
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
        $phones = "/^1(3|4|5|7|8)\d{9}$/;";
        $phone = $input['user'];
        if(preg_match($phones,$phone)){
            //如果是手机号  发送验证码
            $phonecode = self::phoneto($phone);
            return view('home.user.phonefindpwd',compact('phonecode','phone'));
        }
    }

    /*
     * email修改密码
     * */
    public function emailfindpwd(Request $request)
    {
//        dd($request -> all());
        $id = $request -> id;
        $token = $request -> token;
        $re= User::where('user_id',$id) -> where('token',$token) -> first();
        if($re){
            return view('home.mail.okfindpwd',compact('id','token'));
        }else{
            return redirect('home/user/findpwd')->with('reemail','地址失效请重新发送邮件');
        }
    }

    /*
     * 确认修改密码
     * */
    public function findpwdok(Request $request)
    {
        $input = $request -> except('_token');
        if($input['newpassword'] != $input['repassword']){
            return back()->with('error','密码输入不一致');
        }else{
            $newpassword = Crypt::encrypt($input['newpassword']);
            $token = str_random(50);
            User::where('user_id',$input['id']) -> update(['user_password'=>$newpassword,'token'=>$token]);
            return redirect('home/login')->with('okfindpwd','修改成功');
        }
    }

    /*
     * 退出登录
     * */
    public function exit(Request $request)
    {
        $request->session()->flush();
        return redirect('/');

    }
}
