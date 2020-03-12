@extends('layouts/app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .products_img_card .btn-danger {
        position: absolute;
        right: -5px;
        top: -15px;
        border-radius: 50%;
    }
</style>
@endsection


@section('content')
<div class="container">
    <h3>編輯產品</h3>
    <form method="POST" action="/home/products/update/{{$products->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
        <label for="img">現有主要圖片</label>
        <img class="img-fluid" src="{{$products->img}}" alt="" width="400">
        </div>

        <div class="form-group">
        <label for="title">重新上傳主要圖片
            (建議圖片尺寸寬400px x 高200px)
        </label>
        <input type="file" class="form-control" id="img" name="img" >
        </div>
        <hr>
        {{-- <div class="row">
            現有多張圖片組
            @foreach ($products->products_imgs as $item)
            <div class="col-2">
                <div class="products_img_card" data-productsimgid="{{$item->id}}">
                    <button type="button" class="btn btn-danger" data-productsimgid="{{$item->id}}">X</button>
                    <img class="img-fluid" src="{{$item->img_url}}" alt="">
                <input class="form-control" type="text" value="{{$item->sort}}" onchange="ajax_post_sort(this,{{$item->id}})" name="sort">
                </div>
            </div>
            @endforeach
        </div> --}}
        <div class="form-group">
        <label for="title">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
        <input type="file" class="form-control" id="products_imgs" name="products_imgs[]" multiple>
        </div>
        <hr>
        <div class="form-group">

            <label for="exampleFormControlSelect1">type</label>

            <select class="form-control" name="type" >
            @foreach ($productTypes as $item)

            <option value="{{$item->type}}"
                @if($item->id === $products->id)

                selected @endif>{{ $item->type}}</option>
            @endforeach

            </select>

            {{-- <select class="form-control" name="type_id" id="type_id">
                @foreach ($productTypes as $productType)
                <option value="{{ $productType->id }}"
                    @if($item->type_id === $productType->id)
                    selected @endif>{{ $productType->type_name }}</option>
                @endforeach
            </select> --}}
        </div>
        <div class="form-group">
            <label for="sort">權重(數字越大的排在越前面)</label>
            <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$products->sort}}">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$products->content}}</textarea>
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

    $('.products_img_card .btn-danger').click(function(){
        var productsimgid = this.getAttribute('data-productsimgid')

        $.ajax({
            url: "/home/ajax_delete_products_imgs",
            method: 'post',
            data: {
            productsimgid: productsimgid,
            },
            success: function(result){
                $(`.products_img_card[data-productsimgid=${productsimgid}]`).remove();
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




