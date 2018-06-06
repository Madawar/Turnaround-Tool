<template>
    <div data-page="true" data-nocache="true" :data-alias="$options.name">
        <header class="header-bar">
            <div class="left">
                <button class="btn pull-left icon icon-arrow-back" @click="$router.go(-1)"></button>
                <h1 class="title">{{taskName}}</h1>
            </div>
        </header>
        <div class="content padded-full">
            <div v-if="loading" class="circle-progress active" style="visibility: visible;">
                <div class="spinner"></div>
            </div>
            <span v-if="!loading">
                  <h1>{{task.task}}</h1>
            <hr/>
            <button class="btn positive"><i class="icon icon-check"></i> Start Activity</button>
            <button style="float: right !important;" class="btn negative"><i class="icon icon-close"></i> Stop Activity</button>
            </span>

        </div>

    </div>
</template>

<style scoped>
    h1{
        text-align: center !important;
        padding:5px;
    }
</style>
<script>
    export default {
        name: 'task',
        props: ['id'],
        data() {
            return {
                task: '',
                taskName: '',
                action: null,
                loading:false,
                'rq': axios.create(),
            }
        },
        mounted() {
            var vm = this;
            this.rq.interceptors.request.use(function (config) {
                // Do something before request is sent
                vm.loading = true;
                return config;
            }, function (error) {
                // Do something with request error
                return Promise.reject(error);
            });
            this.rq.interceptors.response.use(function (response) {
                // Do something with response data
                vm.loading = false;
                return response;
            }, function (error) {
                // Do something with response error
                return Promise.reject(error);
            });
            this.rq.get('/api/task' + '/' + this.id)
                .then(function (response) {
                    console.log(response.data)
                    vm.task = response.data;
                    vm.taskName = response.data.task;
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        methods: {}
    }
</script>
