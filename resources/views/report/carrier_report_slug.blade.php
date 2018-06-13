<h1 class="text-center">{{$carrier->carrier}} Turnaround Report</h1>
<h2 class="text-center">Date Range : {{\Carbon\Carbon::createFromFormat('Y/m/d',$from)->format('dF')}}
    - {{\Carbon\Carbon::createFromFormat('Y/m/d',$to)->format('dF')}}</h2>
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
        <th>Flight Delay</th>
        <th>GHA Delay</th>
        <th>Time Recovered</th>

        <th>Delay Code</th>
        <th>Remarks</th>
    </tr>
    <?php
    $count = 0;
    $airline_delay = 0;
    $time_delay = 0;
    $time_recovered = 0;
    ?>

    @foreach($carrier->flights as $flight)
        <?php $count = $count++;
        $airline_delay = $airline_delay + $flight->airlineDelay;
        $time_delay = $flight->timeDelay + $time_delay;
        $time_recovered = $flight->timeRecovered + $time_recovered;
        ?>
        <tr>
            <td>{{$count = $count + 1}}</td>
            <td>{{$carrier->carrier}}-{{$flight->flightNo}}</td>
            <td>{{$flight->flightDate}}</td>
            <td>{{$flight->scheduledArrival}}</td>
            <td>{{$flight->scheduledDeparture}}</td>
            <td>{{$flight->ATA}}</td>
            @if($flight->delay == "delayed")
                <td style="background: lightpink;">{{$flight->ATD}} </td>
            @elseif($flight->delay == "early")
                <td style="background: lightgreen;">{{$flight->ATD}} </td>
            @else
                <td>{{$flight->ATD}}  </td>
            @endif
            <td>{{$flight->airlineDelay}}</td>
            <td>{{$flight->timeDelay}}</td>
            <td>{{$flight->timeRecovered}}</td>

            <td></td>
            <td></td>


        </tr>

    @endforeach
    <tr>
        <td colspan="7"></td>
        <td>{{$airline_delay}} Minutes</td>
        <td>{{$time_delay}} Minutes</td>
        <td>{{$time_recovered}} Minutes</td>
    </tr>

</table>