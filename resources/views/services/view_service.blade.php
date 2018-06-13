@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.View Service
@endsection


@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Tasks</h3>
                </div>

                    <table class="table card-table table-vcenter text-nowrap">
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Timed</th>
                            <th>Milestone</th>
                            <th>Action</th>

                        </tr>

                            <tr>
                                <td style="font-weight: bold; background: #f6fbff;" colspan="5">{{$service->service}}</td>
                            </tr>
                            <?php $count = 0 ?>
                            @foreach($service->tasks as $task)
                                <tr>
                                    <td>{{$count = $count + 1}}</td>
                                    <td>{{$task->task}}</td>
                                    <td>{{$task->timed}}</td>
                                    <td>{{$task->milestone}}</td>
                                    <td>
                                        <a href="{{action('TaskController@edit',array('id'=>$task->id,'serviceId'=>$service->id))}}" class="btn btn-secondary btn-sm">Edit</a>
                                        <a href="{{action('TaskController@destroy',array('id'=>$task->id))}}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach


                    </table>


                <div class="card-footer text-right">
                    <a href="{{action('TaskController@create',array('serviceId'=>$service->id))}}" class="btn btn-primary btn-block">Add Item</a>
                </div>
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