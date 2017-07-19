<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\http\Model\Auth;
use DB;

class AuthController extends Controller
{
    /**
     * 添加权限
     * @param 参数:无
     * @return 返回添加权限页面
     * @author zxs
     * @Date 2017-7-16 
     */
    public function createauth(Request $request)
    {
        $id = $request -> only('id')['id'];
        //获取所属权限组
        $data = Auth::where('auth_id',$id)->get()[0];
        //引入添加权限表单
        return view('admin.auth.addauth',compact('data'));
    }
    /**
     * 权限列表
     * @param 参数:无
     * @return 返回权限列表页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function index(Request $request)
    {
        $count = 100;
        //判断请求来自哪里
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
            $auth = Auth::where('auth_name','like',"%".$key."%")->orderBy('auth_content')->paginate($count);
            return view('admin.auth.index',['data'=>$auth,'key'=>$key]);
        }else{
            //取出数据
            $auth = Auth::orderBy('auth_content')->paginate($count);
            //设置返回页面
            $key = '';
            return view('admin.auth.index',['data'=>$auth,'key'=>$key]);
        }
       
    }

     /**
     * 添加权限组
     * @param 参数:无
     * @return 返回添加权限组页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function create()
    {
        
        //引入添加权限表单
        return view('admin.auth.addgroup',compact('data'));
    }

    /**
     * 添加权限到数据库
     * @param 参数:Request $request
     * @return 返回
     * @author zxs
     * @Date 2017-7-5 
     */
    public function store(Request $request)
    {
    	//判断请求来自哪里
        if($request ->has('auth_group')){
            //获取请求数据
            $data = $request -> except('_token');
            
            //验证规则
            $rule = [
                'auth_name' => 'required',
                'auth_content' => 'required',
                'auth_group' => 'required',
            ];
            //提示信息
             $mess=[
                'auth_name.required'=>'必须输入权限名',
                'auth_content.required'=>'必须输入权限内容',
                'auth_group.required'=>'必须输入权限组',
            ];
            //进行验证
            $validator = Validator::make($data,$rule,$mess);
            if ($validator->fails()) {
                return redirect('/admin/auth/create')
                            ->withErrors($validator)
                            ->withInput();
            }else{
                $auth = Auth::where('auth_content',$data['auth_content']) ->find(1);
                if (!empty($auth)) {
                    return back()->with('error','该权限已存在');
                }else{
                    //插入数据库
                    $re = Auth::create($data);
                    //判断
                    if($re){
                        return redirect('admin/auth');
                    }else{
                        return back()->with('error','添加失败');
                    }
                }
            }
        }else{
            //获取请求数据
            $data = $request -> except('_token');
            //验证规则
            $rule = [
                'auth_name' => 'required',
                'auth_content' => 'required',
            ];
            //提示信息
             $mess=[
                'auth_name.required'=>'必须输入权限名',
                'auth_content.required'=>'必须输入权限内容',
            ];
            //进行验证
            $validator = Validator::make($data,$rule,$mess);
            if ($validator->fails()) {
                return redirect('/admin/auth/create')
                            ->withErrors($validator)
                            ->withInput();
            }else{
                $auth = Auth::where('auth_content',$data['auth_content']) ->find(1);
                
                if (!empty($auth)) {
                    return back()->with('error','该权限已存在');
                }else{
                    //插入数据库
                    $re = Auth::create($data);
                    //判断
                    if($re){
                        return redirect('admin/auth');
                    }else{
                        return back()->with('error','添加失败');
                    }
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
     * 修改权限页面
     * @param 参数:$id 权限id
     * @return 返回 修改页面
     * @author zxs
     * @Date 2017-7-5 
     */
    public function edit($id)
    {

        //取要修改的数据
        $auth = Auth::find($id);
        if($auth['auth_group']){
             //取出所属权限组
            $pauth = Auth::where('auth_id',$auth['auth_group'])->get()[0];
        }
         $pauth = '';
        return view('admin.auth.edit',compact('auth','pauth'));
    }

    /**
     * 更新权限数据库
     * @param 参数:$id权限id $request  请求数据
     * @return 返回
     * @author zxs
     * @Date 2017-7-5
     */
    public function update(Request $request, $id)
    {

         //获取请求数据
        $data = $request -> except('_token','_method');
        // dd($id);
        //验证规则
        //验证规则
        $rule = [
            'auth_name' => 'required',
            'auth_content' => 'required',
        ];
        //提示信息
         $mess=[
            'auth_name.required'=>'必须输入权限名',
            'auth_content.required'=>'必须输入权限内容',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/auth/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            //更新数据库
            $re = Auth::where('auth_id',$id) ->update($data);

            //判断
            if($re){
                return redirect('/admin/auth');
            }else{
                return back()->with('error','修改失败');
            }
        }
    }

     /**
     * 删除权限
     * @param 参数:$id权限
     * @return 返回 
     * @author zxs
     * @Date 2017-7-6
     */
    public function destroy($id)
    {
         //删除指定管理员
        $res = Auth::where('auth_id',$id)->delete();
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
