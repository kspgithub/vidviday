import {ref, watch} from "vue";
import {useField} from "vee-validate";
import Inputmask from "inputmask";

const useFormField = (props, emit) => {
    const inputRef = ref(null);
    const focused = ref(false);

    const {value: innerValue, errorMessage} = useField(props.name, props.rules, {
        initialValue: props.modelValue,
        validateOnMount: false,
    });


    watch(innerValue, (val) => emit('update:modelValue', val));
    watch(() => props.modelValue, (val) => {
        if (innerValue.value !== val) {
            innerValue.value = val;
        }
    });

    const onFocus = () => {
        focused.value = true;
        if (props.mask && !inputRef.value.inputmask) {
            Inputmask(props.mask).mask(inputRef.value);
        }
    }
    const onBlur = () => {
        focused.value = false;
        if (props.mask && inputRef.value.inputmask) {
            inputRef.value.inputmask.remove();
        }
    }

    return {
        innerValue,
        inputRef,
        focused,
        onFocus,
        onBlur,
        errorMessage,
        ...useRequiredFormGroup(props)
    }
}

export const useRequiredFormGroup = (props) => {
    let rules = typeof (props.rules) === 'object' ? Object.keys(props.rules) : props.rules.split('|');
    const required = rules.indexOf('required') !== -1;
    return {
        required
    }
}

export default useFormField;
