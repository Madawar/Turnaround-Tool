@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!} . Create Carrier
@endsection



@section('heading')
    Create Carrier
@endsection
@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                @if(isset($carrier))
                    {!! Form::model($carrier, ['action' => ['CarrierController@update', $carrier->id], 'method' =>
                    'patch'])
                    !!}
                @else
                    {!! Form::open(array('action' => 'CarrierController@store', 'files'=>false)) !!}
                @endif

                <div class="card-header">
                    <h3 class="card-title">Create Carriers</h3>
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
                                    {!! Form::text('carrier', null, ['class' => $errors->has('carrier') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Carrier']) !!}
                                    {!! $errors->first('carrier', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('freighterTurnaroundTime', 'Freighter Average Turnaround Time') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="freighterTurnaroundTime">
			<span class="input-group-text"><i class="fal fa-clock"></i></span>
        </span>
                                    {!! Form::text('freighterTurnaroundTime', null, ['class' => $errors->has('freighterTurnaroundTime') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Freighter Average Turnaround Time']) !!}
                                    {!! $errors->first('freighterTurnaroundTime', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('passengerTurnaroundTime', 'clock') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="passengerTurnaroundTime">
			<span class="input-group-text"><i class="fal fa-clock"></i></span>
        </span>
                                    {!! Form::text('passengerTurnaroundTime', null, ['class' => $errors->has('passengerTurnaroundTime') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Passenger Average Turnaround Time']) !!}
                                    {!! $errors->first('passengerTurnaroundTime', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-block">Save</button>
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
            data: {}
        });
    </script>
@endsection