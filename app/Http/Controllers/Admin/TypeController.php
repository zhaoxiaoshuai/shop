<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class TypeController extends Controller
{
    /**
     * @param 参数
     * @return 返回值
     * @author 邹帅
     * @Date 2017-7-4 15:46
     */

    public function index(Request $request)
    {   
        //如果请求携带keywords参数说明是通过查询进入方法的，否则是通过用户列表导航进入的
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
            $type = DB::table('type')->where('type_name','like',"%".$key."%")->paginate(8);
            return view('admin.type.viewtype',['data'=>$type,'key'=>$key]);
        }else{
            //查询出type表的所有数据
             $data = DB::table('type')->orderBy('type_npath', 'asc')->paginate(8);
            
            return view('admin.type.viewtype',['data'=>$data]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加分类模版
        //获取一级分类
        $data = DB::table('type')->select('type_id','type_name','type_path','type_npath')->orderBy('type_npath', 'asc')->get();

        return view('admin.type.addtype',['data'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $this->validate($request, [
            'pid' => 'required',
            'type_name' => 'required',
        ],[
            'pid.required' => '商品类型名称必填',
            'type_name.required' => '商品名称必填',

        ]);


       // 获取
        $data = $request->except('_token');
        
        if($data['pid'] == '0'){
            $data['type_path'] = '0-';
        }else{
            // 根据子类的pid获取到父类的信息
            $res = DB::table('type')->where('type_id',$data['pid'])->get()[0];
            $data['type_path'] = $res['type_npath'];
        }
        // 先插入一个半成品 获取tid
        $tid = DB::table('type')->insertGetId($data);
        // 自己的 npath  =  自己的path.自己的tid.'-'
        $data['type_npath'] = $data['type_path'].$tid.'-';
        // 修改数据
        $res = DB::table('type')->where('type_id',$tid)->update($data);

        if ($res) {
            return redirect('admin/atype');
             
        }else{
             return back()->with('error','添加失败');

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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
       


        $data = DB::table('type')->where('type_id',$id)->get();
        // dd($data);
        return view('admin.type.edittype',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'type_name' => 'required',
        ],[
            'type_name.required' => '商品名称必填',
        ]);

        $input = $request->except('_token','_method');
        
        $res = DB::table('type')->where('type_id', $id)->update($input);
        dd($input);
        if ( $res) {
            return redirect('admin/atype');
             
        }else{
             return back()->with('error','修改失败');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr = DB::table('type')->where('pid',$id)->get();
        $arr1 = DB::table('goods')->where('type_id',$id)->get();
        
        if($arr){
            $data =[
                'status'=>1,
                'msg'=>'分类下有子类'
            ];
            return;
        }

        if($arr1){
            $data =[
                'status'=>1,
                'msg'=>'分类下有商品'  
            ];
            return;
        }
        //删除对应id的用户
        $res = DB::table('type')->where('type_id', $id)->delete();

        // 0表示成功 其他表示失败
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



