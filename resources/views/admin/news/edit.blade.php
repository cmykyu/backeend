@extends('layouts/app')



@section('content')
<div class="container">
    <h3>編輯頁面</h3>
    <form method="POST" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
        <label for="img">現有圖片</label>
        <img src="{{asset('/storage/'.$news->img)}}" alt="" width="400">
        </div>

        <div class="form-group">
        <label for="title">重新上傳檔案</label>
        <input type="file" class="form-control" id="img" aria-describedby="emailHelp" name="img" >
        </div>

        <div class="form-group">
        <label for="title">title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>

        <div class="form-group">
        <label class="content" for="exampleCheck1">content</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

@endsection


