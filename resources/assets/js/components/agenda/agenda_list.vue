<template>
    <div href="#" class="list-group-item list-group-item-action d-flex align-items-center" v-bind:class="{ active: agenda.isActive }">
        <span class="icon mr-3"><i class="fe fe-chevron-right"></i></span>{{agenda.name}}<span
            class="ml-auto badge badge-primary">{{agenda.minutes}} Minutes</span>
    </div>
</template>

<script>
    export default {
        name: 'agenda_list',
        props: {
            agenda: Object
        },
        data() {
            return {
                'rq': axios.create(),
            }
        },
        mounted() {

        },
        methods: {

        }
    }
</script>
