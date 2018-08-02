@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!} | Capture Flight Data
@endsection




@section('content')
    <div class="container">
        @if(isset($flight))
            {!! Form::model($flight, ['action' => ['FlightUpdateController@update', $flight->id], 'method' =>
            'patch'])
            !!}
        @else
            {!! Form::open(array('action' => 'FlightUpdateController@store', 'files'=>false)) !!}
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manual Flight Details</h3>
            </div>

            <div id="app">


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
                                <input type="hidden" name="data[{{$loop->index}}][serviceId]"
                                       value="{{$service->id}}"/>
                                <input type="hidden" name="data[{{$loop->index}}][taskId]" value="{{$task->id}}"/>
                                <input type="hidden" name="data[{{$loop->index}}][flightId]" value="{{$flight->id}}"/>
                                <tr>
                                    <td>{{$count = $count + 1}}</td>
                                    <td>{{$task->task}}</td>
                                    <td>
                                        <input type="text" name="data[{{$loop->index}}][startTime]"
                                               value="{{$task->startTime}}"/>
                                    </td>
                                    <td>
                                        <input type="text" name="data[{{$loop->index}}][endTime]"
                                               value="{{$task->endTime}}"/>
                                    </td>
                                    <td>
                                        <input type="text" name="data[{{$loop->index}}][remarks]"
                                               value="{{$task->remarks}}"/>
                                    </td>
                                    <td>{{$task->minutes}} </td>
                                    <td></td>

                                </tr>
                            @endforeach
                        @endif
                    @endforeach

                </table>


            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>

        </div>
        {!! Form::close() !!}
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