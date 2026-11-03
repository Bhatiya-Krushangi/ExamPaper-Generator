@extends('web.layout')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="mb10">Questions</h1>
            <a href="{{ route('add.que') }}">
                <button type="button" class="btn btn-success">
                    Add Question
                </button>
            </a>
            @php
                $admin_user = Auth::user()->role == 'Admin';
            @endphp
            <div class="container-fluid mt-5">
                <div class="d-flex">
                    <div class="col-lg-8">
                        <form action="">
                            <div class="row" style="row-gap:24px">
                                <div class="col-md-4">
                                    <select name="search" id="srch" class="form-control">
                                        <option value="" selected disabled>Select Language</option>
                                        @foreach ($lang as $data)
                                            <option value="{{ $data->id }}" id="">{{ $data->language }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="search1" id="top" class="form-control">
                                        <option value="" selected disabled>Select Topic</option>
                                        {{-- @foreach ($topic as $data)
                                            <option value="{{ $data->id }}" id="">{{ $data->topic }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    {{-- <th>Language</th> --}}
                                    {{-- <th>Topic</th> --}}
                                    <th>Question</th>
                                    <th>Marks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="questions">

                                {{-- @foreach ($que as $data)
                                    <tr>
                                        <td>{{ $data->connect ? $data->connect->language : '' }}</td> 
                                         <td>{{ $data->connect1 ? $data->connect1->topic : ''}}</td>
                                        <td>{{ $data->question }}</td>
                                        <td>
                                            <a href=""><button type="button"
                                                    class="btn btn-success">Edit</button></a>
                                            <a href=""><button type="button"
                                                    class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade demo" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:9999">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" id="update_data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">

                                        <input type="hidden" name="id" value="" id="id">
                                        <div class="col-md-6">
                                            <label for="category_name" class="control-label mb-1">Language
                                                Name</label>
                                            <select name="language" id="lang" class="form-control" selected disabled>
                                                <option value="" selected disabled>Select Language</option>
                                                @foreach ($lang as $data)
                                                    <option value="{{ $data->id }}">{{ $data->language }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('language')
                                                <p style="color: #007bff">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_name" class="control-label mb-1">Topic
                                                Name</label>
                                            <select id="topic" name="topic" class="form-control" selected disabled>
                                                <option value="" selected disabled>Select Topic</option>
                                                {{-- @foreach ($data as $top) --}}
                                                <option value="" id=""></option>
                                                {{-- @endforeach --}}
                                            </select>
                                            @error('topic')
                                                <p style="color: #007bff">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="category_slug" class="control-label mb-1">Question</label>
                                            {{-- <input id="que" value="" name="question" type="text"
                                                class="form-control" aria-required="true" aria-invalid="false"> --}}
                                                <textarea name="question" id="que" class="form-control" cols="10" rows="5"></textarea>
                                            @error('question')
                                                <p style="color: #007bff">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="category_slug" class="control-label mb-1">Marks</label>
                                            <input id="marks" value="" name="marks" type="text"
                                                class="form-control" aria-required="true" aria-invalid="false">
                                            @error('question')
                                                <p style="color: #007bff">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('ajax')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        // let name;
        $(document).ready(function() {

            function view() {
                $.ajax({
                    url: "{{ route('show.que') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        var html = '';
                        @if ($admin_user)
                            $.each(response.all_data, function(index, value) {
                                store = value.question;
                                if (value.topic == 10) {
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        "-", "&nbsp;&nbsp;").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                else{
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                html += '<tr class="' + (value.status == 1 ? "active1" : '') +
                                    '"><td>' + store +
                                    '</td><td>' + value.marks +
                                    '</td><td>' + (value.status == 0 ?
                                        '<button class="btn btn-success mr-1 edit" data-eid=' +
                                        value.id +
                                        '>Edit</button><button class="btn btn-danger del" data-did=' +
                                        value.id +
                                        '>Delete</button>' :
                                        '<button class="btn btn-primary mr-1 act" data-aid=' +
                                        value.id +
                                        '>Active</button>') + '</td></tr><tr class="' + (value
                                        .status == 1 ? "active1" : '') + '"><td>Created By : ' +
                                    value.connect2.name +
                                    '</td><td>' + value.created_at +
                                    '</td><td></td></tr>';
                            });
                        @else
                            $.each(response.data, function(index, value) {
                                // console.log(value);
                                store = value.question;
                                if (value.topic == 10) {
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        "-", "&nbsp;&nbsp;").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                else{
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                html += '<tr><td>' + store +
                                    '</td><td>' + value.marks +
                                    '</td><td><button class="btn btn-success mr-1 edit" data-eid=' +
                                    value.id +
                                    '>Edit</button><button class="btn btn-danger del" data-did=' +
                                    value.id +
                                    '>Delete</button></td></tr>';
                            });
                        @endif
                        $('#questions').html(html);
                    }
                });
            }
            view();
            $('#srch').on('change', function() {
                var srch = $('#srch').val();
                $.ajax({
                    url: "{{ route('srch.que') }}",
                    type: "POST",
                    data: {
                        'srch': srch,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        console.log(response);
                        var html = '';
                        @if ($admin_user)
                            $.each(response.all_data, function(index, value) {
                                store = value.question;
                                if (value.topic == 10) {
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        "-", "&nbsp;&nbsp;").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                else{
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                html += '<tr class="' + (value.status == 1 ? "active1" :
                                        '') + '"><td>' + store +
                                    '</td><td>' + value.marks +
                                    '</td><td>' + (value.status == 0 ?
                                        '<button class="btn btn-success mr-1 edit" data-eid=' +
                                        value.id +
                                        '>Edit</button><button class="btn btn-danger del" data-did=' +
                                        value.id +
                                        '>Delete</button>' :
                                        '<button class="btn btn-primary mr-1 act" data-aid=' +
                                        value.id +
                                        '>Active</button>') + '</td></tr><tr class="' +
                                    (value.status == 1 ? "active1" : '') +
                                    '"><td>Created By : ' +
                                    value.connect2.name +
                                    '</td><td>' + value.created_at +
                                    '</td><td></td></tr>';
                            });
                        @else
                            $.each(response.data, function(index, value) {
                                store = value.question;
                                if (value.topic == 10) {
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        "-", "&nbsp;&nbsp;").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                else{
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                html += '<tr><td>' + store +
                                    '</td><td>' + value.marks +
                                    '</td><td><button class="btn btn-success mr-1 edit" data-eid=' +
                                    value.id +
                                    '>Edit</button><button class="btn btn-danger del" data-did=' +
                                    value.id +
                                    '>Delete</button></td></tr>';
                            });
                        @endif
                        $('#questions').html(html);

                        var html1 = '';
                        html1 = "<option value='' selected disabled>" + 'Select Topic' +
                            "</option>";
                        $.each(response.topic, function(index, value) {
                            html1 += ('<option value="' + value
                                .id + '">' + value.topic +
                                '</option>');
                        });
                        $("#top").html(html1);
                    }
                });
            });
            $('#top').on('change', function() {
                var srch = $('#srch').val();
                var top = $('#top').val();
                // console.log(srch);
                $.ajax({
                    url: "{{ route('srch1.que') }}",
                    type: "POST",
                    data: {
                        'srch': srch,
                        'top': top,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        console.log(response);
                        var html = '';
                        var store = '';
                        @if ($admin_user)
                            $.each(response.all_data, function(index, value) {
                                store = value.question;
                                if (value.topic == 10) {
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        "-", "&nbsp;&nbsp;").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                else{
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                html += '<tr class="' + (value.status == 1 ? "active1" :
                                        '') + '"><td>' + store + '</td><td>' + value
                                    .marks +
                                    '</td><td>' + (value.status == 0 ?
                                        '<button class="btn btn-success mr-1 edit" data-eid=' +
                                        value.id +
                                        '>Edit</button><button class="btn btn-danger del" data-did=' +
                                        value.id +
                                        '>Delete</button>' :
                                        '<button class="btn btn-primary mr-1 act" data-aid=' +
                                        value.id +
                                        '>Active</button>') + '</td></tr><tr class="' +
                                    (value.status == 1 ? "active1" : '') +
                                    '"><td>Created By : ' +
                                    value.connect2.name +
                                    '</td><td>' + value.created_at +
                                    '</td><td></td></tr>';
                            });
                        @else
                            $.each(response.data, function(index, value) {
                                store = value.question;
                                if (value.topic == 10) {
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        "-", "&nbsp;&nbsp;").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                else{
                                    store = store.replaceAll("\n", "<br>").replaceAll(
                                        " ", "&nbsp;&nbsp;");
                                }
                                html += '<tr><td>' + store +
                                    '</td><td>' + value.marks +
                                    '</td><td><button class="btn btn-success mr-1 edit" data-eid=' +
                                    value.id +
                                    '>Edit</button><button class="btn btn-danger del" data-did=' +
                                    value.id +
                                    '>Delete</button></td></tr>';
                            });
                        @endif
                        $('#questions').html(html);
                    }
                });
            });
            $(document).on('click', '.del', function() {
                var id = $(this).data('did');
                // alert(id);
                $.ajax({
                    url: "{{ route('delete.que') }}",
                    type: "POST",
                    data: {
                        'id': id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        view();
                        // console.log(response);
                    }
                });
            });
            $(document).on('click', '.act', function() {
                var id = $(this).data('aid');
                $.ajax({
                    url: "{{ route('act.que') }}",
                    type: "POST",
                    data: {
                        'id': id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        view();
                    }
                });
            });
            $(document).on('click', '.edit', function() {
                var id = $(this).data('eid');
                $.ajax({
                    url: "{{ route('edit.que') }}",
                    type: "POST",
                    data: {
                        'id': id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // console.log(response.connect1.topic);
                        $('#id').val(response.id);
                        $('#lang').val(response.language);
                        $('#marks').val(response.marks);
                        var html = '';
                        $.each(response, function(index, value) {
                            html = ('<option value="' + value.id + '">' + value.topic +
                                '</option>');
                        });
                        $("#topic").html(html);
                        $('#que').val(response.question);
                        $('#exampleModalCenter').modal('show');

                    }
                });

            });
            $(document).on('click', '#update', function() {
                // alert();
                var formdata = new FormData($('#update_data')[0]);
                $.ajax({
                    url: "{{ route('update.que') }}",
                    type: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#exampleModalCenter').modal('hide');
                        view();

                        // console.log(response);
                    }
                });
            });

        });
    </script>
@endsection
