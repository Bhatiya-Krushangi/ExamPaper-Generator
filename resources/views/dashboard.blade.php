@extends('web.layout')
@section('main')
    {{-- overview-chart --}}
    {{-- @foreach ($save_que[$loop->index] as $que)
    @foreach ($que as $val)
        {{$val}}
    @endforeach
@endforeach --}}
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h1 class="mb10">Overview</h1>
                    </div>
                </div>
            </div>
            @php
                $admin_user = Auth::user()->role == 'Admin';
            @endphp
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="overview-chart">
                                    <div class="lang">
                                        <h3 class="text-white text-center">Total language</h3>
                                        @if ($admin_user)
                                            <h1 class="text-white text-center mt-3">{{ $total_lang }}</h1>
                                        @else
                                            <h1 class="text-white text-center mt-3">{{ $act_lang }}</h1>
                                        @endif
                                        @if ($admin_user)
                                            <p class="text-white">Active : {{ $act_lang }}</p>
                                            <p class="text-white">Deactive : {{ $deact_lang }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="overview-chart">
                                    <div class="lang">
                                        <h3 class="text-white text-center">Total Topic</h3>
                                        @if ($admin_user)
                                            <h1 class="text-white text-center mt-3">{{ $all_topic }}</h1>
                                        @else
                                            <h1 class="text-white text-center mt-3">{{ $act_topic }}</h1>
                                        @endif
                                        @if ($admin_user)
                                            <p class="text-white">Active : {{ $act_topic }}</p>
                                            <p class="text-white">Deactive : {{ $deact_topic }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($admin_user)
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="overview-chart">
                                        <div class="lang">
                                            <h3 class="text-white text-center">Total User</h3>
                                            <h1 class="text-white text-center mt-3">{{ $all_user }}</h1>
                                            <p class="text-white">Active : {{ $act_user }}</p>
                                            <p class="text-white">Deactive : {{ $deact_user }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="overview-chart">
                                    <div class="lang">
                                        <h3 class="text-white text-center">Total Exam</h3>
                                        <h1 class="text-white text-center mt-3">{{ $all_exam }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($admin_user)
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h1 class="mb10">Total Exams By User</h1>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme mt-4" id="demo">
                    @foreach ($act_users as $user)
                        <div class="item">
                            <div class="overview-item overview-item--c5">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="overview-chart1">
                                            <div class="lang">
                                                <h3 class="text-white text-center">{{ $user->name }}</h3>
                                                <h1 class="text-white text-center mt-2">{{ $cnt[$loop->index] }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
            @foreach ($save_data as $value)
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h3 class="mb10">{{ $value[0]->type }}</h3>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme mt-4">
                    @foreach ($value as $val)
                    {{-- {{$val}} --}}
                        <div class="item" style="margin-bottom: 25px">
                            <div class="dash">
                                <table width="100%">
                                    <tr>
                                        <td align="right">Create_date : {{ $val->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                </table>
                                <table width="100%" style="margin-top: 10px">
                                    <tr>
                                        <td><img src="https://cdmi.in/assets/front/images/creative-logo-blue.svg"
                                                alt=""></td>
                                    </tr>
                                </table>
                                <table width="100%" style="margin-top: 10px">
                                    <tr>
                                        <td align="center"><b style="font-size: 15px">{{ $val->type }}</b></td>
                                    </tr>
                                </table>
                                @php
                                    $time = strtotime($val->date);
                                    $newformat = date('d-m-Y', $time);
                                @endphp
                                <table width="100%" style="margin-top: 10px">
                                    <tr>
                                        <td align="left"><b>Date :</b> {{ $newformat }} </td>
                                        <td align="right"><b>Total Marks : </b>{{ $val->marks }}</td>
                                    </tr>
                                </table>
                                <hr color="#666">
                                <table width="100%" style="margin-top: 15px">
                                    <tbody>
                                        {{-- {{ print_r($save_que) }} --}}
                                        @foreach ($save_que[$loop->parent->index][$loop->index] as $value)
                                            <tr>
                                                @php
                                                    $array = [$value->question];
                                                    $st = '<pre>' . implode(",\n", $array) . '</pre>';
                                                @endphp
                                                <td width="10%" valign="top" align="center"><b>{{ $loop->index + 1 . ' .' }}</b></td>
                                                @if ($value->topic == 10)
                                                    <td width="80%"><pre>{{'Solve this pattern.'}}</pre>{!! str_replace('-', '  ', $st) !!}
                                                    </td>
                                                @else
                                                    <td width="80%">{!! $st !!}</td>
                                                @endif
                                                <td width="10%" valign="top" align="center">{{ '(' . $value->marks . ')' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h5 align="center" style="margin-top: 10px"><i>All The Best</i></h5>
                                <div class="d-flex justify-content-center mt-2">
                                    <button class="btn btn-primary btn-sm"><a href="{{ route('repeat.view', $val->id) }}"
                                            style="color: white">View</a></button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('ajax')
    <script src="{{ asset('cssdemo/jquery.min.js') }}"></script>
    <script src="{{ asset('cssdemo/owl.carousel.min.js') }}"></script>
    <script>
        $('#demo').owlCarousel({
            // loop: true,
            margin: 10,
            nav: false,
            dots: true,
            // autoplay:true,
            // autoplayTimeout:2000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
        $('.owl-carousel').owlCarousel({
            // loop: true,
            margin: 10,
            nav: false,
            dots: true,
            // autoplay:true,
            // autoplayTimeout:2000,
            responsive: {
                0: {
                    items: 1
                },
                600: {

                    items: 1
                },
               
                1000: {
                    items: 1
                },
                1440: {
                    items: 2
                },
               
            }
        })
    </script>
@endsection
