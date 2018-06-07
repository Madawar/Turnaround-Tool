@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}| View Services
@endsection




@section('content')
    <div id="app">
        <div class="container">


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Services</h3>
            </div>

                <vtable url="{{action('Api\ServiceController@page')}}" :filters="filters"
                        :columns="columns"></vtable>


        </div>
        </div>
    </div>
@endsection


@section('jquery')
    <script>
        app = new Vue({
            el: '#app',
            data: {
                columns: [

                    {
                        name: 'id',
                        title: 'ID',
                        sortField: 'id',
                        visible: true
                    },
                    {
                        name: 'service',
                        title: 'Service',
                        sortField: 'service',
                        visible: true
                    },


                    {
                        name: '__component:custom-actions',
                        title: 'Actions',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        visible: true
                    }
                ],
                filters: []

            },
            methods: {}
        });
    </script>
@endsection