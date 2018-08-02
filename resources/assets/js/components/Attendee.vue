<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="input-icon">

                    <autocomplete
                            url="/api/attendee/"
                            anchor="name"
                            ref="name"
                            label="email"
                            v-model="name"
                            placeholder="Attendee Name"
                            :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                            :on-select="getData">
                    </autocomplete>
                </div>
            </div>
            <div class="col">
                <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-mail"></i>
                            </span>
                    <input type="text" @keydown.enter.exact.prevent @keydown.enter.exact="submit" class="form-control" v-model="email" placeholder="Email">
                </div>
            </div>

            <div class="col">
                <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-at-sign"></i>
                            </span>
                    <input ref="abbr" type="text" @keydown.enter.exact.prevent @keydown.enter.exact="submit" class="form-control" v-model="abbreviation"
                           placeholder="Abbreviation">
                </div>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Abbreviation</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="attendee in attendants">
                <td>{{attendee.name}}</td>
                <td>{{attendee.email}}</td>
                <td>{{attendee.abbreviation}}</td>
                <td>
                    <div @click="deleteAttendee(attendee)"  class="btn btn-danger btn-sm btn-block">
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
        props: ['def'],
        components: { Autocomplete },
        data: function () {
            return {
                attendants: [],
                abbreviation: '',
                email: '',
                name: ''
            }
        },
        mounted: function () {
            if(this.def != null){
                this.attendants = this.def;
            }

        },
        watch: {},
        destroyed: function () {
        },
        methods: {
            getData(obj){
                console.log(obj);
                this.name = obj.name;
                this.email = obj.email;
                this.$refs.abbr.focus();
            },
            submit() {
                if (this.name != "" && this.email != "") {
                    this.attendants.push({
                        abbreviation: this.abbreviation,
                        email: this.email,
                        name: this.name
                    });
                    this.abbreviation = "";
                    this.email = "";
                    this.name = "";
                    this.$refs.name.setValue('');
                    this.$emit('input', this.attendants);
                }else{
                    alert('Please fill in all fields')
                }
                $('.autocomplete-input').focus();

            },
            deleteAttendee(attendee) {
                if (_.has(attendee, 'id')) {
                    axios.delete('/api/attendee' + '/' + attendee.id)
                        .then(function (response) {
                            console.log(response.data)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
                this.attendants.splice(this.attendants.indexOf(attendee), 1);
            },
            deleteLive() {

            }
        }
    };
</script>
