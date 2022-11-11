<template>
    <div
        ref="componentRef"
        class="datepicker-input vue-datepicker"
        :class="{ invalid: errorFromMessage || errorToMessage, active: active }"
    >
        <span class="datepicker-placeholder" :data-tooltip="errorTooltip" @click="toggle()"
            >{{ placeholder }}<span v-if="required && !dirty">*</span></span
        >
        <div class="datepicker-toggle">
            <div ref="pickerRef"></div>
        </div>
        <input v-model="fromValue" type="hidden" :name="dateFromName" />
        <input v-model="toValue" type="hidden" :name="dateToName" />
    </div>
</template>

<script>
import { computed, nextTick, onMounted, ref } from 'vue'
import { useRequiredFormGroup } from './composables/useFormField'
import { useI18n } from 'vue-i18n'
import moment from 'moment'
import { useField } from 'vee-validate'

export default {
    name: 'FormDateRangePicker',
    props: {
        label: String,
        modelValue: Array,
        dateFromName: {
            type: String,
            default: 'start_date',
        },
        dateToName: {
            type: String,
            default: 'end_date',
        },
        dateFormat: {
            type: String,
            default: 'D, dd.mm.yyyy',
        },
        rules: {
            type: [String, Object],
            default: '',
        },
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const componentRef = ref(null)
        const pickerRef = ref(null)
        const { locale } = useI18n({ useScope: 'global' })
        const placeholder = ref(props.label)
        const dirty = ref(false)
        const active = ref(false)
        const { required } = useRequiredFormGroup(props)

        const { errorMessage: errorFromMessage, value: fromValue } = useField(props.dateFromName, props.rules)
        const { errorMessage: errorToMessage, value: toValue } = useField(props.dateToName, props.rules)

        const errorTooltip = computed(() => {
            return required ? "Це поле обов'язкове" : ''
        })
        const show = () => {
            const datepicker = $(pickerRef.value).datepicker().data('datepicker')
            active.value = true
            if (datepicker) {
                datepicker.show()
            }
        }

        const hide = () => {
            const datepicker = $(pickerRef.value).datepicker().data('datepicker')
            active.value = false
            if (datepicker) {
                datepicker.hide()
            }
        }

        const toggle = () => {
            if (!active.value) {
                show()
            } else {
                hide()
            }
        }

        onMounted(() => {
            $(pickerRef.value).datepicker({
                inline: true,
                range: true,
                language: locale.value,
                dateFormat: props.dateFormat,
                multipleDatesSeparator: ' - ',
                onSelect: function (formattedDate, date) {
                    let val = [null, null]
                    if (date.length > 1) {
                        val = [moment(date[0]).format('DD.MM.YYYY'), moment(date[1]).format('DD.MM.YYYY')]
                    } else if (date.length > 0) {
                        val = [moment(date[0]).format('DD.MM.YYYY'), null]
                    }
                    dirty.value = true
                    placeholder.value = formattedDate
                    fromValue.value = val[0]
                    toValue.value = val[1]
                    emit('update:modelValue', val)
                    if (date.length === 2) {
                        toggle()
                    }
                },
            })
        })

        return {
            componentRef,
            pickerRef,
            placeholder,
            dirty,
            errorFromMessage,
            errorToMessage,
            required,
            errorTooltip,
            fromValue,
            toValue,
            active,
            show,
            hide,
            toggle,
        }
    },
}
</script>

<style scoped></style>
