<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\Http\Model\Role;
use App\Http\Model\Admin_role;
use App\Http\Model\Auth;
use DB;
class RoleController extends Controller
{
    /**
     * 角色分配权限
     * @param 参数:无
     * @return 返回角色列表页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function addAuth($id)
    {
        //获取角色
        $role = Role::find($id);
        //获取所有权限组
        $pauths = Auth::where('auth_group','0')->get();
        //获取所有的权限
        $auths = Auth::get()->toArray();
        //获取拥有的权限
        $role_auth =Role::find($id)->auths()->get();
        $role_auth = $role_auth->toarray();
        $id=[];
        foreach($role_auth as $k=>$v){
            $id[]=$v['auth_id'];
        }
        return view('admin.role.addauth',compact('role','pauths','auths','role_auth'));
    }
    /**
     * 执行角色分配权限
     * @param 参数:无
     * @return 返回角色列表页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function doaddAuth(Request $request)
    {
        $data = $request->except('_token');
        //验证规则
        $rule = [
            'auth_id' => 'required',
        ];
        //提示信息
         $mess=[
            'auth_id.required'=>'必须选择权限',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/role/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $arr = [];
            foreach($data['auth_id'] as $k=>$v){
                $arr[] = [
                    'role_id'=>$data['role_id'],
                    'auth_id'=>$v
                ];
            }
            //开启事务
            DB::beginTransaction();
            //删除原有角色和权限的关联
            $re1 = DB::table('role_auth')->where('role_id', $data['role_id'])->delete();
            //插入新的关联
            $re2 = DB::table('role_auth')->insert($arr);
             //判断
            if($re1 && $re2){
                DB::commit();
                return redirect('admin/role');
            }else{
                DB::rollBack(); 
                return back()->with('error','授权失败');
            }
        }
    }
    /**
     * 角色列表
     * @param 参数:无
     * @return 返回角色列表页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function index(Request $request)
    {
        //取出所有管理员角色关系表里面的角色id数据
        $admin_role = Admin_role::lists('role_id')->toArray();
        $admin_role = array_unique($admin_role);
        // dd($admin_role);
        $count = 5;
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
            $role = Role::where('role_name','like',"%".$key."%")->paginate($count);
            return view('admin.role.index',['data'=>$role,'key'=>$key,'admin_role'=>$admin_role]);
        }else{
            //取出数据
            $role = Role::paginate($count);
            //设置返回页面
            $key = '';
            return view('admin.role.index',['data'=>$role,'key'=>$key,'admin_role'=>$admin_role]);
        }
    }

     /**
     * 添加角色
     * @param 参数:无
     * @return 返回添加角色页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function create()
    {
        //获取所有权限组
        $pauths = Auth::where('auth_group','0')->get();
        // dd($pauths);
        //获取所有的权限
        $auths = Auth::get()->toArray();
        //引入添加角色表单
        return view('admin.role.add',compact('pauths','auths'));
    }

    /**
     * 添加角色到数据库
     * @param 参数:Request $request
     * @return 返回
     * @author zxs
     * @Date 2017-7-5 
     */
    public function store(Request $request)
    {
        
        //获取请求数据
        $data = $request -> except('_token');
        //验证规则
        $rule = [
            'role_name' => 'required',
            'role_description' => 'required',
            'auth_id' => 'required',
        ];
        //提示信息
         $mess=[
            'role_name.required'=>'必须输入角色名',
            'role_description.required'=>'必须输入角色描述',
            'auth_id.required'=>'必须选择权限',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/role/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $auth_id = $data['auth_id'];             
            unset($data['auth_id']);
            $role = Role::where('role_name',$data['role_name']) ->find(1);
            if (!empty($role)) {
                return back()->with('error','该角色名以存在');
            }else{
                DB::beginTransaction();
                //插入角色数据库并获取插入id
                $res1 = Role::insertGetId($data);
                $arr = [];
                foreach($auth_id as $k=>$v){
                    $arr[] = [
                        "role_id"=>$res1,
                        "auth_id"=>$v,
                    ];
                }
                //插入角色与权限关系
                $res2 = DB::table('role_auth')->insert($arr);
                //判断
                if($res1 && $res2){
                    DB::commit();
                    return redirect('admin/role');
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
     * 修改角色页面
     * @param 参数:$id 角色id
     * @return 返回 修改页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function edit($id)
    {
        //获取角色信息
        $role = Role::find($id);
        return view('admin.role.edit',['data'=>$role]);
    }

    /**
     * 更新角色数据库
     * @param 参数:$id角色id $request  请求数据
     * @return 返回
     * @author zxs
     * @Date 2017-7-5
     */
    public function update(Request $request, $id)
    {
         //获取请求数据
        $data = $request -> except('_token','_method');
        // dd($data);
        //验证规则
        $rule = [
            'role_name' => 'required',
            'role_description' => 'required',
        ];
        //提示信息
         $mess=[
            'role_name.required'=>'角色名不能为空',
            'role_description.required'=>'角色描述不能为空',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/role/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            //更新数据库
            $re = Role::where('role_id',$id) ->update($data);
            //判断
            if($re){
                return redirect('/admin/role');
            }else{
                return back()->with('error','修改失败');
            }
        }
    }

     /**
     * 删除角色
     * @param 参数:$id角色
     * @return 返回 
     * @author zxs
     * @Date 2017-7-6
     */
    public function destroy($id)
    {
         //删除指定管理员
        $res = Role::where('role_id',$id)->delete();
        //0表示成功 其他表示失败
       if($res){
           $data = [
                'status'=>0,
                'msg'=>'删除成功！'
           ];
       }else{
           $data = [
               'status'=>1,
               'msg'=>'删除失败！'
           ];
       }
        return $data;
    }
}
