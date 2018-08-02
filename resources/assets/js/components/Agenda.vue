<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="input-icon">
            <span class="input-icon-addon">
            <i class="fe fe-layers"></i>
            </span>
                    <input type="text" @keydown.enter.exact.prevent ref="name" @keydown.enter.exact="submit"
                           class="form-control" v-model="name"
                           placeholder="Agenda">
                </div>
            </div>
            <div class="col">
                <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-clock"></i>
                            </span>
                    <input type="text" @keydown.enter.exact.prevent @keydown.enter.exact="submit"
                           v-on:submit.prevent="submit" class="form-control" v-model="minutes"
                           placeholder="Minutes">
                </div>
            </div>


        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Agenda</th>
                    <th>Minutes</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="agenda in agendas">
                    <td>{{agenda.name}}</td>
                    <td>{{agenda.minutes}}</td>
                    <td>
                        <div @click="deleteAttendee(agenda)" class="btn btn-danger btn-sm btn-block">
                            Delete
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash'

    export default {
        props: ['def'],
        data: function () {
            return {
                agendas: [],
                name: '',
                minutes: '',

            }
        },
        mounted: function () {
            if (this.def != null) {
                this.agendas = this.def;
            }
        },
        watch: {},
        destroyed: function () {
        },
        methods: {
            submit() {
                if (this.name != "" && this.minutes != "") {
                    this.agendas.push({
                        name: this.name,
                        minutes: this.minutes
                    });
                    this.minutes = "";
                    this.name = "";
                    this.$emit('input', this.agendas);
                } else {
                    alert('Please fill in all fields');
                }
                this.$refs.name.focus();

            },
            deleteAttendee(agenda) {
                console.log(agenda);
                if (_.has(agenda, 'id')) {
                    axios.delete('/api/agenda' + '/' + agenda.id)
                        .then(function (response) {
                            console.log(response.data)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
                this.agendas.splice(this.agendas.indexOf(agenda), 1);
            },
            deleteLive() {

            }
        }
    };
</script>
