<template>
    <form method="get" :action="action">
        <input name="clear" :value="1" type="hidden">

        <div class="thumb-price">
            <span class="text">{{ __('tours-section.price') }}<span>{{ currencyPrice }}</span><i>{{ currencyTitle }}</i></span>
            <span class="discount" v-if="isTourAgent && commission > 0">
                {{ currencyCommission }} {{ currencyTitle }}
                <tooltip variant="red">{{ __('tours-section.commission') }}</tooltip>
            </span>
        </div>

        <div class="only-desktop hidden-print">
            <tour-rating :rating="tour.rating" :count="tour.testimonials_count" force-count/>

            <share-dropdown v-if="!corporate" :title="__('Share')+':'"/>

            <tour-like-btn v-if="!corporate" :tour="tour"/>
        </div>

        <div class="spacer-xs"></div>

        <div class="sidebar-item">
            <div class="single-datepicker" v-if="!corporate">
                <input name="schedule" :value="schedule_id" type="hidden">

                <div class="datepicker-input datepicker-dropdown">
                     <span class="datepicker-placeholder" @click.stop="showCalendar()">
                        {{ selectedSchedule ? selectedSchedule.title : __('tours-section.date-title') }}
                    </span>
                </div>

            </div>
            <div class="thumb-info">
                <span class="thumb-info-time text">
                    {{ tour.format_duration }}
                </span>
                <span class="thumb-info-people text" v-if="departureOptions.length > 0">
                    {{ places > 10 ? '10+' : places }}
                    <tooltip v-if="places === 0" variant="black">
                        {{ __('tours-section.empty-tooltip') }}
                    </tooltip>
                </span>
            </div>

            <template v-if="nearestEvent">

                <button type="submit" class="btn type-1 btn-block hidden-print" v-if="!corporate">
                    {{ __('tours-section.order-tour') }}
                </button>
                <span class="btn type-2 btn-block hidden-print" @click="showPopup()"
                      v-if="!corporate">{{ __('tours-section.order-one-click') }}</span>

            </template>

            <template v-if="!nearestEvent">

            <span class="btn type-2 btn-block hidden-print"
                  @click="showVotingPopup()">{{ __('tours-section.vote-for-tour') }} ({{ tour.votings_count }})</span>
            </template>

            <a :href="`/tour/${tour.id}/order`" class="btn type-2 btn-block  hidden-print" v-if="corporate">
                {{ __('tours-section.order-corporate') }}
            </a>

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
        nearestEvent: {
            type: Number,
            default: 0,
        }
    },
    setup(props) {
        const store = useStore();

        console.log(props)

        const schedule_id = useFormDataProperty('orderTour', 'schedule_id');
        if (props.nearestEvent > 0) {
            schedule_id.value = props.nearestEvent;
        }

        const schedules = computed(() => store.state.orderTour.schedules);
        const departureOptions = computed(() => store.getters['orderTour/departureOptions']('title'));

        const selectedSchedule = computed(() => {
            return store.getters['orderTour/selectedSchedule'] || (schedules.value.length ? schedules.value[0] : null)
        });

        if (selectedSchedule.value && selectedSchedule.value.id !== schedule_id.value) {
            schedule_id.value = selectedSchedule.value.id;
        }

        const price = computed(() => selectedSchedule.value ? selectedSchedule.value.price : props.tour.price);
        const accommPrice = computed(() => selectedSchedule.value ? selectedSchedule.value.accomm_price : props.tour.accomm_price);
        const commission = computed(() => selectedSchedule.value ? selectedSchedule.value.commission : props.tour.commission);
        const places = computed(() => selectedSchedule.value ? selectedSchedule.value.places : 0);

        const action = computed(() => {
            return `/tour/${props.tour.id}/order`;
        })

        const showPopup = () => {
            store.commit('orderTour/SET_POPUP_OPEN', true);
        }

        const showVotingPopup = () => {
            store.commit('voteTour/SET_POPUP_OPEN', true);
        }

        const showCalendar = () => {
            store.commit('orderTour/SET_CALENDAR_OPEN', true);
        }

        const isTourAgent = computed(() => store.getters['user/isTourAgent'])
        const currencyTitle = computed(() => store.getters['currency/title']);
        const currencyRate = computed(() => store.getters['currency/rate']);
        const currencyPrice = computed(() => {
            let sum = ((price.value || 0) / currencyRate.value);
            return (sum).toFixed(0);
        })
        const currencyCommission = computed(() => {
            return (commission.value / currencyRate.value).toFixed(0);
        })

        const currencyAccomm = computed(() => {
            return (accommPrice.value / currencyRate.value).toFixed(0);
        })

        return {
            currencyTitle,
            currencyPrice,
            currencyCommission,
            schedule_id,
            departureOptions,
            selectedSchedule,
            price,
            accommPrice,
            currencyAccomm,
            isTourAgent,
            commission,
            places,
            action,
            showPopup,
            showVotingPopup,
            showCalendar,
        }
    }
}
</script>

<style scoped>

</style>
