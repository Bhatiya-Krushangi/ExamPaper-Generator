@extends('web.layout')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h1 class="mb10">Questions</h1>
            @php
                $admin_user = Auth::user()->role == 'Admin';
            @endphp
            <div class="container-fluid mt-5">
                <div class="row" style="row-gap:20px">
                    <div class="col-sm-8">
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
                    <div class="col-sm-4">
                        <div class="bhatiya">
                            <p>Total Questions :
                                <span id="show_que" class="ml-2">{{ isset($cnt) ? $cnt : 0 }}</span>
                            </p>
                        </div>
                        <div class="bhatiya1">
                            <p>Total Marks :
                                <span id="show_marks" class="ml-2">{{ isset($marks) ? $marks : 0 }}</span>
                            </p>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <p>Total Marks :
                            <p id="show_marks" class="ml-2"></p>
                            </p>
                        </div>
                    </div> --}}
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

                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                    <div class="view d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" id="final">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('ajax')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        let checkIds = []
        let cnt;
        let id = "{{ @$id }}";
       

        $(document).ready(function() {

            function view() {
                $.ajax({
                    url: "{{ route('show.que') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id,
                    },
                    success: function(response) {
                        var html = '';
                        // console.log(response.que);
                        if (id) {
                            checkIds = response.que;
                        }
                        console.log("Edit Time Que ======= ",checkIds);
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
                            var ch = '';
                            // console.log("checkId  ===>   ",checkIds);
                            //console.log("value,id  ===>   ",value.id);
                            if (checkIds.includes(""+value.id)) {
                                //console.log("======><======");
                                ch = 'checked';
                            }
                                return html +=
                                    `<tr><td class="cdmi" width="70%">${store}</td><td width="15%">${value.marks}</td><td width="15%"><label class='checkLabel' for='krushi${value.id}'></label><input type="checkbox"  class="cdmiCheckbox" id="krushi${value.id}" data-id='${value.id}' ${ch}></td></tr>@if ($admin_user) <tr><td width="50%">created By : ${value.connect2.name}</td><td width="50%">${value.created_at}</td><td></td></tr> @endif`;

                        });
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
                        'id': id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // console.log(response);
                        var html = '';
                        // if (id) {
                        //     checkIds = response.que;
                        // }
                        console.log("srch lang-------------",checkIds);
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
                                var ch = '';
                            if (checkIds.includes(""+value.id)) {
                                        ch = 'checked';
                            }
                                return html +=
                                    `<tr><td class="cdmi" width="70%">${store}</td><td width="15%">${value.marks}</td><td width="15%"><label class='checkLabel' for='krushi${value.id}'></label><input type="checkbox" class="cdmiCheckbox" id="krushi${value.id}" data-id='${value.id}' ${ch}></td></tr>@if ($admin_user) <tr><td width="50%">created By : ${value.connect2.name}</td><td width="50%">${value.created_at}</td><td></td></tr> @endif`;
                            
                        });
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
                        'id': id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // console.log("que===================",response.que);
                        var html = '';
                        // if (id) {
                        //     checkIds = response.que;
                        // }
                        // console.log("srch topic************************",checkIds);
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
                                var ch = '';
                            if (checkIds.includes(""+value.id)) {
                                ch = 'checked';
                            }
                                return html +=
                                    `<tr><td class="cdmi" width="70%">${store}</td><td width="15%">${value.marks}</td><td width="15%"><label class='checkLabel' for='krushi${value.id}'></label><input type="checkbox" class="cdmiCheckbox" id="krushi${value.id}" data-id='${value.id}' ${ch}></td></tr>@if ($admin_user) <tr><td width="50%">created By : ${value.connect2.name}</td><td width="50%">${value.created_at}</td><td></td></tr> @endif`;
                            
                        });
                        $('#questions').html(html);
                    }
                });
            });

            $(document).on('click', '.cdmiCheckbox', function() {
                // alert(); 
                var ids = $(this).data('id');
                var check = $(this).prop('checked')

                 console.log(ids, check);
                // console.log(cnt);
                // console.log("------------------------ pre --> " + checkIds);
                if (check) {
                    checkIds.push(ids)
                } else {
                    checkIds = checkIds.filter((i) => i != ids);
                }
                // console.log("------------------------ post --> " + checkIds);
                cnt = checkIds.length;
                $('#show_que').html(cnt);
                $.ajax({
                    url: "{{ route('get.marks') }}",
                    type: "POST",
                    data: {
                        'user': id,
                        'id': checkIds,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        console.log('....' + response);
                        $('#show_marks').html(response);
                    }
                });

                
            });
            $(document).on('click', '#final', function() {
                // console.log(checkIds);
                $.ajax({
                    url: "{{ route('get.que') }}",
                    type: "POST",
                    data: {
                        'user': id,
                        'id': checkIds,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        console.log(response);
                        // // var url = "{{ route('final.que') }}"
                        if (response == 1) {
                            window.location.href = "{{ route('final.que') }}";
                        } else {
                            alert('Select Questions');
                        }
                    }
                });
            });


        });
    </script>
@endsection
