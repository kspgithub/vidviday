<template>
    <div v-click-outside="close" :class="{open: open}" class="SumoSelect">
        <input :name="name" :value="modelValue" type="hidden">
        <p :title="selectedText" class="CaptionCont SelectBox" @click="open = !open">
            <span v-html="selectedText"></span>
            <label><i></i></label>
        </p>
        <div class="optWrapper">
            <ul class="options">
                <li v-if="search">
                    <input v-model="searchValue" ref="search" type="text">
                </li>
                <li v-if="multiple" class="opt" @click="selectAll()">
                    <label>Обрати все</label>
                </li>
                <li v-for="option in filteredOptions"
                    :class="{selected: selected.includes(option.value)}"
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
        multiple: false,
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {

        const open = ref(false);

        const searchValue = ref('');

        const selected = computed(() => {
            const value = new String(JSON.parse(JSON.stringify(props.modelValue)))
            return value.split(',').map(id => parseInt(id)).filter(id => id > 0);
        })

        const selectedText = computed(() => {
            let text = ''
            const value = new String(JSON.parse(JSON.stringify(props.modelValue)))
            const selected = value.split(',').map(id => parseInt(id)).filter(id => id > 0);
            let options = props.options.filter(o => selected.includes(o.value));

            if(!options.length) {
                options = [props.options[0]]
            }

            for(let option of options) {
                text += (text ? ',' : '') + option.text
            }

            return text
        })

        const change = (option) => {
            open.value = false;

            const value = String(JSON.parse(JSON.stringify(props.modelValue)))
            let val = value.split(',').filter(v => !!v)
            const index = val.indexOf(option.value.toString())

            if(option.value === 0) {
                val = []
            } else {
                if(index > -1) {
                    val.splice(index, 1)
                } else {
                    val.push(option.value)
                }
            }

            emit('update:modelValue', val.join(','))
        }

        const close = () => {
            open.value = false;
        }

        onMounted(() => {
            let vm = getCurrentInstance();
            if(props.search && vm.ctx.$refs && vm.ctx.$refs.search) {
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

        const selectAll = () => {
            close()

            let options = []
            for (let option of props.options) {
                if(option.value)
                    options.push(option.value)
            }

            emit('update:modelValue', options.join(','))
        }

        return {
            selected,
            selectedText,
            change,
            close,
            open,
            searchValue,
            filteredOptions,
            selectAll,
        }
    }
}
</script>

<style scoped>

</style>
