<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Carousel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\OSS;
use Illuminate\Support\Facades\Input;
use Validator;


class CarouselController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //如果是通过查询方式过来的
        if($request->has('keywords')){
            $key = trim($request->input('keywords'));
            $data = Carousel::where('carousel_name','like',"%".$key."%")->paginate(5);
            return view('admin.carousel.index',['data'=>$data,'key'=>$key]);
        }
        $data =  Carousel::orderBy('id','asc')->paginate(5);
        return view('admin.carousel.index',['data'=>$data]);
    }

    //执行ajax
    public function uploadcarousel()
    {
//        将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('file_upload');
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

//            将图片上传到本地服务器
            // $path = $file->move(public_path() . '/uploads', $newName);

//            将图片上传到七牛云
//            \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

//            oss上传
            $result = OSS::upload('uploads/'.$newName, $file->getRealPath());

//        返回文件的上传路径
            $filepath = 'uploads/' . $newName;
            return $filepath;
        }
    }


    /**
     * 显示一个轮播图添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.carousel.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this ->validate($request,[
            'carousel_name' =>'required',
            'carousel_pic' =>'required',
            'carousel_url' =>'required|active_url',
        ],[
            'carousel_name.required' => '轮播图名称不能为空',
            'carousel_url.required' => '轮播图链接不能为空',
            'carousel_pic.required' => '轮播图来源不能为空',
            'carousel_url.active_url' => '轮播图链接格式不符合',
        ]);
        $input = $request -> except('_token','file_upload');
        $carousel = new Carousel();
        $carousel->carousel_name = $input['carousel_name'];
        $carousel->carousel_url = $input['carousel_url'];
        $carousel->carousel_pic = $input['carousel_pic'];
        $res = $carousel->save();//执行添加语句

        if($res){
          //  如果成功跳转到到轮播图列表页
             return redirect('admin/carousel');
        }else{
            return back()->with('error','添加失败');
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
     * 加载一个修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Carousel::where('id',$id)->first();
        return view('admin.carousel.edit',compact('data'));
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
        $data = $request->except('_token','_method');
//        dd($data);
        $res = Carousel::where('id',$id)->update($data);
        //判断是否修改成功
        if($res){
            return redirect('admin/carousel'); //成功返回到列表页
        }else{
            return back()->with('error','修改失败');//失败返回上一级操作
        }
    }

    /**
     * 删除一条数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除对应id的友情链接
        $res = Carousel::where('id',$id)->delete();
        if($res){
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }

}
