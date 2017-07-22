<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class SearchController extends Controller
{
    //接收查询的信息
    public function search(Request $request)
    {
        $search = $request ->except('_token')['search'];

//        $type = DB::table('type')->where('type_name','like','%'.$search.'%')->get();
//        $arr = [];
//        foreach ($type as $v){
//            $arr[] = $v['type_id'];
//            $type2 = DB::table('type')->where('pid',$v['type_id'])->get();
//            foreach ($type2 as $v2){
//                $arr[] = $v2['type_id'];
//                $type3 = DB::table('type')->where('pid',$v2['type_id'])->get();
//                foreach ($type3 as $v3){
//                    $arr[] = $v3['type_id'];
//                }
//            }
//        }

        $data = DB::table('goods')->where('good_name','like','%'.$search.'%')->paginate(8);
        $goods = DB::table('goods')->where('good_name','like','%'.$search.'%')->limit(4)->get();
//        dump($data);
//        dd($goods);
        return view('home.good.goodsearch',['data'=>$data,'goods'=>$goods,'search'=>$search]);

    }
}
