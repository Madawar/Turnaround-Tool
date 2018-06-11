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
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico"/>
    <!-- Generated: 2018-03-21 10:23:11 +0100 -->
    <title>@yield('title')</title>
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
        body *::-webkit-scrollbar {
            width: 6px;
            height: 6px;
            transition: .3s background;
        }

        body *::-webkit-scrollbar-thumb {
            background: #ced4da;
        }

        body *:hover::-webkit-scrollbar-thumb {
            background: #adb5bd;
        }

        html, body, .container-fluid {
            max-height: 100% !important;
        }
    </style>
</head>
<body class="">
<div class="container-fluid d-flex  h-100">
    <div class="row">
        <div style="background: red;" class="col-md-3" >a
        </div>
        <div style="background: blue;" class="col-md-5">a</div>
    </div>


</div>

<script type="text/javascript" src="{{url('js/app.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins.js')}}"></script>
@yield('jquery')
</body>
</html>