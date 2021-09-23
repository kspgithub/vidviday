<template>
    <div>

        <slide-up-down :model-value="show" :duration="300">
            <span class="text text-medium title inline">Плануєте взяти дітей?</span>
            <form-checkbox name="children" v-model="children" label="Так"/>
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
            return discount && discount.age_limit ? `До ${discount.age_end} років` : 'До 6 років';
        })
        const older_title = computed(() => {
            const discount = childrenDiscounts.value.find(d => d.category === 'children_older');
            return discount && discount.age_limit ? `Від ${discount.age_start} до ${discount.age_end} років` : 'Від 6 до 12 років';
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
