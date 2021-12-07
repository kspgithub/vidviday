<template>
    <div v-click-outside="close" :class="{open: open}" class="SumoSelect">
        <input :name="name" :value="modelValue" type="hidden">
        <p :title="current.text" class="CaptionCont SelectBox" @click="open = !open">
            <span>{{ current.text }}</span>
            <label><i></i></label>
        </p>
        <div class="optWrapper">
            <ul class="options">
                <li v-for="option in options"
                    :class="{selected: option.value === modelValue}"
                    class="opt"
                    @click="change(option)"><label>{{ option.value === 0 ? 'Не вибрано' : option.text }}</label>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
import {computed, ref} from "vue";

export default {
    name: "FormSelect",
    props: {
        name: String,
        modelValue: null,
        options: Array,
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {

        const open = ref(false);

        const current = computed(() => {
            const option = props.options.find(o => o.value === props.modelValue);
            return option || props.options[0];
        })

        const change = (option) => {
            open.value = false;
            emit('update:modelValue', option.value)
        }

        const close = () => {
            open.value = false;
        }


        return {
            current,
            change,
            close,
            open,
        }
    }
}
</script>

<style scoped>

</style>
