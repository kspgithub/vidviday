<template>
    <div class="double-datepicker">
        <form-datepicker v-model="fromDateInner"
                         :display-format="displayFormat"
                         :label="fromTitle"
                         :max-date="toDateInner || maxDate"
                         :min-date="minDate"
                         :name="fromFieldName"
                         :value-format="valueFormat"
                         class="date-departure"/>

        <form-datepicker v-model="toDateInner"
                         :display-format="displayFormat"
                         :label="toTitle"
                         :max-date="maxDate"
                         :min-date="fromDateInner || minDate"
                         :name="toFieldName"
                         :value-format="valueFormat"
                         class="date-arrival"/>
    </div>
</template>

<script>
import {computed, onMounted, ref} from "vue";
import FormDatepicker from "./FormDatepicker";

export default {
    name: "FormDoublePicker",
    components: {FormDatepicker},
    props: {
        dateFrom: String,
        dateTo: String,
        fromTitle: {
            type: String,
            default: 'Дата Виїзду',
        },
        toTitle: {
            type: String,
            default: 'Дата Приїзду',
        },
        fromFieldName: {
            type: String,
            default: 'date_from',
        },
        toFieldName: {
            type: String,
            default: 'date_to',
        },
        displayFormat: {
            type: String,
            default: 'dd, DD.MM.YYYY' // https://momentjs.com/docs/#/displaying/format/
        },
        valueFormat: {
            type: String,
            default: 'dd.mm.yyyy' // http://t1m0n.name/air-datepicker/docs/index-ru.html#sub-section-9
        },
        minDate: {
            type: String,
            default: ''
        },
        maxDate: {
            type: String,
            default: ''
        },
    },
    emits: ['update:dateFrom', 'update:dateTo'],
    setup(props, {emit}) {

        const fromDateInner = computed({
            get() {
                return props.dateFrom || ''
            },
            set(value) {
                emit('update:dateFrom', value);
            }
        });

        const toDateInner = computed({
            get() {
                return props.dateTo || ''
            },
            set(value) {
                emit('update:dateTo', value);
            }
        });

        return {
            fromDateInner,
            toDateInner,
        }
    }

}
</script>

<style scoped>

</style>
