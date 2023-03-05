<template>
    <div ref="accordionItem" class="accordion-inner">
        <div class="calendar-header-center">
            <span class="text-sm">10+ {{ __('tours-section.seats') }}</span>
            <span class="text-sm">2 — 10 {{ __('tours-section.seats') }}</span>
            <span class="text-sm">{{ __('tours-section.no-seats') }}</span>
        </div>
        <div class="schedule">
            <div class="schedule-header">
                <span class="text-sm">{{ __('tours-section.departure-return-dates') }}</span>
                <span class="text-sm">{{ __('tours-section.cost') }}</span>
            </div>

            <template v-for="(event, i) in allEvents">
                <div class="schedule-row" :class="[event.className, {'d-none': i >= 9}]">
                    <span class="text" v-html="event.title"></span>

                    <div>
                        <span class="text text-medium">{{ currencyPrice(event) }} {{ currencyTitle }}</span>
                        <span v-if="isTourAgent && (event.commission > 0)" class="discount hidden-print">
                            {{ currencyCommission(event) }} {{ currencyTitle }}

                            <span class="tooltip-wrap red">
                                <span class="tooltip text text-sm light">{{ __('tours-section.commission') }}</span>
                            </span>
                        </span>
                    </div>

                    <seo-button code="tour.order_schedule"
                                :is="'tour-order-schedule-button'"
                                :tour-id="tour.id"
                                :schedule-id="event.id"
                                class="btn type-1"
                    ></seo-button>

                </div>
            </template>

        </div>

        <template v-if="allEvents.length > 10">
            <div class="spacer-xs only-print"></div>
            <div class="text-center only-print">
                {{ __('tours-section.see-more-schedules') }}
            </div>
        </template>

        <template v-if="allEvents.length > 3">
            <div class="spacer-xs"></div>
            <div class="text-center">
                <seo-button code="tour.more_schedules" class="btn type-2 show-more-events">
                    {{ __('tours-section.show-more') }}
                </seo-button>
                <seo-button code="tour.hide_schedules" class="btn type-2 hide-more-events d-none">
                    {{ __('tours-section.hide-more') }}
                </seo-button>
            </div>
        </template>
    </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { useStore } from 'vuex'
import { fetchTourSchedules } from '../../services/tour-service'
import SeoButton from '../common/SeoButton.vue'

const props = defineProps({
    tour: {
        type: Object,
        default: () => null,
    },
    events: {
        type: Array,
        default: () => [],
    },
    eventKey: {
        type: Number,
        default: () => 0,
    },
})

const store = useStore()

const isTourAgent = computed(() => store.getters['user/isTourAgent'])

const allEvents = ref([...(props.events.length ? props.events : props.tour.schedule_items || [])])

const accordionItem = ref()

const stopWatching = watch(() => accordionItem.value?.classList || [], (classList) => {
    if (classList.contains('active')) {
        stopWatching()

        const params = {}

        fetchTourSchedules(props.tour?.id, params).then((data) => {
            // console.log('data', data)
            allEvents.value = [...data || []]
        })
    }
})

const currencyIso = computed(() => store.getters['currency/iso'])
const currencyTitle = computed(() => store.getters['currency/title'])
const currencyRate = computed(() => store.getters['currency/rate'])
const currencyPrice = computed(() => event => {
    return Math.ceil(event.price / currencyRate.value)
})
const currencyCommission = computed(() => event => {
    return Math.ceil(event.commission / currencyRate.value)
})
</script>
