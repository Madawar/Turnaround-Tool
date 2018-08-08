@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}| Your Profile
@endsection




@section('content')
    <div id="app">
        <div class="container">

            {!! Form::model($profile, ['action' => ['HomeController@saveProfile'], 'method' =>
            'patch'])
            !!}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Your Profile</h3>
                </div>
                <div class="card-body">
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('name', 'Username') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="name">
			<span class="input-group-text"><i class="fal fa-user"></i></span>
        </span>
                                    {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Name']) !!}
                                    {!! $errors->first('name', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="email">
			<span class="input-group-text"><i class="fal fa-envelope"></i></span>
        </span>
                                    {!! Form::text('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Email']) !!}
                                    {!! $errors->first('email', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                {!! Form::label('password', 'Email') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="password">
			<span class="input-group-text"><i class="fal fa-envelope"></i></span>
        </span>
                                    {!! Form::text('password', null, ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Your Password']) !!}
                                    {!! $errors->first('password', '<p class="invalid-feedback">:message</p>') !!}
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