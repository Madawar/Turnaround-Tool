<template>
    <div class="media pt-2">
        <div class="media-body">
            <div class="media-heading pr-4">
                <small class="float-right text-muted"><i class="fe fe-clock"></i> {{minute.time}} <i v-on:click="deleteMinute"
                                                                         class="fe fe-x-circle pull-right"></i></small>
                <h5><i class="fe fe-user"></i>
                    <span v-for="(particpant,index) in minute.participants">
                        {{particpant.name}}<span v-if="index != (minute.participants.length - 1) && index != (minute.participants.length - 2)">,</span> <span v-if="index == (minute.participants.length - 2)">and</span>

                    </span>


                </h5>
            </div>
            <div class="media-content pr-4 pt-2 pb-2" v-on:click="editMinute">
                {{minute.modifiedText}}
            </div>
            <div class="media-footer pr-4">
                <span class="badge badge-secondary agenda-badge">{{agenda}}</span>

            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'minutes_view',
        props: {
            minute: Object
        },
        data() {
            return {
                'rq': axios.create(),
            }
        },
        mounted() {

        },
        methods: {
            editMinute() {
                this.$emit('swap', 'minutes_edit');
            },
            deleteMinute(minute) {
                this.$emit('delete_minute', minute);
            }
        },
        computed: {
            // a computed getter
            agenda: function () {
                // `this` points to the vm instance
                if (this.minute.agenda === undefined || this.minute.agenda == null || this.minute.agenda == "") {
                    return 'None';
                }else{
                    return this.minute.agenda.name;
                }
            }
        }
    }
</script>
