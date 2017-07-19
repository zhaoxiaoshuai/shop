<?php

namespace App\Http\Controllers\Home;
use App\Http\Model\Good;
use App\Http\Model\Collectiongoods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class CollectiongoodsController extends Controller
{
    /**
     * 返回商品收藏页面
     * @param 参数
     * @return 返回值
     * @author 邹帅
     * @Date 2017-7-11 
    */

    public function index(Request $request)
    {   
 
        // 获取用户id
        $id = session('logins')['user_id'];
        $res1 = Collectiongoods::where ('user_id',$id)->get();

        $arr = [];
        foreach($res1 as $k=>$v){
            $arr[] =  $v['good_id'];
        }
        
        $good = Good::whereIn('good_id',$arr)->get();
        return view('home.user.collectiongoods',['data'=>$good]);
    }





        /**
     * 商品收藏
     * @author 邹帅
    */
     public function collection($id)
    {   
        $user_id = session('logins')['user_id'];

        if(empty($user_id)){
            return view('home.login.login');
        }else{
            $res = Collectiongoods::insert(['user_id' => $user_id, 'good_id' => $id,'collect_goods_time'=>time()]);
         if($res){
           $data = [
                'status'=>0,
                'msg'=>'收藏成功！'
           ];
        }else{
           $data = [
                'status'=>1,
                'msg'=>'收藏失败！'
           ];
       }
       return $data;
        }




        

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 111111;/
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
        //
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
        //
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
        $res = Collectiongoods::where('good_id', $id)->delete();
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
