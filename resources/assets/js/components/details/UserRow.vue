<template>
    <div @click="onClick">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary btn-block">Activate User</button>
            </div>
            <div class="col-md-6">

            </div>
        </div>
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