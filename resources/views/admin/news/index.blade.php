@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <a href="news/create"class="btn btn-success">新增最新消息</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>img</th>
                <th>title</th>
                <th>content</th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_news as $item)
            <tr>
                <td>
                    <img src="{{$item->img}}" alt="" width="400">
                </td>
                <td>{{$item->title}}</td>
                <td>{{$item->content}}</td>
                <td>
                    <a href="news/edit/{{$item->id}}"class="btn btn-success btn-sm">修改</a>
                    <button class="btn btn-danger btn-sm">刪除</button>
                </td>
            </tr>
            @endforeach


        </tbody>

    </table>


</div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
@endsection
