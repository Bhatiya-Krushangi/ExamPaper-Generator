@extends('web.layout')
@section('main')
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
    <div class="section__content section__content--p30">
        @if (Auth::user()->role == 'Admin')
            <div class="container-fluid">
                <div class="d-flex">
                    <div class="col-lg-8">
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="search" id="srch" class="form-control">
                                        <option value="">Select User </option>
                                        @foreach ($all_user as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $id == $user->id && $id != Auth::user()->id ? 'selected' : '' }}>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="m-t-30">
                @if (!empty($data))
                    @foreach ($data as $get_data)
                        <div class="col-md-8 box">
                            <table width="100%">
                                <tr>
                                    <td align="right">Create_date : {{ $get_data->created_at->format('d-m-Y') }}</td>
                                </tr>
                            </table>
                            <table width="100%" style="margin-top: 20px">
                                <tr>
                                    <td align="center"><img src="{{ asset('image/CreativeLogo.png') }}"
                                            alt="" width="200px" height="60px"></td>
                                </tr>
                            </table>
                            <table width="100%" style="margin-top: 20px">
                                <tr>
                                    <td align="center"><b style="font-size: 20px">{{ $get_data->type }}</b></td>
                                </tr>
                            </table>
                            @php
                                $time = strtotime($get_data->date);
                                $newformat = date('d-m-Y', $time);
                            @endphp
                            <table width="100%" style="margin-top: 10px">
                                <tr>
                                    <td align="left"><b>Date :</b> {{ $newformat }} </td>
                                    <td align="right"><b>Total Marks : </b>{{ $get_data->marks }}</td>
                                </tr>
                            </table>
                            <hr color="black">
                            <table width="100%" style="margin-top: 30px">
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($save_data[$loop->index] as $value)
                                        {{-- {{$value}} --}}
                                        <tr>
                                            @php
                                                $array = [$value->question];
                                                $st = '<pre>' . implode(",\n", $array) . '</pre>';
                                            @endphp
                                            <td width="10%" valign="top" align="center"><b>{{ $i++ . ' .' }}</b></td>
                                            @if ($value->topic == 10)
                                                <td width="80%"><pre>{{ 'Solve this pattern.' }}</pre>{!! str_replace('-', '  ', $st) !!}</td>
                                            @else
                                                <td width="80%">{!! $st !!}</td>
                                            @endif
                                            <td width="10%" valign="top" align="center">{{ '(' . $value->marks . ')' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 align="center" style="margin-top: 20px"><i>All The Best</i></h4>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-primary"><a href="{{ route('repeat.view', $get_data->id) }}"
                                        style="color: white">View</a></button>
                            </div>
                        </div>
                    @endforeach
            </div>
        @else
            <div class="d-flex justify-content-center">
                <h3 style="color: black">no</h3>
            </div>
            @endif
        </div>
    </div>
@endsection
@section('ajax')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#srch', function() {
                var id = $(this).val();
                var url = "{{ route('recent.paper', '') }}" + "/" + id;
                location.href = url;
                // console.log(url);
            });
        });
    </script>
@endsection
