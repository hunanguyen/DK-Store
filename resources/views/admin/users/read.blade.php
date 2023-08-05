@extends("admin.layout")
@section("do-du-lieu-tu-view")
    <div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ url('backend/users/create') }}" class="btn btn-primary">Create</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td style="text-align:center;">
                        <a href="{{ url('backend/users/update/'.$row->id) }}">Edit</a>&nbsp;
                        <a href="{{ url('backend/users/delete/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            {{ $data->render() }}
        </div>
    </div>
</div>
@endsection