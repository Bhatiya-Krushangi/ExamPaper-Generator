@extends('web.layout')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="mb10">Language</h1>
            <a href="{{ route('add.lang') }}">
                <button type="button" class="btn btn-success">
                    Add Language
                </button>
            </a>
            @php
                $admin_user = Auth::user()->role == 'Admin';
            @endphp
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="  table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Language</th>
                                    @if ($admin_user)
                                        <th>Created By</th>
                                        <th>Created At</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @if ($admin_user)
                                    @foreach ($all_lang as $data)
                                    
                                    <tr>
                                            <td @if($data->status == 1)  style="color: red;" @endif>{{ $data->language }}</td>
                                            <td @if($data->status == 1)  style="color: red;" @endif>{{ $data->connect ? $data->connect->name : '' }}</td>
                                            <td @if($data->status == 1)  style="color: red;" @endif>{{ $data->created_at }}</td>
                                            <td>
                                                @if ($data->status == 0)
                                                    <a href="{{ route('edit.lang', $data->id) }}"><button type="button"
                                                            class="btn btn-success">Edit</button></a>
                                                    <a href="{{ route('delete.lang', $data->id) }}"><button type="button"
                                                            class="btn btn-danger del">Delete</button></a>
                                                @else
                                                    <a href="{{ route('act.lang', $data->id) }}"
                                                        class="btn btn-primary">Active</a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($lang as $data)
                                        <tr>
                                            <td>{{ $data->language }}</td>
                                            <td>
                                                <a href="{{ route('edit.lang', $data->id) }}"><button type="button"
                                                        class="btn btn-success">Edit</button></a>
                                                <a href="{{ route('delete.lang', $data->id) }}"><button type="button"
                                                        class="btn btn-danger">Delete</button></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
@endsection

