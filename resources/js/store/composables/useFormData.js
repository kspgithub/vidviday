import {useStore} from "vuex";
import {computed} from "vue";

export const useFormData = (namespace) => {
    const store = useStore();
    return computed({
        get() {
            return store.state[namespace].formData
        },
        set(data) {
            store.commit(namespace + '/UPDATE_FORM_DATA', data);
        }
    });
}

export const useFormDataProperty = (namespace, property) => {
    const store = useStore();
    return computed({
        get() {
            return store.state[namespace].formData[property]
        },
        set(value) {
            store.commit(namespace + '/UPDATE_FORM_DATA', {[property]: value});
        }
    });
}

export const useDebounceFormDataProperty = (namespace, property, wait = 300) => {
    const store = useStore();
    return computed({
        get: () => store.state[namespace].formData[property],
        set: _.debounce(value => {
            store.commit(namespace + '/UPDATE_FORM_DATA', {[property]: value});
        }, wait)
    });
}
