@extends('layouts.app')
@section('title')
    Login | {{env('COMPANY_NAME')}}
@endsection
@section('content')
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-1 title">
                            {{env('COMPANY_NAME')}}
                        </div>
                        <form class="card" action="{{ route('login') }}" method="post">
                            <div class="card-body p-6">
                                <div class="card-title">Login to your account !!</div>
                                <div class="form-group">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        Password
                                        <a href="{{ route('password.request') }}" class="float-right small">I forgot
                                            password</a>
                                    </label>
                                    <input type="password"  name="password" class="form-control" id="exampleInputPassword1"
                                           placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"/>
                                        <span class="custom-control-label">Remember me</span>
                                    </label>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                </div>
                            </div>
                            @csrf
                            <input type="hidden" name="token" value="{{ csrf_token() }}">
                        </form>
                        <div class="text-center text-muted">
                            Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


