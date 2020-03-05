@extends('layouts/nav')

{{-- @section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection --}}

@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7" style="padding:100px">
<div class="container">
    <div class="media-container-row">
        {{$news}}

        @foreach ($news->news_imgs as $news_img)
        {{-- {{$news_img->img_url}} --}}
        <img src="{{asset('/storage/'.$news->img)}}" alt="" width="250">
        @endforeach

    </div>



</div>

@endsection


