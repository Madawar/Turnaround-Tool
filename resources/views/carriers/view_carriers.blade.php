@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}| View Carrier
@endsection



@section('content')
    <div id="app">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Carriers</h3>
                    <div class="card-options">

                        <a  class="btn btn-secondary btn-sm" href="{{action('CarrierController@create')}}"><i class="fa fa-plus"></i> Add Carrier</a>

                    </div>
                </div>
                <vtable url="{{action('Api\CarrierController@index')}}" :filters="filters"
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
                        name: 'carrier',
                        title: 'Carrier',
                        sortField: 'cx',
                        visible: true
                    },
                    {
                        name: 'freighterTurnaroundTime',
                        title: 'Freighter Turnaround Time',
                        sortField: 'freighterTurnaroundTime',
                        visible: true
                    },
                    {
                        name: 'passengerTurnaroundTime',
                        title: 'Passenger Turnaround Time',
                        sortField: 'passengerTurnaroundTime',
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