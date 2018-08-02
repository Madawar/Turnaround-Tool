@extends('layouts.app')
@section('title')
    Register | {{env('COMPANY_NAME')}}
@endsection
@section('content')

<div class="container">
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-1 title">
                            {{env('COMPANY_NAME')}}
                        </div>

                        <form class="card" action="{{ route('register') }}" method="post">
                            <div class="card-body p-6">
                                <div class="card-title">Create new account</div>
                                @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        <ul>

                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                                </div>
                            </div>
                            @csrf
                            <input type="hidden" name="token" value="{{ csrf_token() }}">
                        </form>
                        <div class="text-center text-muted">
                            Already have account? <a href="{{ route('login') }}">Sign in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
