@extends('layouts.master')

@section('title')
    {!!env('COMPANY_NAME')!!}.Monthly Report
@endsection



@section('content')
    <div id="app">
        <div class="container">
            <div class="card">

                {!! Form::open(array('action' => 'ReportController@generateReport', 'files'=>false)) !!}
                <div class="card-header">
                    <h3 class="card-title">Generate Report</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('carrier', 'Carrier') !!}
                                <div class="input-group">

                                    <sl id="carrier" v-model="carrier" name="carrier" placeholder="Carrier"
                                        url="{{action('Api\FlightController@flightList')}}"></sl>
                                    {!! $errors->first('carrier', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="form-group">
                                {!! Form::label('from', 'From Date') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="from">
			<span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </span>
                                    <date name="from" autocomplete="off" v-model="from" class="form-control"
                                          placeholder="From Date"></date>
                                    {!! $errors->first('from', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">

                            <div class="form-group">
                                {!! Form::label('to', 'To Date') !!}
                                <div class="input-group">
		<span class="input-group-prepend" id="to">
			<span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </span>
                                    <date name="to" autocomplete="off" v-model="to" class="form-control"
                                          placeholder="To Date"></date>
                                    {!! $errors->first('to', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('reportName', 'Report Name') !!}
                                <div class="input-group">

                                    <sl id="reportName" name="reportName" placeholder="Report Name"
                                        :opts="[{id:'carrier_report',name:'Monthly Ramp Report'},{id:'finance_report',name:'Monthly Finance Report'}]"></sl>
                                    {!! $errors->first('reportName', '<p class="invalid-feedback">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary btn-block">Generate</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @if(isset($carrier))
                <div class="card">


                        <h5 class="text-center">
                            <div v-if="download === 0"><i class="fa fa-spinner fa-spin"></i> Generating Report</div>
                            <div v-if="download === 1">
                                <a :href="url"><a :href="url"><i class="fa fa-download"></i> Download
                                        Report</a></a>
                            </div>

                        </h5>
                        @include("report.{$reportName}")
                    </div>


            @endif
        </div>
        @endsection


        @section('jquery')
            <script>
                app = new Vue({
                    el: '#app',
                    mounted() {
                        var vm = this;
                        axios.post("report", {!! $ajaxObj or null !!})
                            .then(function (response) {
                                vm.download = 1;
                                vm.url = response.data.file;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },
                    data: {
                        download: 0,
                        url: '',
                        carrier: '',
                        from: '',
                        to: ''
                    }
                });
            </script>
@endsection