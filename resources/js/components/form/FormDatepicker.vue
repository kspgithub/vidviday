<template>
    <div :class="{active: open, disabled: disabled, invalid: errorMessage}"
         class="datepicker-input vue-datepicker"
         ref="pickerRef" v-click-outside="onClickOutside"
    >
        <div class="datepicker-placeholder"
             :data-tooltip="errorMessage"
             @click="toggle()">{{ displayLabel }}
        </div>
        <div class="datepicker-toggle">
            <div ref="pickerEl" :class="{filled: filled, picked: filled}"></div>
        </div>
        <input autofocus ref="pickerInput" :name="name" :value="innerValue" type="text" class="dr" :class="{'d-none': !open}">
    </div>
</template>

<script>
import {computed, nextTick, onBeforeUnmount, onMounted, onUnmounted, ref, watch} from "vue";
import {useI18nLocal} from "../../composables/useI18nLocal";
import moment from "moment";
import useFormField from "./composables/useFormField";
import {useField} from "vee-validate";

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
            default: 'DD.MM.YYYY' // https://momentjs.com/docs/#/displaying/format/
        },
        valueFormat: {
            type: String,
            default: 'dd.mm.yyyy' // http://t1m0n.name/air-datepicker/docs/index-ru.html#sub-section-9
        },
        placeholder: {
            type: String,
            default: 'DD.MM.YYYY' // http://t1m0n.name/air-datepicker/docs/index-ru.html#sub-section-9
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

        const {errorMessage, value: innerValue} = useField(props.name, props.rules, {
            initialValue: props.modelValue
        });

        const pickerRef = ref(null);
        const pickerEl = ref(null);
        const pickerInput = ref(null);
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

        const clickOutside = (event) => {
            const $target = $(event.target);

            if (!$target.closest($(pickerRef.value)).length) {
                close(event);
            }
        }

        const manualChange = (event) => {
            let val

            if(event && event.target) {
                let $target = $(event.target);
                val = $target.val()
            } else {
                val = event
            }

            let date = moment(val, props.valueFormat.toUpperCase()).toDate()

            let d = date.getDate()
            let m = date.getMonth()
            let y = date.getFullYear()

            datepicker.value.date = date

            let dayCell = $('.datepicker--cell[data-date="' + d + '"][data-month="' + m + '"][data-year="' + y + '"]')

            if (dayCell.length) {
                dayCell.click()
            }

            if(event && event.target) {
                close(event)
            }
        }

        onMounted(() => {
            $(pickerEl.value).datepicker({
                constrainInput: true,
                inline: true,
                language: locale.value,
                dateFormat: props.valueFormat,
                startDate: startDate.value,
                minDate: minDate.value,
                maxDate: maxDate.value,
                onSelect: function (formattedDate, date, ins) {
                    open.value = false;
                    innerValue.value = formattedDate;
                    emit('update:modelValue', formattedDate);
                    emit('onSelect', {formattedDate, date, ins});
                },
            });

            $(pickerEl.value).datepicker('option', 'disabled', props.disabled);
            datepicker.value = $(pickerEl.value).datepicker().data('datepicker');

            $(pickerInput.value).inputmask({
                placeholder: props.placeholder,
                mask: "99.99.9999",
                clearMaskOnLostFocus: true,
                definitions: {
                    'x': {
                        validator: "[1-9]"
                    },
                    '9': {
                        validator: "[0-9]"
                    }
                }
            }).on('change', function (event){
                if(/^[\d]{2}\.[\d]{2}\.[\d]{4}$/.test(event.target.value)) {
                    manualChange(event.target.value)
                }
            });

            // document.addEventListener('click', clickOutside);
        });

        onUnmounted(() => {
            document.removeEventListener('click', clickOutside);
        })

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

        watch(() => props.disabled, (value) => {
            if (datepicker.value) {
                if (value) {
                    open.value = false;
                    $(pickerEl.value).datepicker('hide');
                }
                $(pickerEl.value).datepicker('option', 'disabled', value)
            }
        });

        onBeforeUnmount(() => {
            //document.removeEventListener('click', onDocumentClick);
            datepicker.value.destroy();
        })

        const onClickOutside = (event) => {
            if(open.value) {
                close(event)
            }
        }

        return {
            pickerRef,
            pickerEl,
            pickerInput,
            filled,
            displayLabel,
            locale,
            open,
            toggle,
            close,
            errorMessage,
            innerValue,
            manualChange,
            onClickOutside,
        }
    },
    watch: {
        open(val, old) {

        }
    }
}
</script>

<style scoped>

</style>
