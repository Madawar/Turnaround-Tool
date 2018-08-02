<template>
    <component :meetingId="meetingId" v-on:delete_minute="deleteMinute(minute)" :is="currentComponent" :minute="minute" v-on:swap="editComponent"></component>

</template>

<script>


    export default {
        name: 'minutes_list',
        props: {
            minute: Object,
            meetingId:[String, Number]
        },
        components: {},
        data() {
            return {
                'rq': axios.create(),
                currentComponent: 'minutes_view'
            }
        },
        mounted() {

        },
        methods: {
            editComponent(val) {
                this.currentComponent = val;
                if(val == 'minutes_view'){
                    this.$emit('focus_input');
                }
            },
            deleteMinute(minute){
                this.$emit('delete_minute',minute);
            }
        }
    }
</script>
