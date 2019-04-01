<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="qty">Service</label>
                    <div class="input-icon">
                        <input class="form-control" disabled="true" placeholder="Incidental Service" type="text"
                               v-model="service.description">
                    </div>
                </div>
            </div>
            <div class="col-md-4" v-if="service.uom != 'TIME-INTERVAL'">
                <div class="form-group">
                    <label for="qty">QTY ({{service.REMARKS}})</label>
                    <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-clock"></i>
                            </span>
                        <input ref="qty" :placeholder="service.REMARKS" @keydown.enter.exact="submit" @keydown.enter.exact.prevent
                               class="form-control"
                               type="text" v-model="qty">
                    </div>
                </div>
            </div>

            <div class="col-md-3" v-if="service.uom == 'TIME-INTERVAL'">
                <div class="form-group">
                    <label for="qty">Start Time</label>
                    <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-clock"></i>
                            </span>
                        <date-picker ref="datepicker"  :default-value="date_limit" :not-before="date_limit" format="YYYY/MM/DD HH:mm:ss"
                                     input-class="form-control" input-name="start" lang="en"
                                     placeholder="Start Time" type="datetime" v-model="start"></date-picker>
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-if="service.uom == 'TIME-INTERVAL'">
                <div class="form-group">
                    <label for="qty">End Time</label>
                    <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-clock"></i>
                            </span>
                        <date-picker :not-before="start" format="YYYY/MM/DD HH:mm:ss" input-class="form-control"
                                     input-name="end" lang="en"
                                     placeholder="End Time" type="datetime" v-model="end"></date-picker>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="qty">&nbsp;</label>
                <div @click="submit" class="btn btn-flat bg-green btn-block"><i class="fa fa-plus"></i> Add Service
                </div>
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Service</th>
                    <th>Quantity</th>
                    <th>Start</th>
                    <th>End</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="service in services">
                    <td>{{service.incidentalService}}</td>
                    <td>{{service.qty}}</td>
                    <td>{{service.start}}</td>
                    <td>{{service.end}}</td>
                    <td>
                        <div @click="deleteService(service)" class="btn btn-danger btn-sm btn-block">
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
    import ajax from '../../ajax'
    import DatePicker from 'vue2-datepicker'

    var moment = require('moment');
    export default {
        props: ['incid', 'oldincids', 'date_limit'],
        mixins: [ajax],
        name: "incidental_list",
        components: {DatePicker},
        mounted() {
            if (this.oldincids != "") {
                this.services = this.oldincids;
            }
        },
        data() {
            return {
                service: [],
                services: [],
                base_url: '/api/incidentalservices',
                start: '',
                end: '',
                qty: 0
            }
        },
        methods: {
            submit() {
                if (this.start != "" && this.end != "") {
                    var timestamp = new Date(this.start);
                    console.log(moment(timestamp).format('YYYY/MM/DD HH:mm'));
                    this.start = moment(timestamp).format('YYYY/MM/DD HH:mm');
                    var timestamp = new Date(this.end);
                    console.log(moment(timestamp).format('YYYY/MM/DD HH:mm'));
                    this.end = moment(timestamp).format('YYYY/MM/DD HH:mm');
                }

                if (this.service != "" && this.qty != 0) {
                    this.services.push({
                        incidentalService: this.service.description,
                        qty: this.qty,
                        start: this.start,
                        end: this.end,
                        INCid: this.service.INCid,
                        remarks: this.service.REMARKS
                    });
                    this.service = "";
                    this.qty = "";
                    this.$emit('input', this.services);
                    this.$emit('clear_incid');
                } else if (this.start != "" && this.end != "") {
                    this.services.push({
                        incidentalService: this.service.description,
                        qty: this.qty,
                        start: this.start,
                        end: this.end,
                        INCid: this.service.INCid,
                        remarks: this.service.REMARKS
                    });
                    this.service = "";
                    this.qty = 0;
                    this.end = "";
                    this.start = "";
                    this.$emit('input', this.services);
                    this.$emit('clear_incid');
                } else {
                    alert('Please fill in all fields')
                }
                $('.autocomplete-input').focus();


            },
            deleteService(attendee) {

                this.services.splice(this.services.indexOf(attendee), 1);
            },
            deleteLive() {

            }
        },
        watch: {
            incid: function (val) {
                var vm = this;
                this.fetch(val, this.base_url, {}, function (obj) {
                    vm.service = obj;
                    if(obj.uom != 'TIME-INTERVAL'){
                        vm.$refs.qty.focus()
                    }else{

                    }
                });


            },
            services: function (val) {
                this.$emit('input', JSON.stringify(this.services));
            }
        }
    }
</script>

<style scoped>

</style>
