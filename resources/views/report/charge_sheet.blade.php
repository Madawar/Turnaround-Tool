<html>
<head>
    <link rel="stylesheet" href="{{url('css/bundle.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{url('css/dashboard.css')}}" type="text/css" media="all"/>
    <style>
        body {
            background: #fff !important;

        }

        table {
            border-collapse: collapse !important;
        }

        img {
            position: fixed;
            top: -40px;
            left: 0px;
            right: 0px;
        }
    </style>
</head>
<body>

<img width="200px" src="{{url('/logo.jpg')}}">


<h1 class="text-center">Aircraft Turnaround Charge Sheet</h1>
<h2 class="text-center ">Date : <span class="">{{\Carbon\Carbon::createFromFormat('Y-m-d',$flight->flightDate)->format('dFY')}}</span></h2>
<hr/>
<table class="table card-table table-vcenter text-nowrap table-bordered">

    <tbody>
    <tr>
        <td colspan="4" style="font-weight: bold; background: #f6fbff;">Flight Details</td>
    </tr>
    <tr>
        <td>
            Flight Number : <u><b class="">{{$flight->cx->carrier}} {{$flight->flightNo}}</b></u>

        </td>
        <td>
            Origin : <u><b>{{$flight->orig}}</b></u>
        </td>
        <td>
            STA : <u><b>{{$flight->STA}}</b></u>

        </td>
        <td>
            ATA : <u><b>{{$flight->arrival}}</b></u>
        </td>
    </tr>
    <tr>
        <td>
            Aircraft Type / Config : <u><b class="">{{$flight->aircraftType}}</b></u>

        </td>
        <td>
            DEST : <u><b>{{$flight->dest}}</b></u>
        </td>
        <td>
            STD : <u><b>{{$flight->STD}}</b></u>

        </td>
        <td>
            ATD : <u class="text-right"><b>{{$flight->departure}}</b></u>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            Aircraft Registration: <u><b>{{$flight->aircraftRegistration}}</b></u>

        </td>
        <td colspan="2">
            Parking Stand ARR : <u><b></b></u>
        </td>

    </tr>
    </tbody>

</table>
<br/>
<table class="table card-table table-vcenter text-nowrap table-bordered">

    <tbody>
    <tr>
        <td style="font-weight: bold; background: #f6fbff;">Services Provided</td>
    </tr>
    <tr style="height: 300px;">
        <td class="" style="width: 300px; height: 100px; vertical-align: top; text-align: center;font-weight: bold;">
            1.) {{$flight->turnaroundType}}

        </td>
    </tr>
    <tr>
        <td style="font-weight: bold; background: #f6fbff;">Incidental Services Provided</td>
    </tr>
    <tr>
        <td class="" style="width: 300px; height: 100px; vertical-align: top; text-align: center;font-weight: bold;">

None
        </td>


    </tr>
    </tbody>

</table>
<br/>
<table class="table card-table table-vcenter text-nowrap table-bordered">

    <tbody>
    <tr>
        <td colspan="2" style="font-weight: bold; background: #f6fbff;">Airline</td>
    </tr>
    <tr style="height: 300px;">
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            Airline Representative

        </td>
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            Signature
        </td>

    </tr>
    <tr>
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            Staff ID Number

        </td>
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            Position
        </td>

    </tr>
    <tr>
        <td colspan="2" style="font-weight: bold; background: #f6fbff;">GHA</td>
    </tr>
    <tr>
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            AFS Representative

        </td>
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            Signature
        </td>

    </tr>
    <tr>
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            Staff ID Number

        </td>
        <td style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
            Position
        </td>

    </tr>
    </tbody>
</table>
<br/>
<table class="table card-table table-vcenter text-nowrap table-bordered">

    <tbody>
    <tr>
        <td style="font-weight: bold; background: #f6fbff;">Comments</td>
    </tr>
    <tr style="height: 300px;">
        <td style="width: 300px; height: 100px; vertical-align: top; text-align: left;font-weight: bold;">
            {{$flight->remarks}}

        </td>

    </tr>

    </tr>
    </tbody>
</table>
</body>
</html>

