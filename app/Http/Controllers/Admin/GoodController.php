<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Good;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\OSS;
use Illuminate\Support\Facades\Input;
use Validator;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
//        将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('file_upload');
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

//            将图片上传到本地服务器
            $path = $file->move(public_path() . '/uploads', $newName);

//            将图片上传到七牛云
//            \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

//            oss上传
//            $result = OSS::upload('uploads/'.$newName, $file->getRealPath());

//        返回文件的上传路径
            $filepath = 'uploads/' . $newName;
            return $filepath;
        }
    }

    public function index(Request $request)
    {
//        如果请求携带keywords参数说明是通过查询进入index方法的，否则是通过商品列表导航进入的
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
            $good = Good::where('good_name','like',"%".$key."%")->paginate(10);;
            return view('admin.good.index',['data'=>$good,'key'=>$key]);
        }else{
            //查询出good表的所有数据
            $data =  Good::orderBy('good_id','asc')->paginate(10);
            //      向前台模板传变量的一种方法
            return view('admin.good.index',compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.good.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
      $input =  Input::except('_token','file_upload');
      $input['good_ctime'] = time();
      $role =  [
            'good_name' => 'required',
            'type_id' => 'required',
            'good_label' => 'required',
            'good_price' => 'required|numeric',
            'good_desc' => 'required',
            'good_count' => 'required',
            'good_pic' => 'required',
        ];
//       提示信息
        $mess=[
            'good_name.required'=>'必须输入商品名',
            'type_id.required'=>'类别必选',
            'good_label.required'=>'标签必填',
            'good_price.required'=>'价格必填',
            'good_desc.required'=>'描述必填',
            'good_count.required'=>'库存必填',
            'good_pic.required'=>'请上传图片',
        ];
//       表单验证
      $validator =  Validator::make($input,$role,$mess);
//      dd($validator);
//      如果通过表单验证
      if($validator->passes()){
          $re = Good::create($input);
         if($re){
//             如果添加成功添加到商品列表页
             return redirect('admin/good');
         }else{
             return back()->with('error','添加失败');
         }
      }else{
//          如果没有通过表单验证
          return back()->withErrors($validator);
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
        //找到要修改的用户记录，返回给修改页面
//        find(1) 也会返回一个对象
        //根据传入的要修改的记录ID 获取商品记录
        $data = Good::where('good_id',$id)->first();
//        dd($data);
        return view('admin.good.edit',compact('data'));
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
        //根据id获取修改记录
        $good = Good::find($id);
        //根据请求传过来的参数获取到要修改成的记录
        $input = Input::except('_token','_method','file_upload');
        //更新
        $re = $good->update($input);
        //如果成功跳转到列表页  失败返回修改页
        if($re){
            return redirect('admin/good');
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
        ////删除对应id的商品
        $re =  Good::where('good_id',$id)->delete();
//       0表示成功 其他表示失败
        if($re){
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
