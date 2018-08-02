@extends('layouts.app')
@section('title')
    Forgot Password | {{env('COMPANY_NAME')}}
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

                        <form class="card" action="{{ route('password.email') }}" method="post">
                            <div class="card-body p-6">
                                <div class="card-title">Forgot password</div>
                                <p class="text-muted">Enter your email address and your password will be reset and emailed to you.</p>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Send me new password</button>
                                </div>
                            </div>
                            @csrf
                            <input type="hidden" name="token" value="{{ csrf_token() }}">
                        </form>
                        <div class="text-center text-muted">
                            Forget it, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
