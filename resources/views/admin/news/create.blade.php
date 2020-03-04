@extends('layouts/app')



@section('content')
<div class="container">
    <h3>建立新頁面</h3>
                                                  {{-- 設定表 單的MIME編碼 --}}
    <form method="POST" action="/home/news/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="img">img</label>
        <input type="file" class="form-control" id="img" aria-describedby="emailHelp" name="img" >
        </div>

        <div class="form-group">
        <label for="title">title</label>
        <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
        <label for="sort">sort</label>
        <input type="number" class="form-control" id="sort" name="sort">
        </div>

        <div class="form-group">
        <label class="content" for="exampleCheck1">content</label>
        <input type="text" class="form-control" id="content" name="content">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection


