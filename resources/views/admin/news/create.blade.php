@extends('layouts/app')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">


@section('content')
<div class="container">
    <h3>建立新頁面</h3>
                                                  {{-- 設定表 單的MIME編碼 --}}
    <form method="POST" action="/home/news/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="img">主要圖片</label>
        <input type="file" class="form-control" id="img" aria-describedby="emailHelp" name="img" >
        </div>

        <div class="form-group">
        <label for="news_imgs">多張圖片上傳</label>
        <input type="file" class="form-control" id="news_imgs" aria-describedby="emailHelp" name="news_imgs[]" multiple>
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
        <textarea type="text" class="form-control" id="content" name="content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
  $('#content').summernote({minHeight:200});
});
</script>

@endsection


