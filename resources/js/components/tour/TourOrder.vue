<template>
    <form method="get" :action="action" @submit.prevent="orderTour">
        <input name="clear" :value="1" type="hidden">


        <div v-if="tour.order_enabled && !isMobile" class="thumb-price">
            <span class="text">{{ __('tours-section.price') }}<span>{{ currencyPrice }}</span><i>{{ currencyTitle }}</i></span>
            <span class="discount hidden-print" v-if="isTourAgent && commission > 0">
                {{ currencyCommission }} {{ currencyTitle }}
                <tooltip variant="red">{{ __('tours-section.commission') }}</tooltip>
            </span>
        </div>

        <div class="only-desktop hidden-print">
            <tour-rating :rating="parseFloat(tour.rating || tour.testimonials_avg_rating)"
                         :count="tour.testimonials_count"
                         :url="tour.url + '#reviews-accordion'"
                         force-count
            />

            <share-dropdown v-if="!corporate" :title="__('Share')+':'"/>

            <tour-like-btn v-if="!!user && !corporate" :tour-id="tour.id"/>
        </div>

        <div class="spacer-xs"></div>

        <div class="sidebar-item">
            <div class="single-datepicker" v-if="!corporate && nearestEvent">
                <input name="schedule" :value="schedule_id" type="hidden">

                <div class="datepicker-input datepicker-dropdown">
                     <span class="datepicker-placeholder" @click.stop="showCalendar()">
                        {{ selectedSchedule ? selectedSchedule.title : __('tours-section.date-title') }}
                    </span>
                </div>

            </div>
            <div v-if="tour.order_enabled" class="thumb-info">
                <span class="thumb-info-time text">
                    <span class="only-print">{{ __('Duration') }}: </span>
                    {{ tour.format_duration }}
                </span>
                <span class="thumb-info-people text" v-if="departureOptions.length > 0">
                    {{ places > 10 ? '10+' : (places < 2 ? '0' : '2-10') }}
                    <tooltip v-if="places < 2" variant="black">
                        {{ __('tours-section.empty-tooltip') }}
                    </tooltip>
                </span>
            </div>

            <div v-if="isMobile && tour.order_enabled" class="thumb-price">
                <span class="text">{{ __('tours-section.price') }}<span>{{ currencyPrice }}</span><i>{{
                        currencyTitle
                    }}</i></span>
                <span class="discount hidden-print" v-if="isTourAgent && commission > 0">
                    {{ currencyCommission }} {{ currencyTitle }}
                    <tooltip variant="red">{{ __('tours-section.commission') }}</tooltip>
                </span>
            </div>


            <template v-if="nearestEvent">

                <button v-bind="$buttons('tour.order', tour.id)" type="submit" class="btn type-1 btn-block hidden-print" v-if="!corporate" @click="tourOrder">
                    {{ __('tours-section.order-tour') }}
                </button>

                <span v-bind="$buttons('tour.order_one_click', tour.id)"
                      v-if="canOrderOneClick"
                      class="btn type-2 btn-block hidden-print"
                      @click="showPopup()"
                >{{ __('tours-section.order-one-click') }}</span>

            </template>

            <template v-if="!nearestEvent">
                <a v-bind="$buttons('tour.repeat', tour.id)" href="#tour-voting-form" class="btn type-1 btn-block only-mobile hidden-print">
                    {{ __('tours-section.repeat-tour') }}
                </a>
            </template>

            <a v-bind="$buttons('tour.order_corporate', tour.id)" :href="`/tour/${tour.id}/order`" class="btn type-2 btn-block  hidden-print" v-if="tour.order_enabled && corporate">
                {{ __('tours-section.order-corporate') }}
            </a>

        </div>
    </form>
</template>

