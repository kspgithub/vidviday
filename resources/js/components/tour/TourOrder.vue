<template>
    <form method="get" :action="action">
        <div class="thumb-price">
            <span class="text">Ціна:<span>{{ price }}</span><i>грн</i></span>
            <span class="discount" v-if="commission > 0">
                {{ commission }} грн.
                <tooltip variant="red">Комісія агента</tooltip>
            </span>
        </div>

        <div>
            <tour-rating :rating="tour.rating" :count="tour.testimonials_count" force-count/>

            <share-dropdown v-if="!corporate"/>

            <tour-like-btn v-if="!corporate"/>
        </div>

        <div class="spacer-xs"></div>

        <div class="sidebar-item">
            <div class="single-datepicker" v-if="!corporate">
                <input name="schedule" :value="schedule_id" type="hidden">
                <div class="datepicker-input datepicker-dropdown">
                     <span class="datepicker-placeholder" @click.stop="showCalendar()">
                        {{ selectedSchedule ? selectedSchedule.title : __('tour-section.date-title') }}
                    </span>
                </div>

            </div>
            <div class="thumb-info">
                <span class="thumb-info-time text">{{ tour.duration }}д / {{ tour.nights }}н</span>
                <span class="thumb-info-people text" v-if="departureOptions.length > 0">
                    {{ places > 10 ? '10+' : places }}
                    <tooltip v-if="places === 0" variant="black">
                        На обрану Вами дату немає вільних місць ви можете замовити тур
                        і якщо місця з'являться, ми повідомимо Вас про це.
                    </tooltip>
                </span>
            </div>
            <button type="submit" class="btn type-1 btn-block" v-if="!corporate">Замовити Тур</button>
            <span class="btn type-2 btn-block" @click="showPopup()" v-if="!corporate">Замовити в 1 клік</span>
            <a :href="`/tour/${tour.id}/order`" class="btn type-2 btn-block" v-if="corporate">Замовити корпоратив</a>
        </div>
    </form>
</template>

<script>
import {computed, ref} from "vue";
import TourRating from "./TourRating";
import ShareDropdown from "../common/ShareDropdown";
import TourLikeBtn from "./TourLikeBtn";
import FormSelectEvent from "../form/FormSelectEvent";
import Tooltip from "../common/Tooltip";
import {useStore} from "vuex";
import {useFormDataProperty} from "../../store/composables/useFormData";

export default {
    name: "TourOrder",
    components: {Tooltip, FormSelectEvent, TourLikeBtn, ShareDropdown, TourRating},
    props: {
        tour: Object,
        corporate: Boolean,
    },
    setup(props) {
        const store = useStore();

        const schedule_id = useFormDataProperty('orderTour', 'schedule_id');

        const schedules = computed(() => store.state.orderTour.schedules);
        const departureOptions = computed(() => store.getters['orderTour/departureOptions']('title'));

        const selectedSchedule = computed(() => {
            return store.getters['orderTour/selectedSchedule'] || (schedules.value.length ? schedules.value[0] : null)
        });

        if (selectedSchedule.value && selectedSchedule.value.id !== schedule_id.value) {
            schedule_id.value = selectedSchedule.value.id;
        }

        const price = computed(() => selectedSchedule.value ? selectedSchedule.value.price : props.tour.price);
        const commission = computed(() => selectedSchedule.value ? selectedSchedule.value.commission : props.tour.commission);
        const places = computed(() => selectedSchedule.value ? selectedSchedule.value.places : 0);

        const action = computed(() => {
            let url = `/tour/${props.tour.id}/order`
            return url;
        })

        const showPopup = () => {
            store.commit('orderTour/SET_POPUP_OPEN', true);
        }

        const showCalendar = () => {
            store.commit('orderTour/SET_CALENDAR_OPEN', true);
        }

        return {
            schedule_id,
            departureOptions,
            selectedSchedule,
            price,
            commission,
            places,
            action,
            showPopup,
            showCalendar,
        }
    }
}
</script>

<style scoped>

</style>
