<template>
    <label :data-tooltip="errorMessage"
           :class="{active: !!innerValue || focused, invalid: errorMessage, focused}"
    >
        <i v-if="label">{{ label }} <span v-if="required">*</span></i>

        <div class="phone-codes">

            <div class="dropdown">
                <span><div class="iti__flag iti__ua"></div> +380</span>
                <span class="dropdown-btn"></span>
                <ul class="dropdown-toggle" style="display: none;">
                    <li><a href="http://vidviday.test/profile?lang=ru">RU</a></li>
                    <li><a href="http://vidviday.test/profile?lang=en">EN</a></li>
                    <li><a href="http://vidviday.test/profile?lang=pl">PL</a></li>
                </ul>
                <div class="full-size"></div>
            </div>

        </div>
        <input ref="inputRef"
               v-model="innerValue"
               class="vue-input"
               @focus="onFocus"
               @blur="onBlur"
               :placeholder="placeholder"
               :autocomplete="autocomplete"
               :type="type"
               :name="name"
               :id="'input-' + (id || name)"
        >
        <slot/>
    </label>
</template>

<script>
import useFormField from "./composables/useFormField";
import { ref } from 'vue'

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

        return {
            ...field,
        }
    }
}
</script>
