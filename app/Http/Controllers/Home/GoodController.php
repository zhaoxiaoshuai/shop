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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品列表页
     */
    public function goodList(Request $request,$id)
    {
        $perpage = 8;
       if($request->has('salecnt')){
        $salecnt = $request->only('salecnt');
        $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($salecnt['salecnt'],'desc')->paginate($perpage);
        return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id]);
    }

        if($request->has('price')){
            $price = $request->only('price');
            $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($price ['price'],'desc')->paginate($perpage);
            return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id]);
        }

        //取出所有 非下架商品   商品状态0新品 1上架 2下架
        $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->paginate($perpage);
//        dd($goods);

        return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 新品列表页
     */
    public function newgoodList(Request $request,$id)
    {
        $perpage = 8;
        if($request->has('salecnt')){
            $salecnt = $request->only('salecnt');
            $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($salecnt['salecnt'],'desc')->paginate($perpage);
            return view('home.good.newgoodlist',['newgoods'=>$newgoods,'type_id'=>$id]);
        }

        if($request->has('price')){
            $price = $request->only('price');
            $newgoods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($price ['price'],'desc')->paginate($perpage);
            return view('home.good.newgoodlist',['newgoods'=>$goods,'type_id'=>$id]);
        }
        //取出所有新品商品 商品状态0新品 1上架 2下架
        $newgoods = Good::where('good_status','=','0')->where('type_id','=',$id)->paginate(4);
//        dd($goods);
        return view('home.good.newgoodlist',['newgoods'=>$newgoods,'type_id'=>$id]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品按销量排序
     */
//    public function saleList()
//    {
//        //取出所有商品 商品状态0新品 1上架 2下架
//        $goods = Good::where('good_status','!=','2')->orderBy('good_salecnt')->paginate(4);
////        dd($goods);
////        return view('home.good.newgoodlist',compact('goods'));
//        return $goods;
//    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品详情页
     */
    public function goodDetail($id)
    {

        //浏览次数加1
        Good::where('good_id',$id)->increment('good_vcnt');
        //关联分类表
        $good =   Good::join('type','goods.type_id','=','type.type_id')->where('good_id',$id)->first();
//        dd($good);
        //关联评论表
        $comment = Good::join('comment','goods.good_id','=','comment.good_id')
            ->join('user_details','comment.user_id','=','user_details.user_id')
            ->where('goods.good_id',$id)
            ->paginate(10);
        // return view('home.good.gooddetail',['good'=>$good,'comment'=>$comment]);
        $pics = Good::find($id)->pics()->get();
        $type = Type::where('type_id',$good['type_id'])->first();
           $x= self::getparent($type);
           array_unshift($x,$type);
           $y = array_reverse($x);
           $arr = [];
           foreach ($y as $k=>$v){
               $arr[]=$v['type_name'];
           }
           $line = implode($arr,'  >  ');
//         dd($line);

//        dd($types);
        return view('home.good.gooddetail',compact('good','pics','line','comment'));
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
    
     public  function getparent($type)
    {
        //获取全部分类
        $types = Type::get();
//        dd($types);
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
