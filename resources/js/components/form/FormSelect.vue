<template>
    <div v-click-outside="close" :class="{open: open}" class="SumoSelect">
        <input :name="name" :value="modelValue" type="hidden">
        <p :title="current.text" class="CaptionCont SelectBox" @click="open = !open">
            <span>{{ current.text }}</span>
            <label><i></i></label>
        </p>
        <div class="optWrapper">
            <ul class="options">
                <li v-if="search">
                    <input v-model="searchValue" ref="search" type="text">
                </li>
                <li v-for="option in filteredOptions"
                    :class="{selected: option.value === modelValue}"
                    class="opt"
                    @click="change(option)"><label v-html="option.value === 0 ? 'Не вибрано' : option.text"></label>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
import {computed, getCurrentInstance, onMounted, ref, toRefs, watch} from "vue";

export default {
    name: "FormSelect",
    props: {
        name: String,
        modelValue: null,
        options: Array,
        search: false,
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {

        const open = ref(false);

        const searchValue = ref('');

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

        onMounted(() => {
            let vm = getCurrentInstance();
            if(props.search) {
                let searchInput = vm.ctx.$refs.search

                watch(open, (val) => {
                    if(val) {
                        setTimeout(() => {
                            searchInput.focus()
                        }, 300)
                    }
                })
            }
        })

        const filteredOptions = computed(() => {
            return props.options.filter((o, i) => i === 0 || o.text.toLowerCase().indexOf(searchValue.value.toLowerCase()) > -1)
        })

        return {
            current,
            change,
            close,
            open,
            searchValue,
            filteredOptions,
        }
    }
}
</script>

<style scoped>

</style>
