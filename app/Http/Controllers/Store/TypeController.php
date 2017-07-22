<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;

use App\Http\Model\Type;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Model\Mtype;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //获取店铺id
        $id = session('store_admin')['merchant_id'];
        //获取所有店铺的分类
        $mtype = Mtype::where('merchant_id',$id)->get();
        //获取分类树
        $mtype = Mtype::tree($mtype);
        //加载店铺分类页面
        return view('store.type.index',compact('mtype'));
    }

    /**
     * 返回商家后台分类添加页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 9:05
     */
    public function create()
    {
        //获取店铺id
        $id = session('store_admin')['merchant_id'];
        //获取所有店铺的分类
        $mtype = Mtype::where('merchant_id',$id)->get();
        //获取分类树
        $mtype = Mtype::tree($mtype);

        //加载店铺分类添加页面
        return view('store.type.add',compact('mtype'));
    }

    /**
     * 返回商家后台执行添加分类页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 9:30
     */
    public function store(Request $request)
    {
        
        //获取输入的分类名字
        $data = $request->except('_token');
         //验证规则
        $rule = [
            'mtype_name' => 'required',
        ];
        //提示信息
         $mess=[
            'mtype_name.required'=>'必须填写分类名称',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
         if ($validator->fails()) {
            return redirect('/store/type/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            //获取商家id
            $data['merchant_id'] = session('store_admin')['merchant_id'];
            
            //将分类存入数据库
            $res = Mtype::insert($data);
            //判断
            if($res){
                return redirect('store/type');
            }else{
                return back()->with('error','添加失败');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取要修改的分类
        $mtype = Mtype::find($id);
        //获取父类
        $pmtype = Mtype::find($mtype['mtype_pid']);

        return view('store.type.edit',compact('mtype','pmtype'));
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
          //获取输入的分类名字
        $data = $request->except('_token','_method');
        
         //验证规则
        $rule = [
            'mtype_name' => 'required',
        ];
        //提示信息
         $mess=[
            'mtype_name.required'=>'必须填写分类名称',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
         if ($validator->fails()) {
            return redirect('/store/type/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            //获取商家id
            $data['merchant_id'] = session('store_admin')['merchant_id'];
            
            //将分类存入数据库
            $res = Mtype::where('mtype_id',$id)->update($data);
            //判断
            if($res){
                return redirect('store/type');
            }else{
                return back()->with('error','修改失败');
            }
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
        
       //删除对应id的用户
        $res = Mtype::where('mtype_id',$id)->delete();
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
