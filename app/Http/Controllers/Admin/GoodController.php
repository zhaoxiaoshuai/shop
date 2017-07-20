<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Good;
use App\Http\Model\Goodpic;
use App\Http\Model\Type;
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
     * 上传商品大图
     * @param
     * @return 文件上传路径
     * @author gcj
     * @Date
     */
    public function upload()
    {
//        将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('file_upload');
//        dd($file);
            if ($file->isValid()) {
                $entension = $file->getClientOriginalExtension();//上传文件的后缀名
                $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

//          将图片上传到阿里oss
                $result = OSS::upload('uploads/' . $newName, $file->getRealPath());

//        返回文件的上传路径
                $filepath = 'uploads/' . $newName;

        }
        return $filepath;
    }

    /**
     * 商品列表
     * @param  Request $request 店铺id
     * @return 商品列表页面
     * @author gcj
     * @Date
     */
    public function index(Request $request)
    {
        $page = 4;
        $key1 = trim($request->input('keywords1')) ;
        $key2 = trim($request->input('keywords2')) ;
        $type = DB::table('type')->orderBy('type_npath','asc')->get();
        $type1 = Type::get();
        //关键字查询$keywords1
        if($request->has('keywords1')){

            $good = Good::where('good_name','like',"%".$key1."%")
                ->where('merchant_id','0')
                ->paginate($page);
            //关键字查询$keywords1
        }elseif($request->has('keywords2')){
        $good = Good::where('type_id',$key2)
            ->where('merchant_id','0')
            ->paginate($page);

        }else{
                //两表联查shop_goods shop_type
                $good =  Good::join('type','goods.type_id','=','type.type_id')
                    ->where('merchant_id','0')
                    ->orderBy('goods.good_id','asc')
                    ->paginate($page);
            }

        return view('admin.good.index',compact('good','key1','key2','type','type1'));

    }


    /**
     * 店铺商品列表
     * @param  商品id $id
     * @return 商品详情页面
     * @author gcj
     * @Date
     */
    public function mindex(Request $request)
    {
        // 获取指定输入值
        $key1 = trim($request->input('keywords1'));
        $key2 = trim($request->input('keywords2'));

        // 多表查询
        $data = DB::table('store')
            ->join('user','store.user_id','=','user.user_id')
            ->join('merchant','store.merchant_id','=','merchant.merchant_id')
            ->select('store_id','user_name','store_username','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
            ->where('audit_status','=','2')
            ->orderBy('store_id','desc')
            ->paginate(5);

        // has 确认是否有输入值
        if($request->has('keywords1')){
            // 多表查询
            $data = DB::table('store')
                ->join('user','store.user_id','=','user.user_id')
                ->join('merchant','store.merchant_id','=','merchant.merchant_id')
                ->select('store_id','user_name','store_username','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
                ->where('merchant_leverl','=',"{$key1}")
                ->where('audit_status','=','2')
                ->paginate(5);
        }

        // has 确认是否有输入值
        if($request->has('keywords2')){
            // 多表查询
            $data = DB::table('store')
                ->join('user','store.user_id','=','user.user_id')
                ->join('merchant','store.merchant_id','=','merchant.merchant_id')
                ->select('store_id','user_name','store_username','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
                ->where('audit_status','=','2')
                ->where('merchant_name','like',"%".$key2."%")
                ->paginate(5);
        }

        $arr = ['1'=>'未审核','审核通过','审核不通过'];
        $arr2 = ['1'=>'初级','中级','高级'];

        // 加载商家列表模块
        return view('admin.store.storelist',['data'=>$data,'arr'=>$arr,'arr2'=>$arr2,'key1'=>$key1,'key2'=>$key2]);

    }

    /**
     * 商品详情
     * @param  商品id $id
     * @return 商品详情页面
     * @author gcj
     * @Date
     */
    public function detail($id)
    {

            //两表联查shop_goods shop_type
            $data =  Good::join('type','goods.type_id','=','type.type_id')->where('goods.good_id',$id)->first();
//            dd($data);
            //      向前台模板传变量的一种方法
            return view('admin.good.detail',compact('data','id'));

    }



    /**
     * 添加商品
     * @param
     * @return 添加商品页面
     * @author gcj
     * @Date
     */
    public function create()
    {
        $type = DB::table('type')->orderBy('type_npath','asc')->get();
        return view('admin.good.add',['type'=>$type]);
    }

    /**
     * 添加商品
     * @param  Request $request
     * @return 成功商品列表页 失败商品添加页
     * @author gcj
     * @Date
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
            'good_price' => 'required|numeric',
            'good_desc' => 'required',
            'good_count' => 'required|numeric',
            'good_pic' => 'required',
            'good_status' => 'required',
        ];
//       提示信息
        $mess=[
            'good_name.required'=>'请填写商品名称',
            'type_id.required'=>'请选择商品分类',
            'good_price.required'=>'请填写商品价格',
            'good_price.numeric'=>'商品价格请填写数字',
            'good_desc.required'=>'请填写商品描述',
            'good_count.required'=>'请填写商品库存',
            'good_count.numeric'=>'商品库存请填写数字',
            'good_pic.required'=>'请上传商品大图',
            'good_status.required'=>'请选择商品状态',
        ];
//       表单验证
      $validator =  Validator::make($input,$role,$mess);
//      dd($validator);
//      如果通过表单验证
      if($validator->passes()){
          $file = Input::file('good_pics');
//        dd($file);
          $arr = [];
          if($file[0] != null) {
              foreach ($file as $k => $v) {
                  if ($v->isValid()) {
                      $entension = $v->getClientOriginalExtension();//上传文件的后缀名
                      $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
//            oss上传
                      $result = OSS::upload('uploads/' . $newName, $v->getRealPath());

//        返回文件的上传路径
                      $filepath = 'uploads/' . $newName;

                      $arr[] = $filepath;
                  }
              }
              $good_pics = $input['good_pics'];
              unset($input['good_pics']);
              //开启事务
              DB::beginTransaction();
              $re = Good::insertGetId($input);
              $goodpics = [];
              foreach ($arr as $k => $v) {
                  $goodpics[] = [
                      'good_id' => $re,
                      'good_pics' => $v,
                  ];
              }
              $res = Goodpic::insert($goodpics);

              if ($res && $res) {
                  DB::commit();
//             如果添加成功添加到商品列表页
                  return redirect('admin/good');
              } else {
                  DB::rollBack();
                  return back()->with('error', '添加失败');
              }
          }else{
              $inp =  Input::except('_token','file_upload','good_pics');
              $inp['good_ctime'] = time();
//              插入到商品表
              $re = Good::insert($inp);
              if ($re) {
//             如果添加成功添加到商品列表页
                  return redirect('admin/good');
              } else {
                  return back()->with('error', '添加失败');
              }
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
     * 修改商品
     * @param  商品id $id
     * @return 商品修改页面
     * @author gcj
     * @Date
     */
    public function edit($id)
    {

        //根据传入的要修改的记录ID 获取商品记录
        $data = Good::where('good_id',$id)->first();
        //取出该商品分类
        $type = DB::table('type')->where('type_id',$data->type_id)->first();
        //取出所有分类
        $types = DB::table('type')->orderBy('type_npath','asc')->get();
        //取出该商品所有图片
        $pics = DB::table('goodpic')->where('good_id',$id)->get();

        return view('admin.good.edit',compact('data','type','types','pics'));
    }

    /**
     * 修改商品
     * @param  Request $request 商品id $id
     * @return 成功商品列表页 失败商品修改页
     * @author gcj
     * @Date
     */
    public function update(Request $request, $id)
    {
        //获取页面传值
        $input =  Input::except('_token','file_upload','_method');
        $role =  [
            'good_name' => 'required',
            'type_id' => 'required',
            'good_price' => 'required|numeric',
            'good_desc' => 'required',
            'good_count' => 'required|numeric',
            'good_pic' => 'required',
            'good_status' => 'required',
        ];
//       提示信息
        $mess=[
            'good_name.required'=>'请填写商品名称',
            'type_id.required'=>'请选择商品分类',
            'good_price.required'=>'请填写商品价格',
            'good_price.numeric'=>'商品价格请填写数字',
            'good_desc.required'=>'请填写商品描述',
            'good_count.required'=>'请填写商品库存',
            'good_count.numeric'=>'商品库存请填写数字',
            'good_pic.required'=>'请上传商品大图',
            'good_status.required'=>'请选择商品状态',
        ];
//       表单验证
        $validator =  Validator::make($input,$role,$mess);
//      如果通过表单验证
        if($validator->passes()){
            $good = Good::find($id);
            $file = Input::file('good_pics');
            if($file[0] != null){
                $arr = [];
                foreach ($file as $k=>$v){
                    if ($v->isValid()) {
                        $entension = $v->getClientOriginalExtension();//上传文件的后缀名
                        $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
//            oss上传
                        $result = OSS::upload('uploads/' . $newName, $v->getRealPath());
//        返回文件的上传路径
                        $filepath = 'uploads/' . $newName;
                        $arr[] = $filepath;
                    }
                }

            $good_pics= $input['good_pics'];
            unset($input['good_pics']);
            //开启事务
            DB::beginTransaction();
            $goodpics = [];
            foreach ($arr as $k=>$v){
                $goodpics[]=[
                    'good_id'=>$id,
                    'good_pics'=>$v,
                ];
            //删除图片
            $re = Goodpic::where('good_id',$id)->delete();
            //插入修改图片
            $res = Goodpic::insert($goodpics);
            $r = $good->update($input);
            }

            if($res && $re && $r ){
                DB::commit();
//             如果修改成功添加到商品列表页
                return redirect('admin/good');
            }else{
                DB::rollBack();
                return back()->with('error','修改失败');
            }
            }else{
                $put =  Input::except('_token','file_upload','_method','good_pics');
                $r = $good->update($put);
                if($r){
                   // 如果修改成功添加到商品列表页
                return redirect('admin/good');
                }else{
                    return back()->with('error','修改失败');
                }
            }
        }else{
//          如果没有通过表单验证
            return back()->withErrors($validator);
        }

    }

    /**
     * 删除商品
     * @param   商品id $id
     * @return 回调函数 $data
     * @author gcj
     * @Date
     */
    public function destroy($id)
    {
        ////删除对应id的商品
        $re =  Good::where('good_id',$id)->delete();
        $res = Goodpic::where('good_id',$id)->delete();
//        return($re);
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
