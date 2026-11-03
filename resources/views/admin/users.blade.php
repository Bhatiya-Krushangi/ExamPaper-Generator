@extends('web.layout')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="mb10">Users</h1>
            <a href="{{ route('register') }}">
                <button type="button" class="btn btn-success">
                    Add User
                </button>
            </a>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $data)
                                    <tr>
                                        <td @if($data->status == 1)  style="color: red;" @endif>{{ $data->name }}</td>
                                        <td @if($data->status == 1)  style="color: red;" @endif>{{ $data->role }}</td>
                                        <td>
                                            @if ($data->status == 0)
                                                <a href="{{ route('edit.user', $data->id) }}"><button type="button"
                                                        class="btn btn-success">Edit</button></a>
                                                <a href="{{ route('delete.user', $data->id) }}"><button type="button"
                                                        class="btn btn-danger">Delete</button></a>
                                            @else
                                                <a href="{{ route('act.user', $data->id) }}"><button type="button"
                                                        class="btn btn-primary">Active</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
@endsection
