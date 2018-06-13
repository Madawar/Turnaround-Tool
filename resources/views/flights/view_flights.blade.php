@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.View Flights
@endsection



@section('heading')
    View Flights
@endsection
@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Flights</h3>
                    <div class="card-options">

                        <a  class="btn btn-secondary btn-sm" href="{{action('FlightController@create')}}"><i class="fa fa-plus"></i> Add Flight</a>

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
                        name: 'id',
                        title: 'ID',
                        sortField: 'id',
                        visible: true
                    },
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
                        name: 'status',
                        title: 'Status',
                        sortField: 'status',
                        visible: true
                    },
                    {
                        name: 'arrival',
                        title: 'ATA',
                        sortField: 'arrival',
                        visible: true
                    }, {
                        name: 'departure',
                        title: 'ATD',
                        sortField: 'departure',
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