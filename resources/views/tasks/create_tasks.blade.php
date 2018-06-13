@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.Create Task
@endsection




@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                @if(isset($task))
                    {!! Form::model($task, ['action' => ['TaskController@update', $task->id], 'method' =>
                    'patch'])
                    !!}
                @else
                    {!! Form::open(array('action' => 'TaskController@store', 'files'=>false)) !!}
                @endif

                <div class="card-header">
                    <h3 class="card-title">Create Tasks</h3>
                </div>
                <div class="card-body">
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('task', 'Task') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="task">
			<span class="input-group-text"><i class="fal fa-forklift"></i></span>
        </span>
                                    {!! Form::text('task', null, ['class' => $errors->has('task') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Task']) !!}
                                    {!! $errors->first('task', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('timed', 'Timed') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="timed">
			<span class="input-group-text"><i class="fal fa-clock"></i></span>
        </span>
                                    <sl id="timed" placeholder="Timed" name="timed" :opts="[{id:0,name:'Not Timed'},{id:1,name:'Timed'}]" v-model="timed" :opts="[]"></sl>
                                    {!! $errors->first('timed', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class='row'>


                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-block">Save</button>
                </div>
                    <input type="hidden" name="serviceId" value="{{$serviceId}}"/>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection


@section('jquery')
    <script>
        app = new Vue({
            el: '#app',
            data: {
                timed:'{{$timed or null}}'
            }
        });
    </script>
@endsection