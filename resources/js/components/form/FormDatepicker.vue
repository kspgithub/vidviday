<template>
    <div :class="{active: open, disabled: disabled, invalid: errorMessage}"
         class="datepicker-input vue-datepicker"
         v-click-outside="close"
    >
        <div class="datepicker-placeholder"
             :data-tooltip="errorMessage"
             @click="toggle()">{{ displayLabel }}
        </div>
        <div class="datepicker-toggle">
            <div ref="pickerEl" :class="{filled: filled, picked: filled}">
                <input :name="name" v-model="modelValue" type="hidden">
            </div>
        </div>
    </div>
</template>

<script>
import {computed, onBeforeUnmount, onMounted, onUnmounted, ref, watch} from "vue";
import {useI18nLocal} from "../../composables/useI18nLocal";
import moment from "moment";
import useFormField from "./composables/useFormField";

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
        disabled: {
            type: Boolean,
            default: false,
        },
        rules: {
            type: [String, Object],
            default: ''
        },
    },
    emits: ['update:modelValue', 'onSelect'],
    setup(props, {emit}) {
        const {locale} = useI18nLocal();
        const field = useFormField(props, emit);

        const pickerEl = ref(null);
        const datepicker = ref(null);
        const open = ref(false);

        const displayLabel = computed(() => {
            return !props.modelValue
                ? props.label
                : moment(props.modelValue, props.valueFormat.toUpperCase()).format(props.displayFormat);
        });


        const filled = computed(() => !!props.modelValue);

        const startDate = computed(() => props.modelValue ? moment(props.modelValue, props.valueFormat.toUpperCase()).toDate() : '');
        const minDate = computed(() => props.minDate ? moment(props.minDate, props.valueFormat.toUpperCase()).toDate() : '');
        const maxDate = computed(() => props.maxDate ? moment(props.maxDate, props.valueFormat.toUpperCase()).toDate() : '');

        const close = (event) => {
            event.stopPropagation();
            if (open.value) {
                open.value = false;
            }
        }

        const toggle = () => {
            if (props.disabled) return;
            open.value = !open.value;
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
            //document.removeEventListener('click', onDocumentClick);
            datepicker.value.destroy();
        })


        return {
            pickerEl,
            filled,
            displayLabel,
            locale,
            open,
            toggle,
            close,
            ...field,
        }
    }
}
</script>

<style scoped>

</style>
