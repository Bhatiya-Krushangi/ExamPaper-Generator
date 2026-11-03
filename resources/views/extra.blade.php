<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @php
        $i = 1;
        
    @endphp

    <table width="100%">
        <tr>
            <td align="center"><img src="https://cdmi.in/assets/front/images/creative-logo-blue.svg" alt=""
                    width="200px" height="60px"></td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 20px">
        <tr>
            <td align="center"><b style="font-size: 20px">{{ $type }}</b></td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 10px">
        <tr>
            <td align="left"><b>Date :</b> {{ $date }} </td>
            <td align="right"><b>Total Marks :</b> {{ $sum }}</td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 30px">
        <tbody>
            {{-- {{$questions}} --}}
            @foreach ($questions as $question)
                <tr>
                    <td width="5%"><b>{{ $i++ }}{{ '. ' }}</b></td>
                    <td width="80%">{{ $question->question }}</td>
                    <td width="10%">{{ '(' . $question->marks . ')' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2 align="center" style="margin-top: 20px"><i>All The Best</i></h2>

</body>

</html>
