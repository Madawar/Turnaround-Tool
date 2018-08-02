<template>
    <div>
        <div class="">
            <div class="row status">
                <div class="col-md-2 text-left ">
                    <small class="" v-if="loading"><i class="fas fa-spinner fa-spin"></i> Saving</small>
                    <small class="" v-if="error"><i class="fe fe-alert-triangle"></i> Error</small>
                </div>
                <div class="col-md-10 text-left">
                    <small><b>Current Agenda :</b> {{agenda.name}}</small>
                </div>
            </div>
            <div class="p-1">
            <textarea id="v-step-3" ref="minute" v-model="minute_entry" v-bind:style="{ height: height + 'px' }"
                      class="col-md-12 form-control"
                      @keydown.enter.exact.prevent
                      @keyup.enter.exact="saveAndNewMinute"
                      @keydown="updateHeight"
                      @keyup="saveMinute"
                      @keydown.enter.shift.exact="newline"></textarea>
            </div>
        </div>
        <div class="minutes" id="v-step-4">

            <minutes_list :meetingId="meetingId" v-on:delete_minute="deleteMinute(minute)" v-on:focus_input="focusinput"
                          v-for="(minute,index) in minutes" :key="index" :minute="minute"></minutes_list>
        </div>
    </div>
</template>

<script>
    import minutes_list from './minutes_list'
    import _ from 'lodash'

    var moment = require('moment');

    export default {
        name: 'minutes',
        components: {
            minutes_list
        },
        props: {
            minutes: Array,
            agenda: Object,
            meetingId: [String, Number]
        },
        data() {
            return {
                minute_entry: '',
                minute_id: '',
                'rq': axios.create(),
                loading: false,
                saving: false,
                error: false,
                updateResponse: null,
                height: 72
            }
        },
        mounted() {
            var vm = this;
            this.rq.interceptors.request.use(function (config) {
                // Do something before request is sent
                vm.loading = true;
                vm.error = false;
                return config;
            }, function (error) {
                vm.error = true;
                // Do something with request error
                return Promise.reject(error);
            });
            this.rq.interceptors.response.use(function (response) {
                // Do something with response data
                vm.loading = false;
                vm.error = false;
                return response;
            }, function (error) {
                vm.loading = false;
                vm.error = true;
                // Do something with response error
                return Promise.reject(error);
            });
            this.$refs.minute.focus()

        },
        methods: {
            focusinput() {
                this.$refs.minute.focus();
            },
            newline() {
                this.value = `${this.value}\n`;
            },
            saveAndNewMinute() {
                var vm = this;
                if (this.minute_entry == "") {
                    return;
                }
                if (this.minute_id > 0) {
                    return this.updateMinute(1);

                } else {
                    this.rq.post('/api/minute', {
                        minute: this.minute_entry,
                        agendaId: this.agenda.id,
                        meetingId: this.meetingId,
                        time: moment().format('H:m:ss')
                    })
                        .then(function (response) {
                            console.log(response.data)
                            vm.minutes.unshift(response.data);
                            vm.minute_entry = "";
                            vm.minute_id = "";
                            vm.height = 72;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }

            },
            deleteMinute(minute) {
                var vm = this;
                this.rq.delete('/api/minute' + '/' + minute.id)
                    .then(function (response) {
                        console.log(response.data)
                        vm.minutes.splice(vm.minutes.indexOf(minute), 1);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            updateHeight() {
                var height = this.$refs.minute.scrollHeight;
                if (height < 72) {
                    this.height = 72;
                } else {
                    this.height = this.$refs.minute.scrollHeight;
                }
            },
            saveMinute: _.debounce(function (val) {
                var vm = this;

                if (this.minute_entry == "") {
                    return;
                }
                if (this.minute_id > 0) {
                    return this.updateMinute();
                } else {
                    this.rq.post('/api/minute', {
                        minute: this.minute_entry,
                        agendaId: this.agenda.id,
                        meetingId: this.meetingId,
                        time: moment().format('H:m:ss')
                    })
                        .then(function (response) {
                            console.log(response.data)
                            vm.minute_id = response.data.id;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }, 1000),
            updateMinute(addToList) {
                var vm = this;
                this.rq.patch('/api/minute' + '/' + this.minute_id, {
                    minute: this.minute_entry,
                    agendaId: this.agenda.id,
                    meetingId: this.meetingId
                })
                    .then(function (response) {
                        console.log(response.data)
                        vm.minute_id = response.data.id;
                        if (addToList == 1) {
                            vm.minutes.unshift(response.data);
                            vm.minute_entry = "";
                            vm.minute_id = "";
                            vm.height = 72;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
