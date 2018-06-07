/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import phonon from 'phonon/dist/js/phonon-core'
import VueRouter from 'vue-router'
import Flight from './components/Flights';
import Service from './components/Services';
import Task from './components/Task';
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'

var moment = require('moment');
var debounce = require('debounce');

Vue.use(phonon);
Vue.use(VueRouter);
Vue.use(moment);
Vue.use(debounce);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('datetime', Datetime);
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('flight', require('./components/Flights'));
Vue.component('services', require('./components/Services'));
Vue.component('task', require('./components/Task'));
Vue.component('app', require('./components/App'));
Vue.component('sl', require('./components/selectize/selectize'));
Vue.component('vtable', require('./components/Table/Table'));

window.router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/pda', component: Flight
        },
        {
            path: '/services/:id/:flt',
            component: Service,
            name: 'services',
            props: true
        },
        {
            path: '/tasks/:id/:flt',
            component: Task,
            name: 'task',
            props: true
        }
    ]
});

