<template>
    <div v-click-outside="close" :class="{open: open}" class="SumoSelect" @click.prevent="handleOpen">

        <input :name="name" :value="modelValue" type="hidden">

        <p :title="selectedText" class="CaptionCont SelectBox">
            <span v-html="selectedText"></span>
            <label><i></i></label>
        </p>

        <div class="optWrapper">
            <ul class="options">
                <li v-if="search">
                    <input v-model="searchValue" ref="search" type="text">
                </li>

                <li v-if="multiple && (selected.length !== (filteredOptions.length - 1))"
                    class="opt"
                    @click="selectAll()"
                >
                    <label class="checkbox" >
                        <input type="checkbox" :checked="selected.length === (filteredOptions.length - 1)">
                        <span>Обрати все</span>
                    </label>
                </li>

                <li v-if="multiple && (selected.length === (filteredOptions.length - 1))"
                    class="opt"
                    @click.prevent="change({value: 0}, $event)"
                >
                    <label class="checkbox" >
                        <input type="checkbox" :checked="selected.length === (filteredOptions.length - 1)">
                        <span>Обрати все</span>
                    </label>
                </li>

                <li v-for="option in filteredOptions"
                    v-show="(!option.value && selected.length) || option.value"
                    :class="{selected: multiple ? selected.includes(option.value) : (option.value === modelValue)}"
                    class="opt"
                    @click.prevent="change(option, $event)"
                >
                    <label v-if="multiple" class="checkbox" >
                        <input type="checkbox" :checked="selected.includes(option.value)">
                        <span v-html="option.value === 0 ? 'Не вибрано' : option.text" />
                    </label>

                    <label v-else v-html="option.value === 0 ? 'Не вибрано' : option.text"></label>

                </li>
            </ul>
        </div>
    </div>

</template>

<script>
import {computed, getCurrentInstance, onMounted, ref, watch} from "vue";

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
            const value = String(JSON.parse(JSON.stringify(props.modelValue)))
            return value.split(',').map(id => parseInt(id)).filter(id => id > 0);
        })

        const selectedText = computed(() => {
            let text = ''
            const value = String(JSON.parse(JSON.stringify(props.modelValue)))

            const selectedValue = value.split(',').map(id => parseInt(id)).filter(id => id > 0);

            let options = props.options.filter(o => props.multiple ? selectedValue.includes(o.value) : o.value === props.modelValue);

            if(!options.length) {
                options = [props.options[0]]
            }

            for(let option of options) {
                text += (text ? ',' : '') + option.text
            }

            return text
        })

        const change = (option, event) => {
            event.preventDefault()

            if(props.multiple) {
                const value = String(JSON.parse(JSON.stringify(props.modelValue)))

                let val = value.split(',').filter(v => !!v)
                const index = val.indexOf(option.value.toString())

                if(option.value === 0) {
                    setTimeout(() => close(), 100)
                    val = []
                } else {
                    if(index > -1) {
                        val.splice(index, 1)
                    } else {
                        val.push(option.value)
                    }
                }

                emit('update:modelValue', val.join(','))
            } else {
                setTimeout(() => close(), 100)
                const value = String(JSON.parse(JSON.stringify(option.value)))

                emit('update:modelValue', value)
            }
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

        const handleOpen = (e) => {
            console.log($(e.target).parents('.CaptionCont').length)
            console.log($(e.target).parents('.optWrapper').length)
            console.log($(e.target).parents('.SumoSelect').length)
            if(open.value) {
                if(
                    ($(e.target).is('.CaptionCont') || $(e.target).parents('.CaptionCont').length) ||
                    (!$(e.target).is('.optWrapper') && !$(e.target).parents('.optWrapper').length) ||
                    (!$(e.target).is('SumoSelect') && !$(e.target).parents('.SumoSelect').length)
                ) {
                    open.value = !open.value
                }
            } else {
                open.value = !open.value
            }
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
            handleOpen,
        }
    }
}
</script>

<style scoped>

</style>
