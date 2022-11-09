<template>
    <div ref="sumoSelectRef" v-click-outside="close" :class="{open: open}" class="SumoSelect" @click.prevent="handleOpen">

        <input :name="name" :value="modelValue" type="hidden">

        <p class="CaptionCont SelectBox">
            <span v-html="selectedText"></span>
            <label><i></i></label>
        </p>

        <div ref="optWrapperRef" class="optWrapper">
            <ul class="options">
                <li v-if="search">
                    <input v-model="searchValue" ref="search" type="text" @input="searchValue = $event.target.value">
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
                    :class="{selected: selected.includes(option.value) }"
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
import {computed, getCurrentInstance, onMounted, ref, toRaw, watch} from 'vue'

export default {
    name: "FormSelect",
    props: {
        name: String,
        modelValue: null,
        options: Array,
        search: false,
        multiple: false,
    },
    emits: ['update:modelValue', 'search'],
    setup(props, {emit}) {

        const sumoSelectRef = ref(null)

        const optWrapperRef = ref(null)

        const open = ref(false);

        const searchValue = ref('');

        const selected = computed(() => {
            const value = String(JSON.parse(JSON.stringify(props.modelValue)))
            return value.split(',').map(id => parseInt(id)).filter(id => id > 0);
        })

        const selectedText = computed(() => {
            let text = ''
            const value = String(JSON.parse(JSON.stringify(props.modelValue)))

            const selectedValue = value.split(',').filter(id => !!id);

            let options = props.options.filter(o => props.multiple ? selectedValue.includes(toRaw(o).value) : toRaw(o).value == props.modelValue);

            if(!options.length) {
                options = [props.options[0]]
            }

            for(let option of options) {
                text += (text ? ',' : '') + toRaw(option).text
            }

            return text
        })

        const change = (option, event) => {
            event.preventDefault()

            const opt = toRaw(option)

            if(props.multiple) {
                const value = String(JSON.parse(JSON.stringify(props.modelValue)))

                let val = value.split(',').filter(v => !!v)
                const index = val.indexOf(opt.value.toString())

                if(opt.value === 0) {
                    setTimeout(() => close(), 100)
                    val = []
                } else {
                    if(index > -1) {
                        val.splice(index, 1)
                    } else {
                        val.push(opt.value)
                    }
                }

                emit('update:modelValue', val.join(','))
            } else {
                setTimeout(() => close(), 100)
                const value = String(JSON.parse(JSON.stringify(opt.value)))

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

        const selectAllClicked = ref(false)

        const selectAll = () => {
            selectAllClicked.value = true

            close()

            let options = []
            for (let option of props.options) {
                if(option.value)
                    options.push(option.value)
            }

            emit('update:modelValue', options.join(','))
        }

        const handleOpen = (e) => {

            if(selectAllClicked.value) {
                selectAllClicked.value = false
            } else {

                if(!open.value) {
                    open.value = true
                } else {
                    // alert('El: ' + e.target.tagName + ' ' + e.target.className)

                    if(!optWrapperRef.value.contains(e.target) || optWrapperRef.value.isSameNode(e.target)) {
                        open.value = false
                    }
                }
            }
        }

        const update = (items) => {

            if($(sumoSelectRef.value)[0].sumo) {

                $(sumoSelectRef.value)[0].sumo.reload();

                $(sumoSelectRef.value).each(function () {
                    let option = $(this).closest('.SumoSelect').find('.opt');
                    let label = $(this).next('.CaptionCont');

                    $(label).find('span').css('margin', '-9px 0')

                    $(option).each(function () {
                        let img = $(this).closest('.SumoSelect').find('option').eq($(this).index()).data('img');

                        if (img && !$(this).find('img').length) {
                            $(this).prepend('<img src="' + img + '">');
                        }
                    });
                });
            }
        }

        watch(searchValue, _.debounce((q) => {
            emit('search', q)
        }, 300))

        return {
            sumoSelectRef,
            optWrapperRef,
            selected,
            selectedText,
            change,
            close,
            open,
            searchValue,
            filteredOptions,
            selectAll,
            handleOpen,
            update,
        }
    }
}
</script>
