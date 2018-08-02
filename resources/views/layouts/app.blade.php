<!doctype html>
<html lang="en" dir="ltr">
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
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
        requirejs.config({
            baseUrl: '.'
        });
    </script>
    <!-- Dashboard Core -->
    <link rel="stylesheet" href="{{url('css/bundle.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{url('css/dashboard.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{url('css/picker.css')}}" type="text/css" media="all"/>
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Oswald" rel="stylesheet">
    <style>

        html {
            background: url({{url('/')}}{{Illuminate\Support\Facades\Storage::url("public/splash.jpg")}}) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        body{
            background: none !important;
            background-color: none !important;
        }
        .text-muted{
            background: white;
            padding: 5px;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 40, 100, 0.12);
            border-radius: 3px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .title{
            font-family: 'Cormorant Garamond', serif;
            background: white;
            padding: 5px;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 40, 100, 0.12);
            border-radius: 3px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            font-size: 18px;
            font-weight: bolder;

        }
    </style>
</head>
<body class="">
@yield('content')
</body>
</html>