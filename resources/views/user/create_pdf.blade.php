@php
    $i = 1;
    
@endphp
<style>
    pre {
        margin: 0px;
        font-family: "roboto", sans-serif;
        white-space: pre-wrap;
    }
</style>
<table width="100%">
    <tr>
        <td align="center"><img src="https://www.cdmi.in/assets/front/images/creative-logo-blue.svg" alt="CREATIVE" width="200px" height="60px">
        </td>
    </tr>
</table>
<table width="100%" style="margin-top: 20px">
    <tr>
        <td align="center"><b style="font-size: 20px">{{ $type }}</b></td>
    </tr>
</table>
@php
    $time = strtotime($date);
    $newformat = date('d-m-Y', $time);
@endphp
<table width="100%" style="margin-top: 10px">
    <tr>
        <td align="left"><b>Date :</b> {{ $newformat }} </td>
        <td align="right"><b>Total Marks :</b> {{ $sum }}</td>
    </tr>
</table>
<table width="100%" style="margin-top: 30px">
    <tbody>
        {{-- {{$questions}} --}}
        @foreach ($questions as $question)
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
                <td width="10%" align="center" valign="top">{{ '(' . $question->marks . ')' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<h2 align="center" style="margin-top: 20px"><i>All The Best</i></h2>
