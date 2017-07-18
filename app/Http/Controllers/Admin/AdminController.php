<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\http\Model\Admin;
use Illuminate\Support\Facades\Crypt;
use App\http\Model\Role;
use App\http\Model\Admin_role;
use DB;
class AdminController extends Controller
{
    /**
     * 管理员列表
     * @param 参数:无
     * @return 返回管理员列表页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function index(Request $request)
    {
    	// dd($request->all());
        $count = 5;
        if($request->has('keywords')){
            $key = trim($request->input('keywords'));
            $admins = Admin::where('admin_name','like',"%".$key."%")->paginate($count);
            $order = '';
            return view('admin.admin.index',['data'=>$admins,'key'=>$key,'o'=>$order]);
        }else{
        	//判断排序
        	if($request->has('o')){
        		$order = $request->input('o');
        		$d = empty($request->input('d')) ? 'asc' : $request->input('d');
        		// dd($order);
        		//取数据
        		$key = '';
        		$admins = Admin::orderBy($order,$d) -> paginate($count);
        		return view('admin.admin.index',['data'=>$admins,'key'=>$key,'o'=>$order,'d'=>$d]);
        	}
            //取出数据
            $admins = Admin::paginate($count);
            //设置返回页面
            $key = '';
            $order = '';
            return view('admin.admin.index',['data'=>$admins,'key'=>$key,'o'=>$order]);
        }
        
    }

    /**
     * 添加管理员
     * @param 参数:无
     * @return 返回添加管理员页面
     * @author zxs
     * @Date 2017-7-4 
     */
    public function create()
    {
        //获取所有角色信息
        $role = Role::get();
        //引入添加管理员表单
        return view('admin.admin.add',['data'=>$role]);
    }

