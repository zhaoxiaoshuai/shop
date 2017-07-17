<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Collectiongoods;
use App\Http\Model\Good;

use App\Http\Model\Goodpic;
use App\Http\Model\Type;
use Illuminate\Http\Request;

use App\Http\Model\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class GoodController extends Controller
{
    /**
     * 商品列表
     * @param  Request $request 商品分类id
     * @return 前台商品列表页面
     * @author gcj
     * @Date
     */
    public function goodList(Request $request,$id)
    {
        $perpage = 8;
        //取出销量前四的商品
        $good = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy('good_salecnt','desc')->limit(4)->get();
       //判断是否传递销量参数
        if($request->has('salecnt')){
        $salecnt = $request->only('salecnt');
        $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($salecnt['salecnt'],'desc')->paginate($perpage);
        return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id,'good'=>$good]);
    }
        //判断是否传递价格参数
        if($request->has('price')){
            $price = $request->only('price');
            $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($price ['price'],'desc')->paginate($perpage);
            return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id,'good'=>$good]);
        }
        //取出所有 非下架商品并分页   商品状态0新品 1上架 2下架
        $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->paginate($perpage);
        return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id,'good'=>$good]);
    }

    /**
     * 新品列表
     * @param  Request $request 商品分类id
     * @return 前台新品列表页面
     * @author gcj
     * @Date
     */
    public function newgoodList(Request $request,$id)
    {
        $perpage = 8;
        //取出销量前四的商品
        $good = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy('good_salecnt','desc')->limit(4)->get();
        //如果有销量参数
        if($request->has('salecnt')){
            $salecnt = $request->only('salecnt');
            $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($salecnt['salecnt'],'desc')->paginate($perpage);
            return view('home.good.newgoodlist',['newgoods'=>$newgoods,'type_id'=>$id,'good'=>$good]);
        }
        //如果有价格参数
        if($request->has('price')){
            $price = $request->only('price');
            $newgoods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($price ['price'],'desc')->paginate($perpage);
            return view('home.good.newgoodlist',['newgoods'=>$goods,'type_id'=>$id,'good'=>$good]);
        }
        //取出所有新品商品 商品状态0新品 1上架 2下架
        $newgoods = Good::where('good_status','=','0')->where('type_id','=',$id)->paginate(4);
//        dd($goods);
        return view('home.good.newgoodlist',['newgoods'=>$newgoods,'type_id'=>$id,'good'=>$good]);
    }



    /**
     * 商品详情页面
     * @param  Request $request 商品id
     * @return 前台商品详情页面
     * @author gcj
     * @Date
     */
    public function goodDetail($id)
    {

        //浏览次数加1
        Good::where('good_id',$id)->increment('good_vcnt');
        //关联分类表
        $good =   Good::join('type','goods.type_id','=','type.type_id')->where('good_id',$id)->first();
        //关联评论表
        $comment = Good::join('comment','goods.good_id','=','comment.good_id')
            ->join('user_details','comment.user_id','=','user_details.user_id')
            ->where('goods.good_id',$id)
            ->paginate(10);
        // return view('home.good.gooddetail',['good'=>$good,'comment'=>$comment]);
        //取出该商品所有的图片
        $pics = Good::find($id)->pics()->get();
        //取出该当前子分类
        $type = Type::where('type_id',$good['type_id'])->first();

           $x= self::getparent($type);
           array_unshift($x,$type);
           $y = array_reverse($x);
           $arr = [];
           foreach ($y as $k=>$v){
               $arr[]=$v['type_name'];
           }
           $line = implode($arr,'  >  ');

        return view('home.good.gooddetail',compact('good','pics','line','comment'));
    }

    /**
     * 商品收藏页面
     * @param  商品id
     * @return $data
     * @author gcj
     * @Date
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

    /**
     * 获取父类方法
     * @param 子类$type
     * @return $data
     * @author gcj
     * @Date
     */
     public  function getparent($type)
    {
        //获取全部分类
        $types = Type::get();
            static $arr=[];
            foreach($types as $k => $v){
                if($type['pid'] == $v['type_id']){
                    $arr[] = $types[$k];
                    if($v['pid'] != '0'){
                        $this -> getparent($v);
                    }
                }
            }
        return $arr;
    }
}
