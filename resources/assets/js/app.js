/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')
import phonon from 'phonon/dist/js/phonon-core'
import VueRouter from 'vue-router'
import Flight from './components/Flights';
import Service from './components/Services';
import Task from './components/Task';
import VTooltip from 'v-tooltip'
import Vodal from 'vodal';
import "vodal/common.css";
import "vodal/door.css";

var moment = require('moment');
window.moment = require('moment');

var debounce = require('debounce');

Vue.use(phonon);
Vue.use(VueRouter);
Vue.use(moment);
Vue.use(debounce);
Vue.use(VTooltip)



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import { Datetime } from 'vue-datetime-2';

Vue.component('datetime', Datetime);
Vue.component(Vodal.name, Vodal);
Vue.component('date', require('./components/datepicker.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('flight', require('./components/Flights'));
Vue.component('services', require('./components/Services'));
Vue.component('task', require('./components/Task'));
Vue.component('app', require('./components/App'));
Vue.component('sl', require('./components/selectize/selectize'));
Vue.component('vtable', require('./components/Table/Table'));
Vue.component('fl', require('./components/charts/flight_details'));
Vue.component('incid', require('./components/IncidentalService'));


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

