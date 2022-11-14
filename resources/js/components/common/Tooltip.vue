<template>
    <span class="tooltip-wrap" :class="{ [variant]: true, active: active }" @click.stop="toggle()">
        <span ref="tooltip" class="tooltip text text-sm" :class="[`placement-${placement}`]">
            <slot />
        </span>
    </span>
</template>

<script>
import { onMounted, ref } from 'vue'

export default {
    name: 'Tooltip',
    props: {
        variant: {
            type: String,
            default: 'light',
        },
        placement: {
            type: String,
            default: 'center',
        },
    },
    setup() {
        const active = ref(false)
        const tooltip = ref(null)

        const toggle = () => {
            active.value = !active.value

            if (active.value) {
                let thumb = $(tooltip.value).parents('.thumb-info').first()

                if (thumb) {
                    let thumbOffset = $(thumb).offset()

                    $(tooltip.value).css({
                        width: $(thumb).width(),
                    })

                    $(tooltip.value).offset({ left: thumbOffset.left })

                    let offset = Math.abs(parseFloat($(tooltip.value).css('left'))) + 3

                    $('style#tooltip-style').remove()
                    $(
                        `<style id="tooltip-style">.tooltip-wrap.active .tooltip:before{left: calc(50% + ${offset}px)!important}</style>`,
                    ).appendTo('head')
                }
            }
        }

        return {
            active,
            toggle,
            tooltip,
        }
    },
}
</script>

<style scoped lang="scss">
.tooltip-wrap {
    margin-bottom: 0 !important;

    .tooltip {
        color: #fff !important;
        white-space: normal;

        &.placement-center {
            transform: scale(1) translateX(-50%) !important;
        }
    }
}
</style>
