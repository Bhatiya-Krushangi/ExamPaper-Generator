<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('cssdemo/newstyle.css') }}">
    <style>
        pre{
            margin: 0px;
            font-family: "roboto",sans-serif;
        }
    </style>
</head>

<body>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Exam & Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <b>Exam Subject</b>
                            <table style="margin-top: 15px">
                                <tbody id="show_lang">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <b>Exam Type</b>
                            <table style="margin-top: 15px">
                                <tbody id="show_type">

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="chng">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @php
        $i = 1;
    @endphp
    <div class="d-flex justify-content-center">
        <div class="col-md-6 box">
            <table width="100%">
                <tr>
                    <td align="center"><img src="https://cdmi.in/assets/front/images/creative-logo-blue.svg"
                            alt="" width="200px" height="60px"></td>
                </tr>
            </table>
            <form action="{{ route('create.pdf') }}" method="POST">
                @csrf
                <table width="100%" style="margin-top: 20px">
                    <tr>
                        <td align="center"><input name="type" required id="type"
                                placeholder="Enter Language & Type"
                                style="border: none; box-shadow : 0 0px 5px #ccc; text-align:center; padding:5px; width: 200px"
                                value="{{ isset($type) ? $type : '' }}"></td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td align="left"><b>Date :</b><input type="date" onkeydown="return false" name="date"
                                id="" placeholder=""
                                style="width: 120px; margin-left:3px; border:none; box-shadow : 0 0px 5px #ccc" required
                                value="{{ isset($date) ? $date : '' }}"> </td>
                        <td align="right"><b>Total Marks :</b>{{ $sum }} </td><input type="hidden"
                            name="marks" id="" value="{{ $sum }}">

                    </tr>
                </table>
                <table width="100%" style="margin-top: 30px">
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                @php
                                    $array = [$question->question];
                                    $st =  '<pre>' . implode(",\n", $array) . '</pre>';
                                @endphp
                                <td width="5%" valign="top"><b>{{ $i++ }}{{ '. ' }}</b></td>
                                @if ($question->topic == 10)
                                    <td width="80%">{{ 'Solve this pattern.' }}{!! str_replace('-', '  ', $st) !!}</td>
                                @else
                                    <td width="80%">{!! $st !!}</td>
                                @endif
                                <td width="10%" align="center" valign="top">{{ '(' . $question->marks . ')' }}</td>
                                <td><input type="hidden" name="questions[]" id=""
                                        value="{{ $question->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h3 align="center" style="margin-top: 20px"><i>All The Best</i></h3>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <a href="{{ route('dashboard') }}" class="btn btn-primary ">Back</a>
        {{-- <a href="{{ url()->previous() }}" class="btn btn-primary ml-3">Edit</a> --}}
        <a class="btn btn-primary ml-3 text-white" onclick="goBack()">Edit</a>
        <input type="submit" name="sub" id="" value="Save" class="btn btn-primary ml-3">
        <button type="submit" class="btn btn-primary ml-3"><a>Export
                to PDF</a></button>

    </div>
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        let checkIds1 = [];
        let type_id;
        $(document).ready(function() {
            $(document).on('click', '#type', function() {
                // $('#exampleModalCenter').modal('show');
                $.ajax({
                    url: "{{ route('get.type') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // console.log(response);
                        var html = '';
                        $.each(response.lang, function(index, value) {
                            html +=
                                '<tr><td width="20%"><input type="checkbox" class="cdmiCheckbox1" data-id=' +
                                value.id + '></td><td width="80%">' + value.language +
                                '</td><tr>';
                        });
                        $('#show_lang').html(html);
                        var html1 = '';
                        $.each(response.type, function(index, value) {
                            html1 +=
                                '<tr><td width="20%"><input type="radio" class="cdmiCheckbox2" name="type" data-id=' +
                                value.id + '></td><td width="80%">' + value.type +
                                '</td><tr>';
                        });
                        $('#show_type').html(html1);
                        $('#exampleModalCenter').modal('show');
                    }
                });
            });
            $(document).on('click', '.cdmiCheckbox2', function() {
                type_id = $(this).data('id');
                // console.log(type_id);
            });
            $(document).on('click', '.cdmiCheckbox1', function() {
                // alert();
                var id = $(this).data('id');
                var check = $(this).prop('checked')
                if (check) {
                    checkIds1.push(id)
                } else {
                    checkIds1 = checkIds1.filter((i) => i != id);
                }
                // console.log(checkIds1);
            });
            $(document).on('click', '#chng', function() {
                // alert();
                $.ajax({
                    url: "{{ route('chng.type') }}",
                    type: "POST",
                    data: {
                        'id': checkIds1,
                        'type_id': type_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        var html = '';
                        $.each(response.data, function(index, value) {
                            html += ' ' + value.language + ' &';
                        });
                        html = html.slice(0, -1);
                        var html1 = response.type.type;
                        $('#type').val(html + ' : ' + html1);
                        $('#exampleModalCenter').modal('hide');
                    }
                });
            });
        });

        function goBack() {
            window.history.back();
        }


    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
