@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}| View Flight
@endsection



@section('heading')
    View Flight
@endsection
@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Flight Report</h3>
                </div>
                <div id="chart_div"></div>
                <table class="table card-table table-vcenter text-nowrap">
                    <tr>
                        <th>#</th>
                        <th>Checklist</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Remarks</th>
                        <th>Time Taken (Mins)</th>
                        <th>Milestone Reached</th>
                    </tr>
                    @foreach($services as $service)
                        <tr>
                            <td style="font-weight: bold; background: #f6fbff;" colspan="8">{{$service->service}}</td>
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
                                <td> </td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endforeach

                </table>


            </div>
        </div>
    </div>
@endsection


@section('jquery')
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['gantt']});
        google.charts.setOnLoadCallback(drawChart);

        function toMilliseconds(minutes) {
            return minutes * 60 * 1000;
        }

        function drawChart() {

            var otherData = new google.visualization.DataTable();
            otherData.addColumn('string', 'Task ID');
            otherData.addColumn('string', 'Task Name');
            otherData.addColumn('string', 'Resource');
            otherData.addColumn('date', 'Start');
            otherData.addColumn('date', 'End');
            otherData.addColumn('number', 'Duration');
            otherData.addColumn('number', 'Percent Complete');
            otherData.addColumn('string', 'Dependencies');

            otherData.addRows([
                <?php $rows = 1 ?>
                ['ATA', 'Flight Arrival {{$flight->flightNo}}','Flight Arrival {{$flight->flightNo}}', new Date('{{$flight->arrival}}'), new Date('{{$flight->startTime}}'), null, 100, null],
                    @foreach($services as $service)
                    @foreach($service->tasks as $task)
                    @if($task->modStartTime !="")
                    <?php $rows = $rows +1?>
                    ['{{$task->id}}', '{{$task->task}}','{{$task->task}}', new Date('{{$task->modStartTime}}'), new Date('{{$task->modEndTime}}'), null, 100, 'ATA'],
                  @endif
                    @endforeach
                    @endforeach
            ]);

            var options = {
                height: {{$rows * 65}},
                gantt: {
                    defaultStartDateMillis: new Date(2015, 3, 28)
                }
            };

            var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

            chart.draw(otherData, options);
        }
    </script>
@endsection