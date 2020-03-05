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

        // //上傳檔案
        // $file_name = $request->file('img')->store('','public');
        // $news_data['img'] = $file_name;

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
        News::create ($news_data);
        return redirect('/home/news');
    }

    public function edit ($id){

        $news = News::where('id','=',$id)->first();
        return view('admin/news/edit',compact('news'));
    }

    public function update (Request $request,$id){
        News::find($id)->update($request->all());
        return redirect('/home/news');

    }
    public function delete (Request $request,$id){
        News::find($id)->delete();
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
}
