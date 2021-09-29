<template>
    <slide-up-down :model-value="show">
        <div class="radio-additional-tabs">
            <div class="radio-additional-tab active">
                <div class="spacer-xs"></div>
                <h2 class="h3 m10">Додаткові дані</h2>
                <span class="text">
                    Бажаєте заповнити додаткову інформацію?
                    <tooltip>Заповнення додаткової інформації<br>пришвидшить опрацювання Вашого замовлення</tooltip>
                </span>
                <div class="spacer-xs"></div>

                <form-radio name="additional" v-model="additional" :value="1" label="Так"/>
                <form-radio name="additional" v-model="additional" :value="0"
                            label="Пропустити і перейти до підтвердження замовлення"/>
            </div>

            <div class="radio-additional-tab"></div>
        </div>
    </slide-up-down>
</template>

<script>
import FormRadio from "../form/FormRadio";
import SlideUpDown from "vue3-slide-up-down";
import {useStore} from "vuex";
import {computed} from "vue";
import Tooltip from "../common/Tooltip";

export default {
    name: "OrderAdditional",
    components: {Tooltip, FormRadio, SlideUpDown},
    props: {
        show: Boolean,
    },
    setup() {
        const store = useStore();
        const additional = computed({
            get: () => store.state.orderTour.additional,
            set: (val) => store.commit('orderTour/SET_ADDITIONAL', val)
        })

        return {
            additional,
        }
    }
}
</script>

<style scoped>

</style>
