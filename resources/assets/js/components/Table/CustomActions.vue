<template>
    <div class="custom-actions">
        <a  :href="rowData.view" class="btn btn-secondary btn-sm"><i class="fe fe-eye"></i> {{rowData.button}}</a>
        <div v-if="rowData.delete" :href="rowData.delete" @click="deleteItem(rowData)" class="btn btn-danger btn-sm"><i class="fe fe-trash-2"></i> Delete</div>

        <a v-if="rowData.edit"  class="icon" :href="rowData.edit">
            <i class="fe fe-edit"></i>
        </a>
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
            },
            show: {
                type: Boolean,
                default: true
            }
        },
        methods: {
            deleteItem (data) {
                console.log(data.id);
                this.$events.fire('delete-show', data.delete)
            }
        }
    }
</script>

<style>
    .custom-actions button.ui.button {
        padding: 8px 8px;
    }

    .custom-actions button.ui.button > i.icon {
        margin: auto !important;
    }
</style>