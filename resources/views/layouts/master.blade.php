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
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header">
            <div class="container">
                <div class="navbar p-0">
                    <a class="navbar-brand" href="./index.html">
                        <img src="./assets/brand/tabler.svg" class="navbar-brand-img" alt="tabler.io">
                    </a>
                    <div class="nav order-lg-2">
                        <div class="nav-item">
                            <a href="/pda" class="btn btn-sm btn-outline-primary"
                               target="_blank">Hand Held</a>
                        </div>
                        <div class="dropdown d-none d-md-flex">
                            <a class="nav-link icon" data-toggle="dropdown">
                                <i class="fe fe-message-square"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto
                                asperiores dolorem, est fugiat in maxime natus officia velit voluptas! Ab asperiores
                                delectus dolore dolores maxime nesciunt qui quia totam.
                            </div>
                        </div>
                        <div class="dropdown d-none d-md-flex">
                            <a class="nav-link icon" data-toggle="dropdown">
                                <i class="fe fe-bell"></i>
                                <span class="nav-unread"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto
                                asperiores dolorem, est fugiat in maxime natus officia velit voluptas! Ab asperiores
                                delectus dolore dolores maxime nesciunt qui quia totam.
                            </div>
                        </div>
                        <div class="dropdown ml-3">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                <span class="avatar"
                                      style="background-image: url(./assets/images/faces/female/25.jpg)"></span>
                                <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">Jane Pearson</span>
                      <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">
                                    <span>Profile</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <span>Settings</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <span class="float-right"><span class="badge badge-primary">6</span></span>
                                    <span>Inbox</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <span>Message</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Need help? </a>
                                <a class="dropdown-item" href="#">Sign out</a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse order-lg-1" id="navbarToggler">
                        <ul class="navbar-nav mt-2 mt-lg-0 mx-0 mx-lg-2">
                            <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Projects</a>
                                <div class="dropdown-menu mt-2 text-color" role="menu">
                                    <a href="#" class="dropdown-item"><i class="dropdown-icon fa fa-tag"></i> Action
                                    </a>
                                    <a href="#" class="dropdown-item"><i class="dropdown-icon fa fa-pencil"></i> Another
                                        action </a>
                                    <a href="#" class="dropdown-item"><i class="dropdown-icon fa fa-reply"></i>
                                        Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item"><i class="dropdown-icon fa fa-ellipsis-h"></i>
                                        Separated link</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.sidebar.sidebar')
        <div class="page-content">
            @yield('content')
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">First link</a></li>
                                <li><a href="#">Second link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Third link</a></li>
                                <li><a href="#">Fourth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Fifth link</a></li>
                                <li><a href="#">Sixth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Other link</a></li>
                                <li><a href="#">Last link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    Premium and Open Source dashboard template with responsive and high quality UI. For Free!
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                                <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source
                                code</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a>
                    All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
<script type="text/javascript" src="{{url('js/app.js')}}"></script>
<script type="text/javascript" src="{{url('js/plugins.js')}}"></script>
@yield('jquery')
</body>
</html>