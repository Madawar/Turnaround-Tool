<template>
    <div >
        <header class="header-bar">
            <div class="left">
                <button class="btn pull-left icon icon-arrow-back"  @click="$router.go(-1)"></button>
                <h1 class="title">{{flt}}</h1>
            </div>
        </header>
        <div class="content">
            <div v-if="loading" class="circle-progress active" style="visibility: visible;">
                <div class="spinner"></div>
            </div>
            <ul class="list" v-if="services.length > 0">
                <span v-for="service in services">
                <li class="divider">{{service.service}}</li>
                    <li v-for="task in service.tasks"><router-link class="padded-list" :to="{ name:'task', params: {id: task.id} }">{{task.task}}</router-link></a></li>
               </span>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'services',
        props: ['id','flt'],
        data() {
            return {
                flightNo: '',
                title: '',
                action: null,
                services: [],
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
            this.rq.get('/api/service')
                .then(function (response) {
                    console.log(response.data)
                    vm.services = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        methods: {
            onHashChanged(flightNo) {

            },
            onReady() {

            }
        }
    }
</script>
