<template>
    <a @click="togglePresence" class="list-group-item list-group-item-action d-flex align-items-center">
        <span class="icon mr-3"><i @click="togglePresence" v-if="attendee.isPresent == 0" class="fe fe-user-x"></i><i
                @click="togglePresence" v-if="attendee.isPresent == 1" class="fe fe-user-check"></i></span>{{attendee.name}} <span class="text-green" v-if="attendee.isPresent == 1"><small> - Present</small></span> <span class="text-danger" v-if="attendee.isPresent == 0"><small> - Absent </small></span>
        <span
                class="ml-auto badge "
                v-bind:class="{ 'badge-success': attendee.isPresent,'badge-danger': !attendee.isPresent}">{{attendee.abbreviation}}</span>
    </a>
</template>

<script>
    export default {
        name: 'attendee_list',
        props: {
            attendee: Object
        },
        data() {
            return {
                'rq': axios.create(),
            }
        },
        mounted() {

        },
        methods: {
            togglePresence() {
                this.attendee.isPresent = !this.attendee.isPresent;
                var vm = this;
                this.rq.patch('/api/attendee' + '/' + this.attendee.id, {
                    isPresent: this.attendee.isPresent,
                })
                    .then(function (response) {
                        vm.attendee.isPresent = response.data.isPresent;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        computed: {
            displayClass() {
                if (this.attendee.isPresent == 1) {
                    return 'badge-success';
                } else {
                    return 'badge-danger';
                }
            }
        }
    }
</script>
