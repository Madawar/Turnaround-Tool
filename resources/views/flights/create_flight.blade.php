@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.Create Flight
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
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('carrier', 'Carrier') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="carrier">
			<span class="input-group-text"><i class="fal fa-helicopter"></i></span>
        </span>
                                    <sl id="carrier" name="carrier" placeholder="Carrier" v-model="carrier"
                                        url="{{action('Api\FlightController@flightList')}}"></sl>
                                    {!! $errors->first('carrier', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('flightNo', 'Flight Number') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="flightNo">
			<span class="input-group-text"><i class="fal fa-helicopter"></i></span>
        </span>
                                    {!! Form::text('flightNo', null, ['class' => $errors->has('flightNo') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Flight Number']) !!}
                                    {!! $errors->first('flightNo', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('flightDate', 'Flight Date') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="flightDate">
			<span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </span>
                                    <date name="flightDate" v-model="flightDate" class="form-control"
                                          placeholder="Flight Date"></date>
                                    {!! $errors->first('flightDate', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('aircraftRegistration', 'Aircraft Registration') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="aircraftRegistration">
			<span class="input-group-text"><i class="fa fa-flight"></i></span>
        </span>
                                    {!! Form::text('aircraftRegistration', null, ['class' => $errors->has('aircraftRegistration') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Aircraft Registration']) !!}
                                    {!! $errors->first('aircraftRegistration', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('STD', 'Scheduled Time Of Departure') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="STD">
			<span class="input-group-text"><i class="fal fa-clock"></i></span>
        </span>
                                    <datetime v-model="STD"
                                              name="STD"
                                              type="datetime"
                                              input-format="YYYY/MM/DD HH:mm"
                                              input-class="form-control"
                                              placeholder="Scheduled Time Of Departure"
                                    ></datetime>
                                    {!! $errors->first('STD', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('STA', 'Scheduled Time Of Arrival') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="STA">
			<span class="input-group-text"><i class="fal fa-clock"></i></span>
        </span>
                                    <datetime v-model="STA"
                                              name="STA"
                                              type="datetime"
                                              input-format="YYYY/MM/DD HH:mm"
                                              input-class="form-control"
                                              placeholder="Scheduled Time Of Arrival"
                                    ></datetime>
                                    {!! $errors->first('STA', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('departure', 'Actual Departure') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="departure">
			<span class="input-group-text"><i class="fal fa-clock"></i></span>
        </span>
                                    <datetime v-model="departure"
                                              name="departure"
                                              type="datetime"
                                              input-format="YYYY/MM/DD HH:mm"
                                              input-class="form-control"
                                              placeholder="Departure"
                                    ></datetime>
                                    {!! $errors->first('departure', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('arrival', 'Actual Arrival') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="arrival">
			<span class="input-group-text"><i class="fal fa-clock"></i></span>
        </span>
                                    <datetime name="arrival" v-model="arrival"
                                              type="datetime"
                                              input-format="YYYY/MM/DD HH:mm"
                                              input-class="form-control"
                                              placeholder="Arrival"
                                    ></datetime>
                                    {!! $errors->first('arrival', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('orig', 'Flight Origin') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="orig">
			<span class="input-group-text"><i class="fa fa-flight"></i></span>
        </span>
                                    {!! Form::text('orig', null, ['class' => $errors->has('orig') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Flight Origin']) !!}
                                    {!! $errors->first('orig', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('dest', 'Flight Destination') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="dest">
			<span class="input-group-text"><i class="fa fa-flight"></i></span>
        </span>
                                    {!! Form::text('dest', null, ['class' => $errors->has('dest') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Flight Destination']) !!}
                                    {!! $errors->first('dest', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('flightType', 'Flight Type') !!}
                                <div class="input-group">
                    		<span class="input-group-prepend" id="flightType">
                    			<span class="input-group-text"><i class="fa fa-flight"></i></span>
                            </span>
                                    <sl id="flightType" placeholder="Flight Type" name="flightType"
                                        v-model="flightType"
                                        :opts="[{id:'P',name:'Passenger'},{id:'F',name:'Freighter'}]"></sl>
                                    {!! $errors->first('flightType', '<p class="invalid-feedback">:message</p>') !!}
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('aircraftType', 'Aircraft Model') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="aircraftType">
			<span class="input-group-text"><i class="fa fa-flight"></i></span>
        </span>
                                    {!! Form::text('aircraftType', null, ['class' => $errors->has('aircraftType') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Aircraft Type e.g 747']) !!}
                                    {!! $errors->first('aircraftType', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('delayCode', 'Delay Code') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="delayCode">
			<span class="input-group-text"><i class="fal fa-closed-captioning"></i></span>
        </span>
                                    <sl id="delayCode" placeholder="Delay COde" name="delayCode"
                                        v-model="delayCode"
                                        url="{{action('Api\DelayCodeController@index')}}"></sl>
                                    {!! $errors->first('delayCode', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('turnaroundType', 'Turnaround Type') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="turnaroundType">
			<span class="input-group-text"><i class="fa fa-flight"></i></span>
        </span>
                                    <sl id="turnaroundType" placeholder="Turnaround Type" name="turnaroundType"
                                        v-model="turnaroundType"
                                        :opts="[{id:'Freighter Turnaround',name:'Freighter Turnaround'},{id:'Passenger Turnaround',name:'Passenger Turnaround'},{id:'Freight Transit',name:'Freight Transit'},{id:'Passenger Transit',name:'Passenger Transit'}]"></sl>

                                    {!! $errors->first('turnaroundType', '<p class="invalid-feedback">:message</p>') !!}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('loaded', 'Aircraft Loaded By') !!}
                                <div class="input-group">
                    		<span class="input-group-prepend" id="loaded">
                    			<span class="input-group-text"><i class="fa fa-user"></i></span>
                            </span>
                                    {!! Form::text('loaded', null, ['class' => $errors->has('loaded') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Aircraft Loaded By']) !!}
                                    {!! $errors->first('loaded', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('remarks','Remarks') !!}
                                <div class="input-group">
                            		<span class="input-group-prepend" id="remarks">
                            			<span class="input-group-text"><i class="fa fa-comment"></i></span>
                                    </span>
                                    {!! Form::text('remarks', null, ['class' => $errors->has('remarks') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Flight Remarks']) !!}
                                    {!! $errors->first('remarks', '<p class="invalid-feedback">:message</p>') !!}
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
    <style>
        .vdatetime {
            width: 90% !important;
        }
    </style>
    <script>
        app = new Vue({
            el: '#app',
            data: {
                task: '',
                carrier: '{{$carrier or null}}',
                flightDate: '{{$flightDate or null}}',
                arrival: '{{$arrival or null}}',
                departure: '{{$departure or null}}',
                STA: '{{$STA or null}}',
                STD: '{{$STD or null}}',
                completed: '{{$completed or null}}',
                opt: [{id: 0, name: 'Incomplete'}, {id: 1, name: 'Completed'}]


            }
        });
    </script>
@endsection