    /**
     * 添加管理员值数据库
     * @param 参数:Request $request
     * @return 返回
     * @author zxs
     * @Date 2017-7-4 
     */
    public function store(Request $request)
    {
        //获取请求数据
        $data = $request -> except('_token');
        
        //验证规则
        $rule = [
            'admin_name' => 'required',
            'admin_name' => ['regex:/[a-zA-Z0-9_]{5,16}/'],
            'admin_password' => 'required',
            'admin_password' => ['regex:/^[a-zA-Z\d_]{6,16}$/'],
            'repassword' => 'required|same:admin_password',
            'admin_phone' => 'required',
            'admin_phone' => ['regex:/^1[3|4|5|8][0-9]\d{4,8}$/'],
            'admin_email' => 'required|email',
            'role_id' => 'required',
        ];

        //提示信息
         $mess=[
            'admin_name.required'=>'必须输入管理员名',
            'admin_name.regex'=>'管理员名必须是5-16为字母数字下划线',
            'admin_password.required'=>'必须输入密码',
            'admin_password.regex'=>'密码必须为6到16位字母数字下划线',
            'repassword.required'=>'确认密码必须填写',
            'repassword.same'=>'两次密码输入不一致',
            'admin_phone.required'=>'必须输入电话',
            'admin_phone.regex'=>'电话格式不正确',
            'admin_email.required'=>'必须输入email',
            'admin_email.email'=>'email格式不正确',
            'role_id.required'=>'必须选择角色',

        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/admin/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $admin = Admin::where('admin_name',$data['admin_name']) ->first();

            if (!empty($admin)) {
                return back()->with('error','该用户名以存在');
            }else{
                $data['admin_create'] = time();
                $data['admin_lasttime'] = 0;
                unset($data['repassword']);
                $role_id = $data['role_id'];
                unset($data['role_id']);
                $data['admin_password'] = Crypt::encrypt($data['admin_password']);
                //插入数据库
                DB::beginTransaction();
                $re1 = Admin::insertGetId($data);
                
                $arr = [];
                foreach($role_id as $k => $v) {
                    $arr[] = [
                        'admin_id'=>$re1,
                        'role_id'=>$v
                     ];
                }
                
                $re2 = DB::table('admin_role')->insert($arr);
                //判断
                if($re1 && $re2){
                    DB::commit();
                    return redirect('admin/admin');
                }else{
                    DB::rollBack();  
                    return back()->with('error','添加失败');
                }
            }

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 修改管理员页面
     * @param 参数:$id 管理员id
     * @return 返回 修改页面
     * @author zxs
     * @Date 2017-7-4 
     */
    public function edit($id)
    {
        //取数据
        $admin = Admin::find($id);
        $admin_role =Admin::find($id)->roles()->get();
        $role = Role::get();
        return view('admin.admin.edit',['data'=>$admin,'role'=>$role,'admin_role'=>$admin_role]);
    }

    /**
     * 更新管理员数据库
     * @param 参数:$id管理员id $request  请求数据
     * @return 返回
     * @author zxs
     * @Date 2017-7-5
     */
    public function update(Request $request, $id)
    {
        //接受数据
        $data = $request -> except(['_token','_method']);
        
        //设置规则
        $rule = [
            'admin_phone' => 'required',
            'admin_phone' => ['regex:/^1[3|4|5|8][0-9]\d{4,8}$/'],
            'admin_email' => 'required|email',
            'role_id' => 'required',
        ];
        //提示信息
         $mess=[
            'admin_phone.required'=>'必须输入电话',
            'admin_phone.regex'=>'电话格式不正确',
            'admin_email.required'=>'必须输入email',
            'admin_email.email'=>'email格式不正确',
            'role_id.required'=>'必须选择角色',

        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
         if ($validator->fails()) {
            return redirect('/admin/admin/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $arr = [];
            foreach ($data['role_id'] as $k => $v) {
                $arr[] = [
                    'admin_id' => $id,
                    'role_id' => $v,
                ];
            }
            dd($arr);
            unset($data['role_id']);
            //开启事务
            DB::beginTransaction();
            //更新管理员表
            $re1 = Admin::where('admin_id',$id) ->update($data);
            //删除原有管理员和角色的关联
            $re2 = DB::table('admin_role')->where('admin_id', $id)->delete();
            //插入新的关联
            $re3 = DB::table('admin_role')->insert($arr);
            
            if($re1 or $re2 && $re3){
                DB::commit();
                return redirect('admin/admin');
            }else{
                DB::rollBack();  
                return back()->with('error','修改失败');
            }
        }

    }

    /**
     * 删除管理员
     * @param 参数:$id管理员id
     * @return 返回 状态
     * @author zxs
     * @Date 2017-7-5
     */
    public function destroy($id)
    {
        //开启事务
        DB::beginTransaction();
        //删除指定管理员
        $res1 = Admin::where('admin_id',$id)->delete();
        //删除管理员和角色的关联表中数据
        $res2 = DB::table('admin_role')->where('admin_id', $id)->delete();

        //0表示成功 其他表示失败
       if($res1 && $res2){
            
           $data = [
                'status'=>0,
                'msg'=>'删除成功！'
           ];
           DB::commit();
       }else{
            
           $data = [
               'status'=>1,
               'msg'=>'删除失败！'
           ];
           DB::rollBack();
       }
        return $data;
    }
    /**
     * 管理员修改自己密码
     * @param 参数:管理员id
     * @return 返回 
     * @author zxs
     * @Date 2017-7-8
     */
    public function editself($id)
    {
        $admin = Admin::where('admin_id',$id) -> first();
        return view('admin.admin.editself',['data'=>$admin]);
    }
    /**
     * 管理员修改自己密码更新到数据库
     * @param 参数:请求数据
     * @return 返回 
     * @author zxs
     * @Date 2017-7-8
     */
    public function updateself(Request $request)
    {
        $data = $request->except('_token');
        
         //验证规则
        $rule = [
            'oldpassword' => 'required',
            'admin_password' => 'required',
            'admin_password' => ['regex:/^[a-zA-Z\d_]{6,16}$/'],
            'repassword' => 'required|same:admin_password',
        ];

        //提示信息
         $mess=[
            'oldpassword.required'=>'必须输入管理员名',
            'admin_password.required'=>'必须输入密码',
            'admin_password.regex'=>'密码必须为6到16位字母数字下划线',
            'repassword.required'=>'确认密码必须填写',
            'repassword.same'=>'两次密码输入不一致',

        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
         if ($validator->fails()) {
            return redirect("admin/admin/editself/".$data['admin_id'])
                        ->withErrors($validator)
                        ->withInput();
         }else{
            unset($data['oldpassword']);
            unset($data['repassword']);
           
            $data['admin_password'] = Crypt::encrypt($data['admin_password']);
            $re = Admin::where('admin_id',$data['admin_id']) ->update($data);
            
            if($re){
                return redirect('admin/index');
            }else{
                return back()->with('error','修改失败');
            }
        }
    }

}
