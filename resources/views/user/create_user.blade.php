@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}| create_user
@endsection



@section('content')
    <div id="app">
        <div class="container">
              @if(isset($user))
                      {!! Form::model($user, ['action' => ['UserController@update', $user->id], 'method' =>
                      'patch'])
                      !!}
                  @else
                     {!! Form::open(array('action' => 'UserController@store', 'files'=>false)) !!}
                  @endif


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create/Edit Users</h3>
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
                                {!! Form::label('administrator', 'Administrator') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="administrator">
			<span class="input-group-text"><i class="fal fa-pen"></i></span>
        </span>
                                    <sl id="administrator" placeholder="Is Administrator?" name="administrator"
                                        v-model="administrator" :opts="opts"></sl>
                                    {!! $errors->first('administrator', '<p class="invalid-feedback">:message</p>') !!}
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
            data: {
                opts: [{'id': 0, 'name': 'No'}, {'id': 1, 'name': 'Yes'}],
                administrator:{{$administrator or 0}}
            }
        });
    </script>
@endsection