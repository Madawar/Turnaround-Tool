<template>
    <div class="list-group list-group-transparent mb-0">
        <agenda_list v-for="(agenda,index) in agendas" :key="index" :agenda="agenda"></agenda_list>
    </div>
</template>

<script>
    import agenda_list from './agenda_list'
//import _ from 'lodash'
    export default {
        name: 'agenda',
        components: {
            agenda_list
        },
        props: {
            agendas: Array,
            currentAgenda: {}
        },
        data() {
            return {

                'rq': axios.create(),
            }
        },
        mounted() {

        },
        methods: {}
        ,
        watch: {
            // whenever question changes, this function will run
            currentAgenda: function (agenda) {
                var loop = this.agendas.indexOf(agenda);
                Vue.set(this.agendas[this.agendas.indexOf(agenda)],'isActive',1)
               // this.agendas[this.agendas.indexOf(agenda)]['isActive'] = 1;
                if (loop - 1 >= 0) {
                    this.agendas[loop - 1]['isActive'] = 0;
                }
                if(loop == 0){
                    Vue.set(this.agendas[this.agendas.length-1],'isActive',0)
                }

            }
        }
    }
</script>
