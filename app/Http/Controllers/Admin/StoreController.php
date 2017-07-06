<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Store;
use App\Http\Model\merchant;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class StoreController extends Controller
{
    /**
     * 返回后台商家列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-3 20:55
     */
    public function index(Request $request)
    {
        $key1 = trim($request->input('keywords1')) ;
            $key2 = trim($request->input('keywords2')) ;
        if($request->has('keywords1') || $request->has('keywords2')){
            
            // 多表查询
            $store = DB::table('store')
                ->join('user','store.user_id','=','user.user_id')
                ->join('merchant','store.merchant_id','=','merchant.merchant_id')
                ->select('store_id','user_name','store_username','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
                ->where('audit_status','=','2')
                ->where('merchant_leverl','=',"{$key1}") 
                ->where('merchant_name','like',"%".$key2."%")
                ->paginate(3);
        }else{
           // 多表查询
            $store = DB::table('store')
                ->join('user','store.user_id','=','user.user_id')
                ->join('merchant','store.merchant_id','=','merchant.merchant_id')
                ->select('store_id','user_name','store_username','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
                ->where('audit_status','=','2')
                ->paginate(3);
        }
        

        // 加载商家列表模块
        return view('admin.store.storelist',['data'=>$store]);

    }

    /**
     * 返回后台商家申请列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-3 20:55
     */
    public function create()
    {
        // 多表查询
        $store = DB::table('store')
            ->where('audit_status','1')
            ->join('user','store.user_id','=','user.user_id')
            ->join('merchant','store.merchant_id','=','merchant.merchant_id')
            ->select('store_id','user_name','store_username','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
            ->get();

        //加载商家显示模版
        return view('admin.store.applylist',['data'=>$store]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        
    }

    /**
     * 返回后台商家信息详情页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-3 20:55
     */
    public function astoreindex($id)
    {
        // 多表查询
        $store = DB::table('store')
            ->where('store_id',$id)
            ->join('user','store.user_id','=','user.user_id')
            ->join('merchant','store.merchant_id','=','merchant.merchant_id')
            ->get();
        
       //加载商户信息模版
        return view('admin.store.storeindex',['data'=>$store]); 
    }

    /**
     * 返回后台商家详情页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-4 14:30
     */
    public function show($id)
    {
        // 多表查询
        $store = DB::table('store')
            ->where('store_id',$id)
            ->join('user','store.user_id','=','user.user_id')
            ->join('merchant','store.merchant_id','=','merchant.merchant_id')
            ->get();
        
        // 加载商家详情信息页
        return view('admin.store.storedetails',['data'=>$store]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 审批入驻商申请信息
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-5 13:50
     */
    public function update(Request $request, $id)
    {
        // 接收数据
        $data = $request -> except('_method','_token');

        // 执行修改
        $res = Store::where('store_id',$id)->update($data);
        
        if($res){
            // 指定字段查询
            $store = Store::where('store_id',$id)->select('audit_status')->get()[0];
            // 如果 audit_status 等于3 就执行删除
            if($store['audit_status'] == '3'){
                // 执行删除
                $re = Store::where('store_id',$id)->delete();

                return redirect('admin/astore/create');

            }else{

                return redirect('admin/astore/create');

            }

        }else{

            return redirect('admin/astore/create');
        }
    }

    /**
     * 删除商户申请店铺信息
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-5 19:00
     */
    public function destroy($id)
    {
        //删除对应id的用户
        $sto = Store::where('store_id',$id)->delete();
        $mer = Merchant::where('merchant_id',$id)->delete();

        if($sto == $mer){
            // 0表示成功 其他表示失败
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


    }
}
