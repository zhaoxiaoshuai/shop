<?php

namespace App\Http\Controllers\Store;

use App\Http\Model\Good;
use App\Services\OSS;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;


class GoodsController extends Controller
{
    /**
     * 返回商家后台商品列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-11 19:05
     */
    public function index(Request $request)
    {
        // 获取店铺的id
        $merchant_id = '3';
        // 如果keywords参数有值说明是通过查询进入index方法的，否则是通过商品列表导航进入的
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
            $good = Good::where('good_name','like',"%".$key."%")
                        ->where('merchant_id',$merchant_id)
                        ->paginate(10);;
            return view('store.goods.index',['data'=>$good,'key'=>$key]);
        }else{
            //两表联查shop_goods shop_type
            $data =  Good::join('type','goods.type_id','=','type.type_id')
                            ->where('merchant_id',$merchant_id)
                            ->orderBy('goods.good_id','asc')
                            ->paginate(3);
           // dd($data);
                 // 向前台模板传变量的一种方法
            return view('store.goods.index',compact('data'));
        }
       
    }

    public function detail($id)
    {
        
    }

    /**
     * 返回商家后台添加商品页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-11 10:20
     */
    public function create()
    {
        $type = DB::table('type')->get();
        // 加载添加商品页面
        return view('store.goods.add',compact('type'));
    }

    /**
     * 返回商家后台执行添加商品页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-11 10:20
     */
    public function store(Request $request)
    {
        // 接收数据
        // dd($request->all());
      $data =  $request -> except('_token','file_upload');
      $data['good_ctime'] = time();
      $data['merchant_id'] = '3';
      $role =  [
            'good_name' => 'required',
            'type_id' => 'required',
            'good_label' => 'required',
            'good_price' => 'required|numeric',
            'good_desc' => 'required',
            'good_count' => 'required|numeric',
            'good_pic' => 'required',
            'good_status' => 'required',
        ];
      // 提示信息
        $mess=[
            'good_name.required'=>'请填写商品名称',
            'type_id.required'=>'请选择商品分类',
            'good_label.required'=>'请选择商品标签',
            'good_price.required'=>'请填写商品价格',
            'good_price.numeric'=>'商品价格请填写数字',
            'good_desc.required'=>'请填写商品描述',
            'good_count.required'=>'请填写商品库存',
            'good_count.numeric'=>'商品库存请填写数字',
            'good_pic.required'=>'请上传图片',
            'good_status.required'=>'请选择商品状态',
        ];
      // 表单验证
      $validator =  Validator::make($data,$role,$mess);
      if($validator->passes()){
        //执行添加
        $goods = Good::create($data);
        if($goods){
            return redirce('store/goods');
        }else{
            return back()->with('error','添加失败'); 
        }
      }else{
        // 如果没有通过表单验证则抛出错误
          return back()->withErrors($validator);
      }
    }


    public function upload()
    {
       // 将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('file_upload');
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

           // 将图片上传到本地服务器

            // $path = $file->move(public_path() . '/uploads', $newName);

           // 将图片上传到七牛云
           // \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

           // oss上传

            $result = OSS::upload('uploads/'.$newName, $file->getRealPath());


       // 返回文件的上传路径
            $filepath = 'uploads/' . $newName;
            return $filepath;
        }
    }

    /**
     * 返回商家后台商品详情页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-11 23:51
     */
    public function show($id)
    {
        //加载商品详情页
        //两表联查shop_goods shop_type
        $data =  Good::join('type','goods.type_id','=','type.type_id')
                ->where('goods.good_id',$id)
                ->first();
       
        // 向前台模板传变量的一种方法
        return view('store.goods.details',compact('data','id'));
    }

    /**
     * 返回商家后台修改商品页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-11 22:20
     */
    public function edit($id)
    {
         // 通过shop_good表type_id查询到对应的shop_type的值
       // $type = Good::join('type','goods.type_id','=','type.type_id')->get();
       // dd($type);
        //根据传入要修改的ID商品 获取单条
        $data = Good::where('good_id',$id)->first();
       // 根据传过来的商品id获取type_id查找shop_type表里的分类
        $type = DB::table('type')->where('type_id',$data->type_id)->first();
       // dd($type['type_id']);
        $types = DB::table('type')->get();
       // dd($types);
        return view('store.goods.edit',compact('data','type','types'));
    }

    /**
     * 返回商家后台修改商品页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-11 23:10
     */
    public function update(Request $request, $id)
    {
        // 接收指定值
        $data = Input::except('_token','_method','file_upload');
        //执行修改
        
        $res = Good::where('good_id',$id)->update($data);

        //如果成功跳转到列表页  失败返回修改页
        if($res){
            return redirect('store/goods');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * 返回商家后台删除商品
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-11 23:10
     */
    public function destroy($id)
    {
        ////删除对应id的商品
        $re =  Good::where('good_id',$id)->delete();
      // 0表示成功 其他表示失败
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
