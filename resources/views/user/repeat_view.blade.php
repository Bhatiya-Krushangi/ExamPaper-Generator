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
            overflow-x: auto;
            white-space: pre-wrap;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>

<body>


    @php
        $i = 1;
    @endphp
    <div class="d-flex justify-content-center">
        <div class="col-md-6 box">
            <table width="100%">
                <tr>
                    <td align="center"><img src="{{ asset('image/CreativeLogo.png') }}"
                            alt="" width="200px" height="60px"></td>
                </tr>
            </table>
            <form action="{{ route('create.pdf') }}" method="POST">
                @csrf
                <table width="100%" style="margin-top: 20px">
                    <tr>
                        <td align="center"><input type="" name="type" readonly id="type"
                                placeholder="Enter Language & Type"
                                style="border: none; padding:5px; width:70%; text-align:center; font-weight:bold; background-color:white;"
                                value="{{ $res->type }}" required></td>
                    </tr>
                </table>
                <table width="100%" style="margin-top: 10px">
                    <tr>
                        <td align="left"><b>Date :</b><input type="date" onkeydown="return false" name="date"
                                id="" placeholder=""
                                style="width: 120px; margin-left:3px; border:none; box-shadow : 0 0px 5px #ccc" required
                                value="{{ $res->date }}"> </td>
                        <td align="right"><b>Total Marks :</b>{{ $res->marks }} </td><input type="hidden"
                            name="marks" id="" value="{{ $res->marks }}">

                    </tr>
                </table>
                <table width="100%" style="margin-top: 30px">
                    <tbody>
                        @foreach ($record as $question)
                            <tr>
                                @php
                                    $array = [$question->question];
                                    $st = '<pre>' . implode(",\n", $array) . '</pre>';
                                @endphp
                                <td width="5%" valign="top"><b>{{ $i++ }}{{ '. ' }}</b></td>
                                @if ($question->topic == 10)
                                    <td width="80%">{{ 'Solve this pattern.' }}{!! str_replace('-', '  ', $st) !!}</td>
                                @else
                                    <td width="80%">{!! $st !!}</td>
                                @endif
                                <td width="10%" align="center" valign="top">{{ '(' . $question->marks . ')' }}
                                </td>
                                <td><input type="hidden" name="questions[]" id=""
                                        value="{{ $question->id }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h2 align="center" style="margin-top: 20px"><i>All The Best</i></h2>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
        <a href="{{ route('edit.paper', $res->id) }}" class="btn btn-primary ml-3">Edit</a>
        <input type="submit" name="sub" id="" value="Save" class="btn btn-primary ml-3">
        <button type="submit" class="btn btn-primary ml-3">Export
            to PDF</a></button>
       
    </div>
    </form>

    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>
