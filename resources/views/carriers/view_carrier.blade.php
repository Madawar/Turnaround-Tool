@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}| View Carrier
@endsection



@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Services</h3>
                </div>
                <vtable detail_row="tasks_row" url="{{action('Api\ServiceController@page',array('carrier'=>$carrier->id))}}" :filters="filters"
                        :columns="columns"></vtable>
                <div class="card-footer text-right">
                    <a href="{{action('ServiceController@create',array('carrierId'=>$carrier->id))}}" class="btn btn-primary btn-block">Add Service</a>
                </div>
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