@extends('layouts/app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .news_img_card .btn-danger {
        position: absolute;
        right: -5px;
        top: -15px;
        border-radius: 50%;
    }
</style>
@endsection


@section('content')
<div class="container">
    <h3>編輯最新消息</h3>
    <form method="POST" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
        <label for="img">現有主要圖片</label>
        <img class="img-fluid" src="{{$news->img}}" alt="" width="400">
        </div>

        <div class="form-group">
        <label for="title">重新上傳主要圖片
            (建議圖片尺寸寬400px x 高200px)
        </label>
        <input type="file" class="form-control" id="img" name="img" >
        </div>
        <hr>
        <div class="row">
            現有多張圖片組
            @foreach ($news->news_imgs as $item)
            <div class="col-2">
                <div class="news_img_card" data-newsimgid="{{$item->id}}">
                    <button type="button" class="btn btn-danger" data-newsimgid="{{$item->id}}">X</button>
                    <img class="img-fluid" src="{{$item->img_url}}" alt="">
                <input class="form-control" type="text" value="{{$item->sort}}" onchange="ajax_post_sort(this,{{$item->id}})" name="sort">
                </div>
            </div>
            @endforeach
        </div>
        <div class="form-group">
        <label for="title">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
        <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" multiple>
        </div>
        <hr>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>
        <div class="form-group">
            <label for="sort">權重(數字越大的排在越前面)</label>
            <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js">
</script>
<script>
    $(document).ready(function() {
  $('#content').summernote({minHeight:200});
});
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.news_img_card .btn-danger').click(function(){
        var newsimgid = this.getAttribute('data-newsimgid')

        $.ajax({
            url: "/home/ajax_delete_news_imgs",
            method: 'post',
            data: {
            newsimgid: newsimgid,
            },
            success: function(result){
                $(`.news_img_card[data-newsimgid=${newsimgid}]`).remove();
            }
        });
    });

    function ajax_post_sort(element,img_id){
        console.log(element);
        var img_id;
        var sort_value = element.value;
        $.ajax({
            url: "/home/ajax_post_sort",
            method: 'post',
            data: {
                 id:img_id,
                 sort:sort_value
            },
            success: function(result){


            }
        });

    }

</script>
@endsection




