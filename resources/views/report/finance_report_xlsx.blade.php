
<table>
    <tr>
        <td colspan="8"> {{$carrier->carrier}} Turnaround Report</td>
    </tr>
    <tr>
        <td colspan="8"> Date Range : {{\Carbon\Carbon::createFromFormat('Y/m/d',$from)->format('dF')}}
            - {{\Carbon\Carbon::createFromFormat('Y/m/d',$to)->format('dF')}}</td>
    </tr>
</table>

<table class="table card-table table-vcenter text-nowrap table-bordered">
    <tr>
        <th>#</th>
        <th>Flight Number</th>
        <th>Flight Date</th>
        <th>STA</th>
        <th>STD</th>
        <th>ATA</th>
        <th>ATD</th>
        <th>Turn Around Activities</th>
    </tr>
    <?php $count = 0 ?>
    @foreach($carrier->flights as $flight)
        <?php $count = $count++ ?>
        <tr>
            <td>{{$count = $count + 1}}</td>
            <td>{{$carrier->carrier}}-{{$flight->flightNo}}</td>
            <td>{{$flight->flightDate}}</td>
            <td>{{$flight->scheduledArrival}}</td>
            <td>{{$flight->scheduledDeparture}}</td>
            <td>{{$flight->ATA}}</td>
            <td>{{$flight->ATD}}  </td>
            <td>
                {{$flight->turnaroundType}}
                @if(count($flight->incidentals)>0)
                    ,
                @endif
                @foreach($flight->incidentals->chunk(2) as $chunk)
                    @foreach($chunk as $task)
                        {{ucfirst($task->incidentalService)}}
                        @if ($loop->last)
                            <br/>
                        @else
                            ,
                        @endif
                    @endforeach
                @endforeach
            </td>


        </tr>
    @endforeach

</table>