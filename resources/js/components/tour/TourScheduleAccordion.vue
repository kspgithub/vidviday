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

            <template v-for="event in allEvents">
                <div v-show="eventKey > 2" class="schedule-row" :class="[event.className]">
                    <span class="text" v-html="event.title"></span>

                    <div>
                        <span class="text text-medium">{{ event.price }} {{ event.currencyTitle }}</span>
                        <span v-if="isTourAgent && (event.commission > 0)" class="discount">
                            {{ event.commission }} {{ event.currencyTitle }}

                            <span class="tooltip-wrap red">
                                <span class="tooltip text text-sm light">{{ __('tours-section.commission') }}</span>
                            </span>
                        </span>
                    </div>

                    <component :is="'tour-order-schedule-button'"
                               :tour="tour"
                               :schedule="event"
                               class="btn type-1"/>

                </div>
            </template>

        </div>

        <template v-if="allEvents.length > 3">
            <div class="spacer-xs"></div>
            <div class="text-center">
                <span class="btn type-2 show-more-events">{{ __('tours-section.show-more') }}</span>
                <span class="btn type-2 hide-more-events d-none">{{ __('tours-section.hide-more') }}</span>
            </div>
        </template>
    </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { useStore } from "vuex";
import { fetchTourSchedules } from "../../services/tour-service";

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

const store = useStore();

const isTourAgent = computed(() => store.getters['user/isTourAgent']);

const allEvents = ref([...(props.events)])

const accordionItem = ref()

const stopWatching = watch(() => accordionItem.value?.classList || [], (classList) => {
    if(classList.contains('active')) {
        stopWatching()

        const params = {}

        fetchTourSchedules(props.tour?.id, params).then((data) => {
            console.log('data', data)
            allEvents.value = [...data||[]]
        })
    }
})
</script>
