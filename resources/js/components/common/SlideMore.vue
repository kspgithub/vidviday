<template>
    <div class="load-more-wrapp vue-load-more">
        <div class="show-more-btn" :class="{active: active}" @click.prevent="active = !active">
            <span class="h3">{{ visibleTitle }}</span>
        </div>
        <div class="text" v-if="subTitle">
            <p>{{ subTitle }}</p>
        </div>
        <div class="spacer-xs"></div>
        <slide-up-down v-model="active" :duration="300" class="more-info">
            <slot/>
        </slide-up-down>
    </div>
</template>

<script>
import {computed, ref, watch} from "vue";
import SlideUpDown from 'vue3-slide-up-down';

export default {
    name: "SlideMore",
    components: {SlideUpDown},
    props: {
        title: String,
        activeTitle: null,
        subTitle: null,
        open: {
            type: Boolean,
            default: false,
        }
    },
    setup(props) {
        const active = ref(props.open);
        watch(() => props.open, (val) => active.value = val);

        const visibleTitle = computed(() => {
            return active.value && props.activeTitle ? props.activeTitle : props.title;
        })

        return {
            active,
            visibleTitle,
        }
    }
}
</script>

<style scoped>

</style>
