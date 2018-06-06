<!DOCTYPE html>
<html>
<head>
    <!-- ... metas and styles ... -->
    <link rel="stylesheet" href="{{url('css/f7.css')}}" type="text/css" media="all"/>
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