<script>
import { computed, ref } from "vue";
import TourRating from "./TourRating";
import ShareDropdown from "../common/ShareDropdown";
import TourLikeBtn from "./TourLikeBtn";
import FormSelectEvent from "../form/FormSelectEvent";
import Tooltip from "../common/Tooltip";
import { useStore } from "vuex";
import { useFormDataProperty } from "../../store/composables/useFormData";
import * as urlUtils from '../../utils/url.js'

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

        const user = store.state.user.currentUser

        const query = urlUtils.parseQuery();

        const schedule_id = useFormDataProperty('orderTour', 'schedule_id');

        const schedules = computed(() => store.state.orderTour.schedules);
        const departureOptions = computed(() => store.getters['orderTour/departureOptions']('title'));

        if (query.schedule && schedules.value.length && schedules.value.find(s => s.id == query.schedule)) {
            schedule_id.value = query.schedule;
        } else if (props.nearestEvent > 0) {
            schedule_id.value = props.nearestEvent;
        }

        const selectedSchedule = computed(() => {
            return store.getters['orderTour/selectedSchedule'] || (schedules.value.length ? (query.schedule ? (schedules.value.find(s => s.id == query.schedule) || schedules.value[0]) : schedules.value[0]) : null)
        });

        if (selectedSchedule.value && selectedSchedule.value.id !== schedule_id.value) {
            schedule_id.value = selectedSchedule.value.id;
        }

        const price = computed(() => selectedSchedule.value ? selectedSchedule.value.price : props.tour.price);
        const accommPrice = computed(() => selectedSchedule.value ? selectedSchedule.value.accomm_price : props.tour.accomm_price);
        const commission = computed(() => selectedSchedule.value ? selectedSchedule.value.commission : props.tour.commission);
        const places = computed(() => selectedSchedule.value ? selectedSchedule.value.places_available : 0);

        const action = computed(() => {
            return `/tour/${props.tour.id}/order`;
        })

        const showPopup = () => {
            store.commit('orderTour/SET_POPUP_OPEN', true);
        }

        const showCalendar = () => {
            store.commit('orderTour/SET_CALENDAR_OPEN', true);

            setTimeout(() => {
                let calendarWrapper = $('.calendar-wrapper > .fc')

                if (calendarWrapper.length) {
                    if (calendarWrapper.find('.fc-dayGridMonth-view').length) {
                        let width = calendarWrapper.find('.fc-view-harness').width();
                        calendarWrapper.scrollLeft(width);
                    }
                }
            }, 0)
        }

        const isTourAgent = computed(() => store.getters['user/isTourAgent'])
        const currencyTitle = computed(() => store.getters['currency/title']);
        const currencyRate = computed(() => store.getters['currency/rate']);
        const currencyPrice = computed(() => {
            let sum = ((price.value || 0) / currencyRate.value);
            return Math.ceil(sum);
        })
        const currencyCommission = computed(() => {
            return Math.ceil(commission.value / currencyRate.value);
        })

        const currencyAccomm = computed(() => {
            return Math.ceil(accommPrice.value / currencyRate.value);
        })

        if (query.quick) {
            showPopup()
        }

        const onlyQuick = computed(() => {
            return canOrderOneClick.value && (
                selectedSchedule.value && (
                    selectedSchedule.value.places_available === 0 || (
                        selectedSchedule.value.places_available >= 2 &&
                        selectedSchedule.value.places_available <= 10
                    )
                )
            )
        })

        const orderTour = (event) => {
            if (onlyQuick.value) {
                event.preventDefault()

                showPopup()
            } else {
                event.target.submit()
            }
        }

        const isMobile = window.innerWidth <= 768

        const canOrderOneClick = computed(() => isTourAgent.value ? (
                places.value > 10
            ) : !props.corporate
        )

        const tourOrder = (e) => {
            if(!!store.state.isProd) {
                showPopup()
                e.preventDefault()
            }
        }

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
            showCalendar,
            orderTour,
            isMobile,
            user,
            canOrderOneClick,
            tourOrder,
        }
    }
}
</script>

<style scoped>

</style>
