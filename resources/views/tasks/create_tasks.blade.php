@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.Create Task
@endsection




@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                                    <sl id="timed" placeholder="Timed" name="timed"
                                        :opts="[{id:0,name:'Not Timed'},{id:1,name:'Timed'}]" v-model="timed"
                                        class="{{$errors->has('timed') ? 'form-control is-invalid' : ''}}"
                                        :opts="[]"></sl>
                                    {!! $errors->first('timed', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('minimumStaff', trans('Minimum Staff Needed For Task')) !!}
                        <div class="input-group">
                    		<span class="input-group-prepend" id="minimumStaff">
                    			<span class="input-group-text"><i class="fa fa-sort-numeric-up"></i></span>
                            </span>
                            {!! Form::text('minimumStaff', null, ['class' => $errors->has('minimumStaff') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Minimum Staff Needed']) !!}
                            {!! $errors->first('minimumStaff', '<p class="invalid-feedback">:message</p>') !!}
                    	</div>
                    </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="border p-5 mt-5 mb-5 shadow-sm rounded">
                        <h5 class="text-center">SLA Settings</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('timeFrom', 'Timed From') !!}
                                    <div class="input-group">
               		<span class="input-group-prepend" id="timeFrom">
               			<span class="input-group-text"><i class="fa fa-list"></i></span>
                       </span>
                                        {!! Form::select('timeFrom',array('STD'=>'STD','STA'=>'STA','ATA'=>'ATA','ATD'=>'ATD'), null, ['class' => $errors->has('timeFrom') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Timed From']) !!}

                                        {!! $errors->first('timeFrom', '<p class="invalid-feedback">:message</p>') !!}
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('symbol', 'Symbol') !!}
                                    <div class="input-group">
		<span class="input-group-prepend" id="symbol">
			<span class="input-group-text"><i class="fa fa-asterisk"></i></span>
        </span>
                                        {!! Form::text('symbol', null, ['class' => $errors->has('symbol') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Symbol']) !!}
                                        {!! $errors->first('symbol', '<p class="invalid-feedback">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('cutOffTime', 'Cuttof Time') !!}
                                    <div class="input-group">
		<span class="input-group-prepend" id="cutOffTime">
			<span class="input-group-text"><i class="fa fa-clock"></i></span>
        </span>
                                        {!! Form::text('cutOffTime', null, ['class' => $errors->has('cutOffTime') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Cutoff Time']) !!}
                                        {!! $errors->first('cutOffTime', '<p class="invalid-feedback">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('minutesToBeDoneAppliesTo', trans('Flight Type')) !!}
                                    <div class="input-group">
                        		<span class="input-group-prepend" id="minutesToBeDoneAppliesTo">
                        			<span class="input-group-text"><i class="fa fa-list"></i></span>
                                </span>
                                        {!! Form::select('minutesToBeDoneAppliesTo',array('F'=>'Freighter','P'=>'Passenger'), null, ['class' => $errors->has('minutesToBeDoneAppliesTo') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Applies to']) !!}

                                        {!! $errors->first('minutesToBeDoneAppliesTo', '<p class="invalid-feedback">:message</p>') !!}
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('minutesToBeDone', trans('Approximate Time Action is Required To Be Done in')) !!}
                                    <div class="input-group">
                                		<span class="input-group-prepend" id="minutesToBeDone">
                                			<span class="input-group-text"><i class="fa fa-clock"></i></span>
                                        </span>
                                        {!! Form::text('minutesToBeDone', null, ['class' => $errors->has('minutesToBeDone') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Minutes To Be Done']) !!}
                                        {!! $errors->first('minutesToBeDone', '<p class="invalid-feedback">:message</p>') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="serviceId" value="{{$serviceId}}"/>
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-block">Save</button>
                </div>

            </div>


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
                timed: '{{$timed or old('timed',null)}}'
            }
        });
    </script>
@endsection
