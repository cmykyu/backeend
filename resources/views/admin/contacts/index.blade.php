@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <a href="contacts/create" class="btn btn-success">新增表單</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th width="90"></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($all_contacts as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->message}}</td>
                <td>
                    <a href="contacts/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>

                    {{-- 要對按鈕做onclick,才進行function刪除 --}}
                    <button class="btn btn-danger btn-sm" onclick="show_confirm({{$item->id}})">刪除</button>
                    <form id="delete-form-{{$item->id}}" action="/home/contacts/delete/{{$item->id}}" method="POST"
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
