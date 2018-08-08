<table>
    <tr>
        <td colspan="5"> {{$flight->cx->carrier}} {{$flight->flightNo}} Turnaround Report</td>
    </tr>
    <tr>
        <td colspan="5"> {{\Carbon\Carbon::createFromFormat('Y-m-d',$flight->flightDate)->format('dFY')}}</td>
    </tr>
</table>

<table class="table card-table table-vcenter text-nowrap table-bordered">
    <tr>
        <th>#</th>
        <th>Checklist</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Remarks</th>
    </tr>
    @foreach($flight->services as $service)
        @if(count($service->tasks) >0)
            <tr>
                <td style="font-weight: bold; background: #f6fbff;"
                    colspan="5">{{$service->service}}</td>
            </tr>
            <?php $count = 0 ?>
            @foreach($service->tasks as $task)
                <tr>
                    <td>{{$count = $count + 1}}</td>
                    <td>{{$task->task}}</td>
                    <td>{{$task->startTime}}</td>
                    <td>{{$task->endTime}}</td>
                    <td>{{$task->remarks}}</td>
                </tr>
            @endforeach
        @endif
    @endforeach

</table>

