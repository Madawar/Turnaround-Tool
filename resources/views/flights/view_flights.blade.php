@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.View Flights
@endsection



@section('heading')
    View Flights
@endsection
@section('content')
    <style>
.graph{
    height: 100px;
}
    </style>
    <div id="app">
        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Flights</h3>
                    <div class="card-options">

                        <a class="btn btn-secondary btn-sm" href="{{action('FlightController@create')}}" v-tooltip="{
    content: 'Create A New Flight',
    show: true,
    trigger: 'manual',
  }"><i class="fa fa-plus"></i> Add Flight</a>

                    </div>
                </div>

                <vtable detail_row="my_detail_row" url="{{action('Api\FlightController@page')}}" :filters="filters"
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
                        name: 'cx.carrier',
                        title: 'Carrier',
                        sortField: 'cx',
                        visible: true
                    },
                    {
                        name: 'flightNo',
                        title: 'Flight Number',
                        sortField: 'flightNo',
                        visible: true
                    },
                    {
                        name: 'flightDate',
                        title: 'Flight Date',
                        sortField: 'flightDate',
                        visible: true
                    },
                    {
                        name: 'status',
                        title: 'Status',
                        sortField: 'status',
                        visible: true
                    },
                    {
                        name: 'serial',
                        title: 'Serial',
                        sortField: 'serial',
                        visible: true
                    }, {
                        name: 'STA',
                        title: 'STA',
                        sortField: 'STA',
                        visible: true
                    }, {
                        name: 'STD',
                        title: 'STD',
                        sortField: 'STD',
                        visible: true
                    },{
                        name: 'id',
                        title: 'Update',
                        sortField: 'id',
                        visible: true,
                        callback: function (value) {
                            return '<a href="update/' + value + '" class="btn btn-success btn-sm"><i class="fe fe-clock"></i> Update</a>';
                        }
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