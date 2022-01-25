<template>
    <div>

        <slide-up-down :model-value="show" :duration="300">
            <span class="text text-medium title inline">{{ __('order-section.kids.question') }}</span>
            <form-checkbox name="children" v-model="children" :label=" __('forms.yes')"/>
            <div class="text">
                <p v-for="chDiscount in childrenDiscounts">{{ chDiscount.title['uk'] }}</p>
            </div>
        </slide-up-down>
        <div class="my-20"></div>
        <slide-up-down :model-value="show && children === 1" :duration="300">
            <form-number-input v-model="children_young" :min="0"
                               name="children_young"
                               :title="young_title"/>

            <form-number-input v-model="children_older" :min="0"
                               name="children_older"
                               :title="older_title"/>
        </slide-up-down>
    </div>
</template>

<script>
import SlideUpDown from "vue3-slide-up-down";
import FormCheckbox from "../form/FormCheckbox";
import FormNumberInput from "../form/FormNumberInput";
import {useStore} from "vuex";
import {useFormDataProperty} from "../../store/composables/useFormData";
import {computed} from "vue";
import {__} from "../../i18n/lang";

export default {
    name: "OrderKids",
    components: {FormNumberInput, FormCheckbox, SlideUpDown},
    props: {
        show: Boolean
    },
    setup() {
        const store = useStore();
        const childrenDiscounts = computed(() => store.getters['orderTour/childrenDiscounts']);
        const young_title = computed(() => {
            const discount = childrenDiscounts.value.find(d => d.category === 'children_young');
            return discount && discount.age_limit
                ? __('order-section.kids.up-count').replace(':up', discount.age_end)
                : __('order-section.kids.up-6');
        })
        const older_title = computed(() => {
            const discount = childrenDiscounts.value.find(d => d.category === 'children_older');
            return discount && discount.age_limit
                ? __('order-section.kids.from-to').replace(':from', discount.age_start).replace(':to', discount.age_end)
                : __('order-section.kids.from-6-to-12');
        })
        return {
            children: useFormDataProperty('orderTour', 'children'),
            children_young: useFormDataProperty('orderTour', 'children_young'),
            young_title,
            children_older: useFormDataProperty('orderTour', 'children_older'),
            older_title,
            childrenDiscounts,
        }
    }
}
</script>

<style scoped>

</style>
