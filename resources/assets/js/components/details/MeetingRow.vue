<template>
    <div @click="onClick">
        <div class="row">
            <div class="col-md-6">
                <table v-if="rowData!=''" class="table card-table table-vcenter text-nowrap table-sm">
                    <tr>
                        <th>Name</th>
                        <th>Abbreviation</th>

                    </tr>
                    <tr v-for="row in rowData.attendees">
                        <td>{{row.name}}</td>
                        <td>{{row.abbreviation}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table v-if="rowData!=''" class="table card-table table-vcenter text-nowrap table-sm">
                    <tr>
                        <th>Agenda</th>
                        <th>Minutes</th>


                    </tr>
                    <tr v-for="row in rowData.agenda">
                        <td>{{row.name}}</td>
                        <td>{{row.minutes}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div v-if="rowData==''" class="text-center"><b>No Data Yet</b></div>
    </div>

</template>

<script>
    export default {
        props: {
            rowData: {
                type: Object,
                required: true
            },
            rowIndex: {
                type: Number
            }
        },
        methods: {
            onClick(event) {
                console.log('my-detail-row: on-click', event.target)
            }
        },
    }
</script>