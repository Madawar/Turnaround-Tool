<template>
    <div class="attendees-body">
        <div class="list-group list-group-transparent mb-0">
            <attendee_list v-for="(attendee,index) in attendees" :key="index" :attendee="attendee"></attendee_list>
        </div>
    </div>
</template>

<script>
    import attendee_list from './Attendees_list'

    export default {
        name: 'attendees',
        components: {
            attendee_list
        },
        props: {
            attendees: Array
        },
        data() {
            return {

                'rq': axios.create(),
            }
        },
        mounted() {

        },
        methods: {}
    }
</script>
