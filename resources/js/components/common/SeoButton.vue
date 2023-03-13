<template>
    <component :is="getTag" v-bind="buttonAttrs" v-on="buttonEvents">
        <slot />
    </component>
</template>

<script>
import { computed, ref } from 'vue'

export default {
    emits: ['click'],
    props: {
        tag: {
            type: String,
            required: false,
        },
        code: {
            type: String,
            required: true,
        },
        id: {
            type: [String, Number],
            required: false,
        },
    },
    setup(props, {attrs, emit}) {
        const config = ref(window.$buttons(props.code))

        config.value = window.$buttons(props.code, props.id)

        const buttonAttrs = computed(() => ({
            ...attrs,
            ...config.value,
            ...{
                id: config.value.id || props.code
            }
        }))

        const getTag = computed(() => props.tag || (attrs.href ? 'a' : 'button'))

        const buttonEvents = computed(() => ({
            click: (e) => {
                // e.preventDefault()
                emit('click', e)
                console.log(`Event:SeoButton[${buttonAttrs.value.id}]:click`)
            },
        }))

        return {
            config,
            buttonAttrs,
            buttonEvents,
            getTag,
        }
    }
}
</script>
