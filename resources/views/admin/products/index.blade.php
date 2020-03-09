@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <a href="products/create" class="btn btn-success">新增產品</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>img</th>
                <th>title</th>
                <th>content</th>
                <th>sort</th>
                <th width="90"></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($all_products as $item)
            <tr>
                <td>
                    <img src="{{$item->img}}" alt="" width="400">
                </td>
                <td>{{$item->title}}</td>
                <td>{!!$item->content!!}</td>
                <td>{{$item->sort}}</td>
                <td>
                    <a href="products/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                    <button class="btn btn-danger btn-sm" onclick="show_confirm({{$item->id}})">刪除</button>
                    <form id="delete-form-{{$item->id}}" action="/home/products/delete/{{$item->id}}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>


<script>

    $(document).ready(function() {
    $('#example').DataTable();
    } );

    // js confirm box
    function show_confirm(id)
    {
        var r=confirm("你確定要刪除嗎")
        if (r==true)

        {
        //ID要一致
        document.getElementById('delete-form-'+id).submit();
        }

    }
</script>

@endsection
