<?php

namespace App\Http\Controllers;

use App\News;
use App\NewsImgs;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(){
        $all_news = News::all();
        return view('admin/news/index', compact('all_news'));

    }

    public function create(){
        return view('admin/news/create');

    }

    public function store (Request $request){
        $news_data = $request->all();
        //可先dd
        // dd($news_data);

        // //上傳檔案
        // $file_name = $request->file('img')->store('','public');
        // $news_data['img'] = $file_name;

        //上傳主要圖片
        if($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file,'news');
            $news_data['img'] = $path;

        }

        $new_news = News::create($news_data);

            //多張圖片上傳

            if($request->hasFile('news_imgs')){

            $files = $request->file('news_imgs');

            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file,'news');

                //新增資料進DB

                $news_imgs = new NewsImgs;
                $news_imgs->news_id = $new_news->id;
                $news_imgs->img_url = $path;
                $news_imgs->save();

                }
            }



            //ID位置要一致
            // News::create ($news_data);
            return redirect('/home/news');
    }

    public function edit ($id){

        // $news = News::where('id','=',$id)->first();
        $news = News::with("news_imgs")->find($id);
        return view('admin/news/edit',compact('news'));
    }

    public function update (Request $request,$id){

        $request_data = $request->all();
        $item = News::find($id);

        //假如上傳新圖片
        if($request->hasFile('img')){

            //舊圖片就要刪除
            $old_image = $item->img;
            File::delete(public_path().$old_image);

            //再上傳新圖片
            $file = $request->file('img');
            $path = $this->fileUpload($file,'news');
            $request_data['img'] = $path;
        }
        $item->update($request_data);
        return redirect('/home/news');
    }

    public function delete (Request $request,$id){

        $item = News::find($id);

        $old_image = $item->img;

        //下判斷式
        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_img);

        }

        $item->delete();
        return redirect('/home/news');
    }

    private function fileUpload($file,$dir){
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if( ! is_dir('upload/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if ( ! is_dir('upload/'.$dir)) {
            mkdir('upload/'.$dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time().md5(rand(100, 200))).'.'.$extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/'.$dir.'/'.$filename;
    }
    public function ajax_delete_news_imgs(Request $request)
    {
        $newsimgid = $request->newsimgid;

        $item = NewsImgs::find($newsimgid);
        $old_image = $item->img;

        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }

        $item->delete();


        return "delete success";
    }
}
