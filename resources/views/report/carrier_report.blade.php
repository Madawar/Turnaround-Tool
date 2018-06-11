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

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            background-color: lightblue;
            height: 50px;
        }
    </style>
</head>
<body>

<h1 class="text-center">{{$flight->cx->carrier}} Report</h1>
<h2 class="text-center">Date Range : {{$from}} - {{$to}}</h2>
<hr/>
<table class="table card-table table-vcenter text-nowrap ">
    <tr>

        <td>
            <div class="info">
                Scheduled Time of Arrival : <b>{{$flight->STA}}</b> <br/>
                Scheduled Time of Departure : <b>{{$flight->STD}}</b>
            </div>
        </td>
        <td class="text-align:right;">
            Actual Time of Arrival : <b>{{$flight->arrival}}</b> <br/>
            Actual Time of Departure : <b>{{$flight->departure}}</b>
        </td>
        <td>
            <div class="info">
                Delay Code : <b></b> <br/>
                Turnaround Time : <b></b>
            </div>
        </td>

    </tr>
</table>
<hr/>


<table class="table card-table table-vcenter text-nowrap table-bordered">
    <tr>
        <th>#</th>
        <th>Flight Number</th>
        <th>Flight Date</th>
        <th>STA</th>
        <th>STD</th>
        <th>ATA</th>
        <th>ATD</th>
        <th>Result</th>
        <th>Delay Code</th>
        <th>Remarks</th>
    </tr>
    @foreach($flight->services as $service)
        @if(count($service->tasks) >0)
            <tr>
                <td style="font-weight: bold; background: #f6fbff;"
                    colspan="7">{{$service->service}}</td>
            </tr>
            <?php $count = 0 ?>
            @foreach($service->tasks as $task)
                <tr>
                    <td>{{$count = $count + 1}}</td>
                    <td>{{$task->task}}</td>
                    <td>{{$task->startTime}}</td>
                    <td>{{$task->endTime}}</td>
                    <td>{{$task->remarks}}</td>
                    <td>{{$task->minutes}} </td>
                    <td></td>

                </tr>
            @endforeach
        @endif
    @endforeach

</table>
</body>
</html>

