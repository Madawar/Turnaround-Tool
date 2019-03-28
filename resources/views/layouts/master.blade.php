<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en"/>
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{url('favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('favicon.ico')}}"/>
    <!-- Generated: 2018-03-21 10:23:11 +0100 -->
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Oswald" rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

    <!-- Dashboard Core -->
    <link rel="stylesheet" href="{{url('css/bundle.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{url('css/dashboard.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{url('css/picker.css')}}" type="text/css" media="all"/>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="//rubaxa.github.io/Sortable/Sortable.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .input-group >.mx-datepicker {
            flex: 1 1 auto !important;
        }
        .input-group >.selectize-control{
            flex: 1 1 auto !important;
        }
    </style>
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header">
            <div class="container">
                <div class="navbar p-0">
                    <a class="navbar-brand" href="{{action('DashboardController@index')}}">
                        <img height="30px" src="{{url('/')}}{{Illuminate\Support\Facades\Storage::url("public/logo.jpg")}}"/>
                        {{env('COMPANY_NAME')}}
                    </a>
                    @if(Auth::user())
                        <div class="nav order-lg-2">


                            <div class="dropdown ml-3">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                <span class="avatar"
                                      style="background-image: url(./assets/images/faces/female/25.jpg)"></span>
                                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{Auth::user()->name}}</span>
                                        @if(Auth::user()->administrator == 1)
                                            <small class="text-muted d-block mt-1">Admin</small>
                                        @else
                                            <small class="text-muted d-block mt-1">Ramp Staff</small>
                                        @endif
                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{action('HomeController@profile')}}">
                                        <span>Profile</span>
                                    </a>

                                    <a class="dropdown-item" href="{{action('HomeController@signout')}}">Sign out</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{action('Auth\LoginController@login')}}" class="btn btn-success "><i
                                    class="fe fe-log-in"></i> Login</a>
                    @endif
                    <div class="collapse navbar-collapse order-lg-1" id="navbarToggler">
                        <ul class="navbar-nav mt-2 mt-lg-0 mx-0 mx-lg-2">
                            @include('layouts.sidebar.products')
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.sidebar.sidebar')
        <div class="page-content">
            @if(Session::has('message'))
                <div class="alert alert-info flash col-md-6 offset-md-3">
                    <i class="fe fe-info"></i> {{Session::get('message')}}
                </div>
            @endif

            @if(Auth::user())
                @if(\App\User::where('administrator',1)->count() < 1)
                    <div class="alert alert-danger col-md-6 offset-md-3">
                        We noted that you do not have an active Minute Writer set up.
                        This will hinder you from setting up your application effectively.
                        Do you want to set yourself up as a Minute Writer? <a
                                href="{{action('UserController@setAsMinuteWriter')}}" class="btn btn-success">Yes</a>
                    </div>
                @endif
            @endif
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-auto">


                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © {{Carbon\Carbon::today()->format('Y')}} <a href=".">{{env('COMPANY_NAME')}}</a>
                    All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
<script type="text/javascript" src="{{url('js/app.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".flash").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    });

</script>
@yield('jquery')
</body>
</html>
