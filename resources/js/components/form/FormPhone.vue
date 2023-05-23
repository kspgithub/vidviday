<template>
    <label :data-tooltip="errorMessage" :class="{active: true || focused, invalid: errorMessage, focused}">

        <input type="hidden" :name="name" v-model="innerValue">

        <i v-if="label" class="phone-label">{{ label }} <span v-if="required">*</span></i>

        <input ref="inputRef"
               v-model="fullValue"
               class="vue-input phone-input"
               @focus="onFocus"
               @blur="onBlur"
               :placeholder="placeholder"
               :autocomplete="autocomplete"
               :type="type"
               :id="'input-' + (id || name)"
        >
        <slot/>
    </label>
</template>

<script>
import useFormField from './composables/useFormField'
import { computed, onMounted, ref, watch } from 'vue'
import { useCountries } from '../../composables/useCountries'
import intlTelInput from 'intl-tel-input'
import intlTelInputUtils from 'intl-tel-input/build/js/utils'
import {useField} from "vee-validate";

export default {
    name: 'FormPhone',
    props: {
        modelValue: null,
        name: {
            type: String,
            default: '',
        },
        label: {
            type: String,
            default: '',
        },
        placeholder: {
            type: String,
            default: '',
        },
        autocomplete: {
            type: String,
            default: 'off',
        },
        id: null,
        type: {
            type: String,
            default: 'text',
            validator(value) {
                return [
                    'url',
                    'text',
                    'password',
                    'tel',
                    'search',
                    'number',
                    'email',
                ].includes(value)
            },
        },
        mask: {
            type: String,
            default: '',
        },
        rules: {
            type: [String, Object],
            default: {},
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const field = useFormField(props, emit)

        const countries = useCountries()

        const intl = ref()

        onMounted(() => {
            intl.value = intlTelInput(field.inputRef.value, {
                autoHideDialCode: true,
                autoPlaceholder: 'polite',
                nationalMode: false,
                preferredCountries: countries,
                separateDialCode: true,
                formatOnDisplay: true,
                utilsScript: intlTelInputUtils,
            })

            const updateMask = () => {
                const countryData = intl.value.getSelectedCountryData()
                const placeholder = field.inputRef.value.placeholder
                const length = placeholder.replaceAll(/\D+/g, '').length
                const mask = placeholder.replace(/\d/g, '9')
                field.inputRef.value.mask = mask
                // Inputmask(mask).mask(field.inputRef.value);
                fullValue.value = fullValue.value?.substr(-length)
            }

            field.inputRef.value.addEventListener('countrychange', (e) => {
                const countryData = intl.value.getSelectedCountryData()
                field.innerValue.value = '+' + countryData.dialCode + fullValue.value
                updateMask()
            })

            updateMask()
        })

        const fullValue = computed({
            get() {
                if (intl.value) {
                    const countryData = intl.value.getSelectedCountryData()
                    const placeholder = field.inputRef.value.placeholder
                    const length = placeholder.replaceAll(/\D+/g, '').length
                    const regex = new RegExp('^' + countryData.dialCode + '(.*)$')
                    return field.innerValue.value?.replaceAll(/\D+/g, '').replace(regex, '$1').substr(-length)
                }

                return field.innerValue.value.substr(-length)
            },
            set(value) {
                if (intl.value) {
                    const countryData = intl.value.getSelectedCountryData()
                    const placeholder = field.inputRef.value.placeholder
                    const length = placeholder.replaceAll(/\D+/g, '').length
                    const regex = new RegExp('^' + countryData.dialCode + '(.*)$')
                    field.innerValue.value = '+' + countryData.dialCode + value.replace(regex, '$1').substr(-length)
                }
            },
        })

        return {
            ...field,
            fullValue,
            intl,
        }
    },
}
</script>

<style lang="scss">
i.phone-label {
    z-index: 1;
}

.iti--allow-dropdown {
    width: 100%;

    * {
        font-size: 14px;
    }

    .iti__country-list {
        max-width: 330px;
    }
}
</style>
