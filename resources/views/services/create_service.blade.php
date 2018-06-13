@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.Create Service
@endsection




@section('content')
    <div id="app">
        <div class="container">
        <div class="card">
            @if(isset($service))
                {!! Form::model($service, ['action' => ['ServiceController@update', $service->id], 'method' =>
                'patch'])
                !!}
            @else
                {!! Form::open(array('action' => 'ServiceController@store', 'files'=>false)) !!}
            @endif

            <div class="card-header">
                <h3 class="card-title">Create Service</h3>
            </div>
            <div class="card-body">
                <div class='row'>
                    <div class='col-md-6'>
                        <div class="form-group">
                            {!! Form::label('service', 'Service Name') !!}
                            <div class="input-group">
		<span class="input-group-prepend" id="service">
			<span class="input-group-text"><i class="fal fa-spade"></i></span>
        </span>
                                {!! Form::text('service', null, ['class' => $errors->has('service') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Service Name']) !!}
                                {!! $errors->first('service', '<p class="invalid-feedback">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                            {!! Form::label('department', 'Deparment') !!}
                            <div class="input-group">
		<span class="input-group-prepend" id="department">
			<span class="input-group-text"><i class="fal fa-users"></i></span>
        </span>
                                <sl id="department" placeholder="Department" name="department" v-model="department"
                                    :opts="[]"></sl>
                                {!! $errors->first('department', '<p class="invalid-feedback">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class="form-group">
                            {!! Form::label('reportTo', 'Report To') !!}
                            <div class="input-group">
		<span class="input-group-prepend" id="reportTo">
			<span class="input-group-text"><i class="fal fa-users"></i></span>
        </span>
                                {!! Form::text('reportTo', null, ['class' => $errors->has('reportTo') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Report To']) !!}
                                {!! $errors->first('reportTo', '<p class="invalid-feedback">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary btn-block">Save</button>
            </div>
                <input type="hidden" name="carrierId" value="{{$carrierId}}">
            {!! Form::close() !!}
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