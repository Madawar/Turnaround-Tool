<html>
<head>
    <link rel="stylesheet" href="{{url('css/bundle.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{url('css/dashboard.css')}}" type="text/css" media="all"/>
    <style>
        body {
            background: #fff !important;

        }

        table {
            border-collapse: collapse !important;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            background-color: lightblue;
            height: 50px;
        }
    </style>
</head>
<body>

@include("report.finance_report_slug")
</body>
</html>

