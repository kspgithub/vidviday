<template>

    <div class="item">
        <div class="thumb-img">
            <tour-badge v-for="(badge, idx) in tour.badges"
                        :key="'badge-'+tour.id + '-' + badge.id"
                        :badge="badge"
                        :idx="idx"/>

            <img :alt="tourTitle" :src="imageSrc">
            <a :href="tour.url" class="full-size"></a>
            <a class="like" href="#" v-if="likeBtn" :class="{active: inFavourites}" @click.prevent="toggleFavourite()">
                <svg width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M12.079.888C11.464.296 10.616 0 9.532 0c-.3 0-.606.051-.918.154a3.73 3.73 0 00-.87.415c-.268.175-.5.338-.693.49a6.664 6.664 0 00-.551.488 6.678 6.678 0 00-.551-.487 9.296 9.296 0 00-.693-.49 3.736 3.736 0 00-.87-.416A2.927 2.927 0 003.467 0C2.384 0 1.536.296.92.888.307 1.48 0 2.301 0 3.352c0 .32.057.649.17.988.114.339.244.628.389.866.145.239.31.472.493.699.184.226.318.383.403.469.084.086.15.148.199.186l4.527 4.311A.437.437 0 006.5 11a.437.437 0 00.32-.129l4.519-4.297C12.446 5.481 13 4.407 13 3.351c0-1.05-.307-1.871-.921-2.463z"/>
                </svg>
            </a>
        </div>
        <div class="d-flex align-items-start item-cnt">
            <div class="thumb-content">
                <div class="title h4">
                    <a :href="tour.url">{{ tourTitle }}</a>
                    <tour-rating :count="tour.testimonials_count"
                                 :rating="parseFloat(tour.rating || tour.testimonials_avg_rating)"
                                 :url="tour.url + '#reviews-accordion'"
                                 class="d-block d-lg-block mt-20"
                                 force-count/>
                </div>
                <div class="text desc">
                    <p>
                        {{ shortText }}
                    </p>
                    <seo-button code="tour.show_more" :href="tour.url" class="btn btn-read-more text-bold">{{ __('tours-section.more') }}</seo-button>
                </div>
            </div>
            <div class="thumb-content">
                <div v-if="schedules.length" class="datepicker-input d-none d-lg-block">
                    <form-select v-model="scheduleId" :options="schedules"></form-select>
                </div>
                <div v-if="schedules.length" class="datepicker-input d-block d-lg-none">
                    <form-select v-model="scheduleId" :options="schedules"></form-select>
                </div>
                <div v-if="tour.order_enabled" class="d-flex align-items-center justify-content-between">
                    <div class="thumb-info ms-10">
                        <span class="thumb-info-time text">
                            {{ tour.format_duration }}
                        </span>
                        <span class="thumb-info-people text">
                            {{
                                currentSchedule?.places_available > 10 ? '10+' : (currentSchedule?.places_available < 2 ? '0' : '2-10')
                            }}
                            <tooltip v-if="!currentSchedule || currentSchedule.places_available < 2" variant="black">
                                {{ __('tours-section.empty-tooltip') }}
                            </tooltip>
                        </span>
                    </div>
                </div>
                <div v-if="tour.order_enabled" class="thumb-price">
                    <span class="text">
                        {{ __('tours-section.price') }}
                        <span>{{ currencyPrice }}</span>
                        <i>{{ currencyTitle }}</i>
                    </span>
                    <span v-if="isTourAgent && currentSchedule?.commission > 0" class="discount">
                        {{ currentSchedule?.commission }} {{ __('common.currency.uah-dot') }}

                        <tooltip class="red">{{ __('tours-section.commission') }}</tooltip>
                    </span>
                </div>

                <template v-if="currentSchedule">
                    <seo-button code="tour.order_schedule" :href="'/tour/'+tour.id + '/order?clear=1&schedule='+scheduleId"
                       class="btn type-1 btn-block">{{ __('tours-section.order-tour') }}</seo-button>
                </template>

                <template v-else>
                    <hr>
                    <div class="text text-center">{{ __('tours-section.want-to-vote') }} - <b>{{ tour.votings_count }}
                        {{ $lang().choice('tours-section.persons', tour.votings_count) }}</b></div>
                    <seo-button code="tour.vote" :href="voteLink" class="btn type-1 btn-block">
                        {{ __('tours-section.vote') }}
                    </seo-button>
                </template>
            </div>
        </div>
    </div>

</template>

<script>
import TourBadge from "./TourBadge";
import TourRating from "./TourRating";
import { useTourCard } from "./useTourCard";
import FormSelect from "../form/FormSelect";
import Tooltip from "../common/Tooltip";
import SeoButton from '../common/SeoButton.vue'

export default {
    name: "TourCardList",
    components: {SeoButton, Tooltip, FormSelect, TourRating, TourBadge},
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
        likeBtn: Boolean
    },
    setup({tour}) {
        return {
            ...useTourCard(tour),

        }
    }
}
</script>

<style scoped lang="scss">
.like {
    svg {
        height: 11px;
        width: 13px;
        line-height: 1;
        vertical-align: 3px;
    }
}
</style>
