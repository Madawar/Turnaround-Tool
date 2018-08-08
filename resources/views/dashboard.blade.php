@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!} . Dashboard
@endsection



@section('heading')
    Dashboard
@endsection
@section('content')
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card  shadow border-danger">
                        <fl></fl>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card  shadow border-success">
                        <fl></fl>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('jquery')
    <script>
        app = new Vue({
            el: '#app',
            data: {}
        });
    </script>
@endsection