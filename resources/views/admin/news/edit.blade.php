@extends('layouts/app')



@section('content')
<div class="container">
    <h3>編輯頁面</h3>
    <form method="POST" action="/home/news/update/{{$news->id}}">
        @csrf
        <div class="form-group">
        <label for="img">img</label>
        <input type="text" class="form-control" id="img" name="img" value="{{$news->img}}">
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


