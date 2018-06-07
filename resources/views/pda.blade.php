<!DOCTYPE html>
<html>
<head>
    <!-- ... metas and styles ... -->
    <link rel="stylesheet" href="{{url('css/pda.css')}}" type="text/css" media="all"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<!-- App Root Element -->
<div id="app">
<router-view></router-view>
</div>

<!-- Path to your app js where you init your app-->
<script type="text/javascript" src="{{url('js/app.js')}}"></script>
<script>
    var app = new Vue({
       router
    }).$mount('#app');
</script>
</body>
</html>



