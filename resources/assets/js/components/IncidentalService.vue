<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="input-icon">

                    <input type="text" @keydown.enter.exact.prevent @keydown.enter.exact="submit" class="form-control" v-model="service" placeholder="Incidental Service">
                </div>
            </div>
            <div class="col">
                <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-mail"></i>
                            </span>
                    <input type="text" @keydown.enter.exact.prevent @keydown.enter.exact="submit" class="form-control" v-model="trips" placeholder="Trips">
                </div>
            </div>
            
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Service</th>
                    <th>Trips</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="service in services">
                    <td>{{service.incidentalService}}</td>
                    <td>{{service.trips}}</td>
                    <td>
                        <div @click="deleteService(service)"  class="btn btn-danger btn-sm btn-block">
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
    import Autocomplete from 'vue2-autocomplete-js';
    export default {
        name: "incidental-service",
        props: ['serv'],
        components: { Autocomplete },
        data: function () {
            return {
                services: [],
                service: '',
                trips: '',
                name: '',
                opts:[
                    {'service':'ddsd dssdf'},
                    {'service':'ddsd dssdf'},
                ]
            }
        },
        mounted: function () {
            if(this.serv != null){
                this.services = this.serv;
            }

        },
        watch: {},
        destroyed: function () {
        },
        methods: {
            g(){

            },
            getData(obj){
                console.log(obj);
                this.name = obj.name;
                this.trips = obj.trips;
                this.$refs.abbr.focus();
            },
            submit() {
                if (this.service != "" && this.trips != "") {
                    this.services.push({
                        incidentalService: this.service,
                        trips: this.trips,
                    });
                    this.service = "";
                    this.trips = "";
                    this.$emit('input', this.services);
                }else{
                    alert('Please fill in all fields')
                }
                $('.autocomplete-input').focus();

            },
            deleteService(attendee) {

                this.services.splice(this.services.indexOf(attendee), 1);
            },
            deleteLive() {

            }
        }
    }
</script>

<style scoped>

</style>