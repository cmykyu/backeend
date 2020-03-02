@extends('layouts/app')
@section('content')
<div class="container">
    <form method="POST" action="/home/news/store">
        @csrf
        <div class="form-group">
            <label for="img">Img</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

          </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

        </div>
        <div class="form-group">
          <label for="content">Content</label>
          <input type="text" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>


      </form>
</div>

@endsection

