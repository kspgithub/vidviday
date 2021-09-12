<template>
    <div :class="{active: open}" class="datepicker-input vue-datepicker">
        <span class="datepicker-placeholder" @click="open = !open">{{ displayLabel }}</span>
        <div class="datepicker-toggle">
            <div ref="pickerEl" :class="{filled: filled, picked: filled}">
                <input :name="name" :value="modelValue" type="hidden">
            </div>
        </div>
    </div>
</template>

<script>
import {computed, onBeforeUnmount, onMounted, onUnmounted, ref, watch} from "vue";
import {useI18nLocal} from "../../composables/useI18nLocal";
import moment from "moment";

export default {
    name: "FormDatepicker",
    props: {
        label: String,
        modelValue: {
            type: String,
            default: ''
        },
        name: String,
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
        participant: {
            type: Boolean,
            default: false,
        }
    },
    emits: ['update:modelValue', 'onSelect'],
    setup(props, {emit}) {
        const {locale} = useI18nLocal();

        const pickerEl = ref(null);
        const datepicker = ref(null);
        const open = ref(false);

        const displayLabel = computed(() => {
            return !props.modelValue
                ? props.label
                : moment(props.modelValue, props.valueFormat.toUpperCase()).format(props.displayFormat);
        });


        const filled = computed(() => props.participant && props.modelValue);

        const startDate = computed(() => props.modelValue ? moment(props.modelValue, props.valueFormat.toUpperCase()).toDate() : '');
        const minDate = computed(() => props.minDate ? moment(props.minDate, props.valueFormat.toUpperCase()).toDate() : '');
        const maxDate = computed(() => props.maxDate ? moment(props.maxDate, props.valueFormat.toUpperCase()).toDate() : '');

        const close = () => {

            open.value = false;
        }

        onMounted(() => {
            $(pickerEl.value).datepicker({
                inline: true,
                language: locale.value,
                dateFormat: props.valueFormat,
                startDate: startDate.value,
                minDate: minDate.value,
                maxDate: maxDate.value,
                onSelect: function (formattedDate, date, ins) {
                    open.value = false;
                    emit('update:modelValue', formattedDate);
                    emit('onSelect', {formattedDate, date, ins});
                },
            });

            datepicker.value = $(pickerEl.value).datepicker().data('datepicker');

        });

        watch(startDate, () => {
            if (datepicker.value) {
                datepicker.value.update('startDate', startDate.value)
            }
        });

        watch(minDate, () => {
            if (datepicker.value) {
                datepicker.value.update('minDate', minDate.value)
            }
        });

        watch(maxDate, () => {
            if (datepicker.value) {
                datepicker.value.update('maxDate', maxDate.value)
            }
        });

        onBeforeUnmount(() => {
            datepicker.value.destroy();
        })


        return {
            pickerEl,
            filled,
            displayLabel,
            locale,
            open,
            close,
        }
    }
}
</script>

<style scoped>

</style>
