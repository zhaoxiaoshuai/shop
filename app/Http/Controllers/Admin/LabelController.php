<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Label;
use App\Http\Model\Label_attr;
use App\Http\Model\Type;
use DB;
use Validator;
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
        // if($request->has('keywords')){
        //     $key = trim($request->input('keywords'));
        //     $data = Label::where('label_name','like',"%".$key."%")->paginate(3);
        //     return view('admin.label.index',['data'=>$data,'key'=>$key]);
        // }
        // $a = Type::find(130)->labels()->get();
        // $a = Label::find(1)->type()->first();
        $data =  Label::get()->toArray();
        $arr = [];
        foreach($data as $k=>$v){
           $v['type_name'] = Label::find($v['label_id'])->type()->first()['type_name'];
           $arr[] = $v;
        }

        return view('admin.label.index',['data'=>$arr]);
    }

    /**
     * 加载标签添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取全部分类
        $types = Type::get();
        // dd($types);
        return view('admin.label.add',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->except('_token');
        // dd($data);
         //获取请求数据
        $data = $request -> except('_token');
        //验证规则
        $rule = [
            'type_id' => 'required',
            'label_name' => 'required',
            'label_attr_name' => 'required',
        ];
        //提示信息
        $mess=[
            'type_id.required'=>'必须选择分类',
            'label_name.required'=>'必须输入名称',
            'label_attr_name.required'=>'必须输入标签值',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/label/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{

            $label = Label::where('type_id',$data['type_id'])->where('label_name',$data['label_name']) ->first();

            if (!empty($label)) {
                return back()->with('error','此分类下已有此标签');
            }else{
                // dd($data);
                DB::beginTransaction();
                $arr = explode('，',$data['label_attr_name']);
                // dd($arr);
                unset($data['label_attr_name']);
                $res = Label::insertGetId($data);
                $las = [];
                foreach($arr as $k=>$v){
                    $las[] = [
                        'label_id'=>$res,
                        'label_attr_name'=>$v,
                    ];
                }
                // dd($las);
                $res2 = Label_attr::insert($las);
                if($res && $res2){
                    DB::commit();
                    return redirect('admin/label');
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
        //查询标签值内容
        $attr = Label_attr::where('label_id',$id)->get();
        return view('admin.label.show',compact('attr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取标签
        $label = Label::where('label_id',$id)->first();
        //获取标签值
        $attr = Label_attr::where('label_id',$id)->get()->toArray();
        $str = '';
        foreach($attr as $k=>$v){
            $str .=$v['label_attr_name'].'，'; 
        }
        $str = trim($str,'，');

        return view('admin.label.edit',compact('label','str'));
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
        // dd($request->all());
        $data = $request->except('_token','_method');
        //验证规则
        $rule = [
            'label_name' => 'required',
            'label_attr_name' => 'required',
        ];
        //提示信息
        $mess=[
            'label_name.required'=>'必须输入名称',
            'label_attr_name.required'=>'必须输入标签值',
        ];
        //进行验证
        $validator = Validator::make($data,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/label/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else{
             $arr = explode('，',$data['label_attr_name']);

            //dump($data);
             DB::beginTransaction();
            //更新标签表
             unset($data['label_attr_name']);
            $res1 = Label::find($id)->update($data);
            //删除原有标签值
            $res2 = Label_attr::where('label_id',$id)->delete();
            //插入新的标签值
            $las = [];
            foreach($arr as $k=>$v){
                $las[] = [
                    'label_id'=>$id,
                    'label_attr_name'=>$v,
                ];
            }
            $res3 = Label_attr::insert($las);
            //判断是否修改成功
            if($res1 && $res2 &&$res3){
                DB::commit();
                return redirect('admin/label'); //成功返回到列表页
            }else{
                DB::rollBack(); 
                return back()->with('error','修改失败');//失败返回上一级操作
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
         DB::beginTransaction();
        //删除对应id的标签
        $res1 = Label::where('label_id',$id)->delete();
        //删除对应的标签值
        $res2 = Label_attr::where('label_id',$id)->delete();
        if($res1 && $res2){
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
            DB::commit();
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败'
            ];
            DB::rollBack(); 
        }
        return $data;
    }
}




