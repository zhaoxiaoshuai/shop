<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Label;
use DB;
class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //如果是通过查询方式过来的
        if($request->has('keywords')){
            $key = trim($request->input('keywords'));
            $data = Label::where('label_name','like',"%".$key."%")->paginate(3);
            return view('admin.label.index',['data'=>$data,'key'=>$key]);
        }
        $data =  Label::orderBy('id','asc')->paginate(3);
        return view('admin.label.index',['data'=>$data]);
    }

    /**
     * 加载标签添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.label.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request,[
            'label_name' =>'required',
        ],[
            'label_name.required' => '标签名不能为空',
        ]);
       $data =  $request ->except('_token');
//       dd($data);
        $label = new Label();
        $label->label_name = $data['label_name'];
        $res = $label->save();//执行添加语句
        if($res){
            return redirect('admin/label');
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
        $data = Label::where('id',$id)->first();
        return view('admin.label.edit',compact('data'));
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

        $data = $request->except('_token','_method');
//        dump($data);
        $res = Label::where('id',$id)->update($data);
        //判断是否修改成功
        if($res){
            return redirect('admin/label'); //成功返回到列表页
        }else{
            return back()->with('error','修改失败');//失败返回上一级操作
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
        //删除对应id的标签
        $res = Label::where('id',$id)->delete();
        if($res){
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }
}




