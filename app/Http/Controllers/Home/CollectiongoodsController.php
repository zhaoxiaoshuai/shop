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




    public function Coll($gid)
    {   
        $user_id = session('logins')['user_id'];
        //判断是否登录
        if(!$user_id){
            return 4;
        }
        //点击前判断是否存在
        $coll = Collectiongoods::where('good_id',$gid) -> where('user_id',$user_id ) -> first();

        //判断
        if($coll){
            return 3;
        }
        //获取商品
        $goods = Good::where('good_id',$gid) -> first();
        //保存收藏表
        $res = Collectiongoods::insert(['good_id'=>$gid,'user_id'=>$user_id]);
        //判断
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
    *取消收藏
    */
    public function Delcoll($gid)
    {
        //获取商品
        $goods = Good::where('good_id',$gid) -> first();
        //删除收藏表数据
        // $res = Collectiongoods::where('good_id',$gid) -> where('user_id',$user_id) -> delete();
        $res = Collectiongoods::where('good_id', $gid)->delete();
        //判断
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}




    

    

    

