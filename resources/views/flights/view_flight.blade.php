@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.View Flight
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
                <div id='png'></div>
                <hr/>
                <h1 class="text-center">{{$flight->cx->carrier}} {{$flight->flightNo}} Turnaround Report</h1>
                <h2 class="text-center">{{$flight->flightDate}}</h2>
                <h5 class="text-center">
                    <div v-if="download == 0"><i class="fa fa-spinner fa-spin"></i> Generating Report</div>
                    <div v-if="download === 1">
                    <a :href="url"  ><a :href="url"><i class="fa fa-download"></i> Download Report</a></a>
                    </div>
                </h5>
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
                    @foreach($flight->services as $service)
                        @if(count($service->tasks) >0)
                            <tr>
                                <td style="font-weight: bold; background: #f6fbff;"
                                    colspan="8">{{$service->service}}</td>
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


            </div>
        </div>
    </div>
@endsection


@section('jquery')
    <script type="text/javascript">

        app = new Vue({
            el: '#app',
            mounted() {
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
                        ['ATA', 'Flight Arrival {{$flight->flightNo}}', 'Flight Arrival {{$flight->flightNo}}', new Date('{{$flight->arr}}'), new Date('{{$flight->startTime}}'), null, 100, null],
                            @foreach($flight->services as $service)
                            @foreach($service->tasks as $task)
                            @if($task->modStartTime !="")
                            <?php $rows = $rows + 1?>
                        ['{{$task->id}}', '{{$task->task}}', '{{$task->task}}', new Date('{{$task->modStartTime}}'), new Date('{{$task->modEndTime}}'), null, 100, 'ATA'],
                        @endif
                        @endforeach
                        @endforeach
                    ]);

                    var options = {
                        height: {{$rows * 45}},
                        gantt: {
                            defaultStartDateMillis: new Date(2015, 3, 28)
                        }
                    };

                    var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

                    chart.draw(otherData, options);
                    document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '">Printable version</a>';
                }

                var vm = this;
                axios.get("/api/flt/report/{{$flight->id}}")
                    .then(function (response) {
                        vm.download = 1;
                        vm.url = response.data.file;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            data: {
                download: 0,
                url: ''
            }
        });


    </script>
@endsection