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
                                <td style="font-weight: bold; background: #f6fbff;" colspan="7">{{$service->service}}</td>
                            </tr>
                        <?php $count = 0 ?>
                            @foreach($service->tasks as $task)
                                <tr>
                                    <td>{{$count = $count + 1}}</td>
                                    <td>{{$task->task}}</td>
                                    <td>{{$task->startTime}}</td>
                                    <td>{{$task->endTime}}</td>
                                    <td>{{$task->remarks}}</td>
                                    <td>{{$task->minutes}}</td>
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
    <script>
        app = new Vue({
            el: '#app',
            data: {}
        });
    </script>
@endsection