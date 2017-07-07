<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\http\Model\Role;

class RoleController extends Controller
{
    /**
     * 角色列表
     * @param 参数:无
     * @return 返回角色列表页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function index(Request $request)
    {
        $count = 2;
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
            $role = Role::where('role_name','like',"%".$key."%")->paginate($count);
            return view('admin.role.index',['data'=>$role,'key'=>$key]);
        }else{
            //取出数据
            $role = Role::paginate($count);
            //设置返回页面
            $key = '';
            return view('admin.role.index',['data'=>$role,'key'=>$key]);
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
        //引入添加角色表单
        return view('admin.role.add');
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
        ];

        //提示信息
         $mess=[
            'role_name.required'=>'必须输入角色名',
            'role_description.required'=>'必须输入角色描述',
           
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/role/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $role = Role::where('role_name',$data['role_name']) ->find(1);
            if (!empty($role)) {
                return back()->with('error','该角色名以存在');
            }else{
              
                //插入数据库
                $re = Role::create($data);
                //判断
                if($re){
                    return redirect('admin/role');
                }else{
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
         //取数据
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
