<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Good;
use App\Http\Model\Goodpic;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\OSS;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
//        return($file);
            if ($file->isValid()) {
                $entension = $file->getClientOriginalExtension();//上传文件的后缀名
                $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

//            将图片上传到本地服务器

                // $path = $file->move(public_path() . '/uploads', $newName);

//            将图片上传到七牛云
//            \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

//            oss上传

                $result = OSS::upload('uploads/' . $newName, $file->getRealPath());


//        返回文件的上传路径
                $filepath = 'uploads/' . $newName;


        }
        return $filepath;
    }

    public function index(Request $request)
    {
//        如果请求携带keywords参数说明是通过查询进入index方法的，否则是通过商品列表导航进入的
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
//            dd($key);
            $good = Good::where('good_name','like',"%".$key."%")->paginate(5);
            return view('admin.good.index',['data'=>$good,'key'=>$key]);
        }else{
            //两表联查shop_goods shop_type
            $data =  Good::join('type','goods.type_id','=','type.type_id')->orderBy('goods.good_id','asc')->paginate(5);
//            dd($data);
            //      向前台模板传变量的一种方法
            return view('admin.good.index',compact('data'));
        }
    }

    public function detail($id)
    {

            //两表联查shop_goods shop_type
            $data =  Good::join('type','goods.type_id','=','type.type_id')->where('goods.good_id',$id)->first();
//            dd($data);
            //      向前台模板传变量的一种方法
            return view('admin.good.detail',compact('data','id'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = DB::table('type')->get();
//        dd($type);
        return view('admin.good.add',compact('type'));
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
//      dd($input);
      $input['good_ctime'] = time();
      $role =  [
            'good_name' => 'required',
            'type_id' => 'required',
            'good_label' => 'required',
            'good_price' => 'required|numeric',
            'good_desc' => 'required',
            'good_count' => 'required|numeric',
            'good_pic' => 'required',
            'good_status' => 'required',
            'good_pics' => 'required',
        ];
//       提示信息
        $mess=[
            'good_name.required'=>'请填写商品名称',
            'type_id.required'=>'请选择商品分类',
            'good_label.required'=>'请选择商品标签',
            'good_price.required'=>'请填写商品价格',
            'good_price.numeric'=>'商品价格请填写数字',
            'good_desc.required'=>'请填写商品描述',
            'good_count.required'=>'请填写商品库存',
            'good_count.numeric'=>'商品库存请填写数字',
            'good_pic.required'=>'请上传商品大图',
            'good_status.required'=>'请选择商品状态',
            'good_pics.required'=>'请上传商品缩略图',
        ];
//       表单验证
      $validator =  Validator::make($input,$role,$mess);
//      dd($validator);
//      如果通过表单验证
      if($validator->passes()){
          $file = Input::file('good_pics');
//        dd($file);
          $arr = [];
          foreach ($file as $k=>$v){
              if ($v->isValid()) {
                  $entension = $v->getClientOriginalExtension();//上传文件的后缀名
                  $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
//                dd($)
//            oss上传

                  $result = OSS::upload('uploads/' . $newName, $v->getRealPath());


//        返回文件的上传路径
                  $filepath = 'uploads/' . $newName;

                  $arr[] = $filepath;
              }
          }
//        dd($arr);

          DB::beginTransaction();
          $re = Good::insertGetId($input);
          $goodpics = [];
          foreach ($arr as $k=>$v){
              $goodpics[]=[
                  'good_id'=>$re,
                  'good_pics'=>$v,
              ];
          }
         $res = Goodpic::insert($goodpics);

//          dd($res);

         if($re){
             DB::commit();
//             如果添加成功添加到商品列表页
             return redirect('admin/good');
         }else{
             DB::rollBack();
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
        //通过shop_good表type_id查询到对应的shop_type的值
//        $type = Good::join('type','goods.type_id','=','type.type_id')->get();
//        dd($type);
        //根据传入的要修改的记录ID 获取商品记录
        $data = Good::where('good_id',$id)->first();
//        dd($data->good_status);
        $type = DB::table('type')->where('type_id',$data->type_id)->first();
//        dd($data);
        $types = DB::table('type')->get();
//        dd($types);
        return view('admin.good.edit',compact('data','type','types'));
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
//        dd($good);
        //根据请求传过来的参数获取到要修改成的记录
        $input = Input::except('_token','_method','file_upload');
//        dd($input);
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
