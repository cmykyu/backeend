<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConTacts;
use Illuminate\Support\Facades\File;


class ContactController extends Controller
{
    public function index(){
        $all_contacts = ConTacts::all();
        return view('admin/contacts/index',compact('all_contacts'));

    }
    public function create(){
        return view('admin/contacts/create');

    }
    public function store (Request $request){

        $contacts_data = $request->all();

        ConTacts::create($contacts_data);

        return redirect('/home/contacts');
    }
    public function edit ($id){

        $contacts = ConTacts::find($id);
        return view('admin/contacts/edit',compact('contacts'));
    }
    public function update (Request $request,$id){

        $request_data = $request->all();
        $item = ConTacts::find($id);
        $item->update($request_data);
        return redirect('/home/contacts');
    }
    public function delete (Request $request,$id){
        $item = ConTacts::find($id);
        $item->delete();
        return redirect('/home/contacts');
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
