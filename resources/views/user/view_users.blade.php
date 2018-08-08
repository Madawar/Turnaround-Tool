@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!} | View Users
@endsection



@section('heading')
    View Users
@endsection
@section('content')
    <div id="app">
        <div class="container">
        <div class="card">
            <div class="card-header">
                 <h3 class="card-title">View Users</h3>
                <div class="card-options">

                    <a  class="btn btn-secondary btn-sm" href="{{action('UserController@create')}}"><i class="fa fa-plus"></i> Add User</a>

                </div>
            </div>
            <vtable detail_row="user_row" url="{{action('Api\UserController@index')}}" :filters="filters"
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
                        name: 'name',
                        title: 'User Name',
                        sortField: 'name',
                        visible: true
                    },
                    {
                        name: 'email',
                        title: 'Email',
                        sortField: 'email',
                        visible: true
                    },
                    {
                        name: 'administrator',
                        title: 'Administrator',
                        sortField: 'administrator',
                        visible: true,
                        callback: function (value) {
                            if(value==1){
                                return 'Yes';
                            }else{
                                return 'NO';
                            }
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
            }
        });
    </script>
@endsection