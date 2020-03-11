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
    <h3>編輯表單</h3>
    <form method="POST" action="/home/contacts/update/{{$contacts->id}}" enctype="multipart/form-data">
        @csrf
        <hr>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$contacts->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" min="0" class="form-control" id="email" name="email" value="{{$contacts->email}}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" min="0" class="form-control" id="phone" name="phone" value="{{$contacts->phone}}">
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="message" cols="30" rows="10">{{$contacts->message}}</textarea>
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




