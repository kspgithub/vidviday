<template>

    <div class="item">
        <div class="thumb-img">
            <tour-badge v-for="(badge, idx) in tour.badges"
                        :key="'badge-'+tour.id + '-' + badge.id"
                        :badge="badge"
                        :idx="idx"/>

            <img :alt="tourTitle" :src="imageSrc">
            <a :href="tour.url" class="full-size"></a>
        </div>
        <div class="d-flex align-items-start item-cnt">
            <div class="thumb-content">
                <div class="title h4">
                    <a :href="tour.url">{{ tourTitle }}</a>
                </div>
                <tour-rating :count="tour.testimonials_count" :rating="tour.rating" class="d-none d-lg-block"/>
                <div class="text desc">
                    <p>
                        {{ shortText }}
                        <a :href="tour.url" class="btn btn-read-more text-bold">{{ __('tours-section.more') }}</a>
                    </p>
                </div>
            </div>
            <div class="thumb-content">
                <div class="datepicker-input d-none d-lg-block">
                    <form-select v-model="scheduleId" :options="schedules"></form-select>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <tour-rating :count="tour.testimonials_count" :rating="tour.rating" class="d-block d-lg-none"/>
                    <div class="thumb-info">
                <span class="thumb-info-time text">
                    {{
                        tour.duration + __('tours-section.days-letter')
                    }} / {{ tour.nights + __('tours-section.nights-letter') }}
                </span>
                        <span class="thumb-info-people text">
                    {{
                                currentSchedule && currentSchedule.places > 10 ? '10+' : (currentSchedule ? currentSchedule.places : 0)
                            }}
                    <tooltip v-if="!currentSchedule || currentSchedule.places === 0" variant="black">
                        {{ __('tours-section.empty-tooltip') }}
                    </tooltip>
                </span>

                    </div>
                </div>
                <div class="datepicker-input d-block d-lg-none">
                    <form-select v-model="scheduleId" :options="schedules"></form-select>
                </div>
                <div class="thumb-price">
                    <span class="text">
                         {{ __('tours-section.price') }}:
                        <span>{{ currentSchedule ? currentSchedule.price : tour.price }}</span>
                        <i>грн</i>
                    </span>
                    <span v-if="currentSchedule.commission > 0" class="discount">
                        {{ currentSchedule.commission }} {{ __('common.currency.uah-dot') }}

                        <tooltip class="red">{{ __('tours-section.commission') }}</tooltip>
                    </span>
                </div>
                <a :href="tour.url + '/order?schedule='+scheduleId"
                   class="btn type-1 btn-block">{{ __('tours-section.order-tour') }}</a>
            </div>
        </div>
    </div>

</template>

<script>
import TourBadge from "./TourBadge";
import TourRating from "./TourRating";
import {useTourCard} from "./useTourCard";
import FormSelect from "../form/FormSelect";
import Tooltip from "../common/Tooltip";

export default {
    name: "TourCardList",
    components: {Tooltip, FormSelect, TourRating, TourBadge},
    props: {
        tour: {
            type: Object,
            default() {
                return {
                    title: {uk: ''},
                    short_text: {uk: ''},
                    schedule_items: []
                }
            }
        },
    },
    setup({tour}) {
        return {
            ...useTourCard(tour),

        }
    }
}
</script>

<style scoped>

</style>
