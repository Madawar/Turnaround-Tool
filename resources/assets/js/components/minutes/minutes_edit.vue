<template>
    <div class="minute-edit p-3">
    <textarea v-model="minute.minute" v-bind:style="{ height: height + 'px' }" class="col-md-12 p-10 form-control"
              ref="minute"
              @keydown.enter.exact.prevent
              @keyup.enter.exact="saveAndNewMinute"
              @keyup="saveMinute"
              @blur="saveAndNewMinute"
              @keydown.enter.shift.exact="newline"></textarea>
    </div>
</template>

<script>

    export default {
        name: 'minutes_view',
        props: {
            minute: Object,
            meetingId: [String, Number]
        },
        data() {
            return {
                'rq': axios.create(),
                height: 70

            }
        },
        mounted() {
            // this.$refs.minute.$el.focus();
            this.$refs.minute.focus();
            this.height = this.$refs.minute.scrollHeight;
            console.log(this.$refs.minute.scrollHeight);
        },
        methods: {
            saveAndNewMinute() {
                this.updateMinute();
                this.$emit('swap', 'minutes_view');
            },
            saveMinute: _.debounce(function (val) {
                var vm = this;
                return this.updateMinute();
            }, 1000),
            updateMinute() {
                var vm = this;
                this.rq.patch('/api/minute' + '/' + this.minute.id, {
                    minute: vm.minute.minute,
                    meetingId: vm.meetingId
                })
                    .then(function (response) {
                        console.log(response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
