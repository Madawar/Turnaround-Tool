@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}  Create Flight
@endsection



@section('heading')
    Create Flight
@endsection
@section('content')
    <div id="app">
        <div class="container">
            @if(isset($flight))
                {!! Form::model($flight, ['action' => ['FlightController@update', $flight->id], 'method' =>
                'patch'])
                !!}
            @else
                {!! Form::open(array('action' => 'FlightController@store', 'files'=>false)) !!}
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Flight</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <sl></sl>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('flightNo', 'Flight Number') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="flightNo">
			<span class="input-group-text"><i class="fa fa-flight"></i></span>
        </span>
                                    {!! Form::text('flightNo', null, ['class' => $errors->has('flightNo') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'FLight Number']) !!}
                                    {!! $errors->first('flightNo', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('arrival', 'Actual Arrival') !!}
                                <div class="input-group">
                    		<span class="input-group-prepend" id="arrival">
                    			<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </span>
                                    {!! Form::text('arrival', null, ['class' => $errors->has('arrival') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Actual Arrival']) !!}
                                    {!! $errors->first('arrival', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('departure', 'Actual Departure') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="departure">
			<span class="input-group-text"><i class="fa fa-departure"></i></span>
        </span>
                                    {!! Form::text('departure', null, ['class' => $errors->has('departure') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Actual Departure']) !!}
                                    {!! $errors->first('departure', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('STA', 'Scheduled Time Of Arrival') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="STA">
			<span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </span>
                                    <datetime input-class="form-control"  name="STA" type="datetime" v-model="sta"></datetime>

                                    {!! $errors->first('STA', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('STD', 'Scheduled Time of Departure') !!}
                                <div class="input-group">
                            		<span class="input-group-prepend" id="STD">
                            			<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </span>
                                    {!! Form::text('STD', null, ['class' => $errors->has('STD') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Scheduled Time of Departure']) !!}
                                    {!! $errors->first('STD', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
            {!! Form::close() !!}
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