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
                @foreach($flight->tasks->chunk(2) as $chunk)
                    @foreach($chunk as $task)
                        {{$task->task->task}}
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