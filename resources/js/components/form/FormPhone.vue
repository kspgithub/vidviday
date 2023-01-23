<template>
    <label :data-tooltip="errorMessage" :class="{active: true || focused, invalid: errorMessage, focused}">

        <input type="hidden" :name="name" v-model="innerValue">

        <i v-if="label" class="phone-label">{{ label }} <span v-if="required">*</span></i>

        <div class="phone-codes">

            <div ref="dropdownRef" class="dropdown">
                <a class="dropdown-title">
                    <div v-if="country" class="d-inline-block" :class="'iti__flag iti__'+country?.iso.toLocaleLowerCase()"></div> {{ country?.phone_code }}
                </a>
                <span class="dropdown-btn"></span>
                <ul class="dropdown-toggle" style="display: none;">
                    <li v-for="c in countries" @click.prevent="selectCountry(c)" :class="{top: !!c.published}">
                        <a href="#">
                            <div class="d-inline-block" :class="'iti__flag iti__'+c.iso.toLocaleLowerCase()"></div> {{ c.phone_code }} ({{ c.title }})
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <input ref="inputRef"
               v-model="numberModel"
               class="vue-input phone-input"
               @focus="onFocus"
               @blur="onBlur"
               :placeholder="placeholder"
               :autocomplete="autocomplete"
               :type="type"
               :id="'input-' + (id || name)"
               :mask="getMask"
        >
        <slot/>
    </label>
</template>

<script>
import useFormField from "./composables/useFormField";
import { computed, onMounted, ref, watch } from 'vue'
import { useCountries } from "../../composables/useCountries";

export default {
    name: "FormPhone",
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
            default: "text",
            validator(value) {
                return [
                    "url",
                    "text",
                    "password",
                    "tel",
                    "search",
                    "number",
                    "email",
                ].includes(value);
            }
        },
        mask: {
            type: String,
            default: '',
        },
        rules: {
            type: [String, Object],
            default: ''
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const field = useFormField(props, emit);

        const dropdownRef = ref(null)

        const countries = useCountries()

        const rawPhone = computed(() => {
            return field.innerValue.value?.replaceAll(/[-_() ]/g, '')
        })

        const country = computed(() => {
            return countries.find(c => rawPhone.value?.startsWith(c.phone_code)) || countries[0]
        })

        const getMask = computed(() => country.value?.phone_mask || props.mask)

        const phoneCode = computed(() => country.value?.phone_code)

        const cleanPhone = computed(() => {
            return rawPhone.value?.replace(phoneCode.value, '')
        })

        const phoneNumber = computed(() => {
            const replace = country.value?.phone_code + (field.innerValue.value?.length > country.value?.phone_code?.length ? ' ' : '')
            return country.value?.phone_code ? field.innerValue.value?.replace(replace, '') : ''
        })

        const countryModel = computed({
            get: () => phoneCode.value,
            set: _.debounce(value => field.innerValue.value = value),
        })

        const numberModel = computed({
            get: () => phoneNumber.value,
            set: _.debounce(value => field.innerValue.value = (phoneCode.value?.length ? phoneCode.value+' ' : '') + value),
        })

        watch(() => country.value, (value) => {
            Inputmask(value.phone_mask).mask(field.inputRef.value);
        })

        onMounted(() => {
            Inputmask(getMask.value).mask(field.inputRef.value);
        })

        const selectCountry = (country) => {
            countryModel.value = country.phone_code

            $(dropdownRef.value).find('.dropdown-title').click()
        }

        return {
            ...field,
            countries,
            country,
            rawPhone,
            phoneCode,
            cleanPhone,
            phoneNumber,
            countryModel,
            numberModel,
            dropdownRef,
            getMask,
            selectCountry,
        }
    }
}
</script>

<style lang="scss">
.phone-codes {
    position: absolute;
    top: 0;
    bottom: 0;
    display: flex;
    width: 100%;

    * {
        font-size: 14px;
    }

    & + input {
        padding-left: 90px;
    }

    .dropdown {
        display: flex;
        width: 100%;
        z-index: 3;

        .dropdown-title {
            display: flex;
            align-items: center;
            padding-left: 10px;
            width: 78px;
            z-index: 4;

            .iti__flag {
                margin-right: 7px;
            }
        }

        .dropdown-btn {
            left: 78px;
            z-index: 4;
        }

        .dropdown-toggle {
            left: 0;
            width: 100%;
            height: 300px;
            overflow: auto;

            li.top + li:not(.top) {
                padding-top: 10px;
                border-top: 1px solid #ddd;
            }
        }
    }
}

.phone-input {
    position: relative;
}

i.phone-label {
    z-index: 3;
}
</style>
