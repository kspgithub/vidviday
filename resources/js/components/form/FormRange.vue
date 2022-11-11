<template>
    <div class="range">
        <label :for="name">{{ label }}</label>
        <input :id="name" :name="name" :value="modelValue.join(',')" type="hidden" />
        <div ref="rangeEl" class="slider-range vue-range"></div>
        <div class="text">
            <span
                >{{ __('sidebar-section.filter.from') }} <span class="range-min">{{ leftText }}</span></span
            >
            <span
                >{{ __('sidebar-section.filter.to') }} <span class="range-max">{{ rightText }}</span></span
            >
        </div>
    </div>
</template>

<script>
import { computed, onMounted, ref, watch } from 'vue'

export default {
    name: 'FormRange',
    props: {
        label: {
            type: String,
            default: 'Tривалість днів',
        },
        id: String,
        name: String,
        modelValue: {
            type: Array,
            default() {
                return []
            },
        },
        min: {
            type: Number,
            default: 0,
        },
        max: {
            type: Number,
            default: 100,
        },
        step: {
            type: Number,
            default: 1,
        },
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const slider = ref(null)
        const rangeEl = ref(null)
        const leftText = computed(() => props.modelValue[0] || props.min)
        const rightText = computed(() => props.modelValue[1]) || props.max

        onMounted(() => {
            $(rangeEl.value).slider({
                range: true,
                min: props.min,
                max: props.max,
                step: props.step,
                values: props.modelValue,
                slide: function (event, ui) {
                    emit('update:modelValue', ui.values)
                },
            })
            slider.value = $(rangeEl.value).slider('instance')
        })

        watch(
            () => props.modelValue,
            () => {
                if (slider.value) {
                    slider.value.values(props.modelValue)
                }
            },
        )

        return {
            rangeEl,
            leftText,
            rightText,
        }
    },
}
</script>

<style scoped></style>
