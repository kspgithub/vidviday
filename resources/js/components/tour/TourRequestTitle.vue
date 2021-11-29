<template>
    <div class="text text-lg">
        <p>
            {{ __('tours-section.found') }} <b class="text-bold">{{ totalTitle }}</b>
            <template v-if="requestTitle">&nbsp;
                {{ __('tours-section.on_request') }} <b class="text-bold">{{ requestTitle }}</b>
            </template>
        </p>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import {pluralizeValue} from "../../utils/string";
import {trans} from '../../i18n/lang';
export default {
    name: "TourRequestTitle",
    setup(props, {__}) {

        const store = useStore();

        const total = computed(() => store.state.tourFilter.pagination.total);
        const requestTitle = computed(() => store.state.tourFilter.requestTitle);
        const totalTitle = computed(() => {
            return pluralizeValue(total.value, trans('tours-section.one_tour'), trans('tours-section.two_tours'), trans('tours-section.many_tours'));
        });

        return {
            total,
            requestTitle,
            totalTitle,
        }
    }
}
</script>

<style scoped>

</style>
