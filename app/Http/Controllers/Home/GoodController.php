<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Collectiongoods;
use App\Http\Model\Good;


use App\Http\Model\Type;

use App\Http\Model\Comment;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品列表页
     */
    public function goodList($id)
    {
        // 获取父级分类名
        $type1 = Type::where('type_id',$id)->first();
        $type_name = $type1['type_name'];

        // 查找所有pid等于type_id
        $type2 = Type::where('pid',$id)->get();

        
        // 再查找有那些商品等于子类type_id
        $arr = [];
        $arr2 = [];
        foreach($type2 as $k=>$v){
            $arr[] = $v['type_id'];
            $arr2[] = $v['type_name'];
        }

        
        $goods = Good::whereIn('type_id',$arr)->paginate(4);
        // dump($goods);
        //取出所有非下架商品 商品状态0新品 1上架 2下架
        // $goods = Good::where('good_status','!=','2')->paginate(4);
//        dd($goods);
        return view('home.good.goodlist',compact('goods','type_name'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 新品列表页
     */
    public function newgoodList()
    {
        //取出所有新品商品 商品状态0新品 1上架 2下架
        $newgoods = Good::where('good_status','=','0')->paginate(4);
//        dd($goods);
        return view('home.good.newgoodlist',compact('newgoods'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品详情页
     */
    public function goodDetail($id)
    {

        //浏览次数加1
        Good::where('good_id',$id)->increment('good_vcnt');
//        dd($a);
        //关联分类表
        $good =   Good::join('type','goods.type_id','=','type.type_id')->where('good_id',$id)->first();
//        dd($good);
        //关联评论表
        $comment = Good::join('comment','goods.good_id','=','comment.good_id')
            ->join('user_details','comment.user_id','=','user_details.user_id')
            ->where('goods.good_id',$id)
            ->paginate(10);
        return view('home.good.gooddetail',['good'=>$good,'comment'=>$comment]);
    }



     /**
     * 商品收藏
     * @author 邹帅
    */
     public function collection($id)
    {   

        $user_id = '48';
        $res = Collectiongoods::insert(['user_id' => $user_id, 'good_id' => $id]);
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
