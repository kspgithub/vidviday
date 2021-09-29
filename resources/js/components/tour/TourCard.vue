<template>
    <div class="thumb">
        <div class="thumb-img">
            <tour-badge v-for="(badge, idx) in tour.badges"
                        :key="'badge-'+tour.id + '-' + badge.id"
                        :badge="badge"
                        :idx="idx"/>

            <img :alt="tourTitle" :src="imageSrc">
            <a :href="tour.url" class="full-size"></a>
        </div>

        <div class="thumb-content">
            <div class="title h3">
                <a :href="tour.url">{{ tourTitle }}</a>
            </div>
            <tour-rating :count="tour.testimonials_count" :rating="tour.rating"/>


            <div class="datepicker-input">
                <form-select v-model="scheduleId" :options="schedules"></form-select>
            </div>
            <div class="thumb-info">
                <span class="thumb-info-time text">
                    {{ tour.duration + t('days') }} / {{ tour.nights + t('nights') }}
                </span>
                <span class="thumb-info-people text">
                    {{ currentSchedule.places > 10 ? '10+' : currentSchedule.places }}
                    <tooltip v-if="!currentSchedule || currentSchedule.places === 0" variant="black">
                        На обрану Вами дату немає вільних місць ви можете замовити тур
                        і якщо місця з'являться, ми повідомимо Вас про це.
                    </tooltip>
                </span>

            </div>
            <div v-if="currentSchedule" class="thumb-price">
                <span class="text">
                    Ціна:<span>{{ currentSchedule ? currentSchedule.price : tour.price }}</span><i>грн</i>
                </span>
                <span v-if="currentSchedule.commission > 0" class="discount">
                    {{ currentSchedule.commission }} грн.
                    <span class="tooltip-wrap red">
                        <span class="tooltip text text-sm light">{{ t("commission") }}</span>
                    </span>
                </span>
            </div>

            <a :href="'/tour/'+tour.id + '/order?schedule='+scheduleId" class="btn type-1 btn-block">
                {{ t("order") }}
            </a>
        </div>

        <div class="thumb-desc text">
            <p>
                {{ shortText }}
                <a :href="tour.url" class="btn btn-read-more text-bold">{{ t("more") }}</a>
            </p>
        </div>
    </div>
</template>

<script>
import TourRating from "./TourRating";
import TourBadge from "./TourBadge";
import FormSelect from "../form/FormSelect";
import {useTourCard} from "./useTourCard";
import Tooltip from "../common/Tooltip";

export default {
    name: "TourCard",
    components: {Tooltip, FormSelect, TourBadge, TourRating},
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
