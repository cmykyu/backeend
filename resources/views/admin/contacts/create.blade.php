@extends('layouts/app')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">


@section('content')
<div class="container">
    <h3>建立表單</h3>
                                                  {{-- 設定表 單的MIME編碼 --}}
    <form method="POST" action="/home/contacts/store" enctype="multipart/form-data">
        @csrf
        <hr>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" min="0" class="form-control" id="email" name="email" >
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" min="0" class="form-control" id="phone" name="phone" >
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{asset('js/summernote-zh-TW.js')}}"></script>
{{-- 變更成中文 --}}

<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 150,
            lang: 'zh-TW',
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete : function(target) {
                    $.delete(target[0].getAttribute("src"));
                }
            },
        });


        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/home/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#content').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function (file_link) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/home/ajax_delete_img',
                data: {file_link:file_link},
                success: function (img) {
                    console.log("delete:",img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
   });
</script>

@endsection


