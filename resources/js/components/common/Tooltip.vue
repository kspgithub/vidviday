<template>
<span class="tooltip-wrap" :class="{[variant]: true, active: active}"
      @click.stop="toggle()"
>
    <span class="tooltip text text-sm">
        <slot/>
    </span>
</span>
</template>

<script>
import {ref} from "vue";

export default {
    name: "Tooltip",
    props: {
        variant: {
            type: String,
            default: 'light'
        }
    },
    setup() {
        const active = ref(false);

        const toggle = () => {
            active.value = !active.value;
        }
        return {
            active,
            toggle,
        };
    }

}
</script>

<style scoped>

</style>
