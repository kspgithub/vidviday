<template>
    <div class="only-pad-mobile">
        <div class="row short-distance">
            <div class="col-md-4 col-12 only-pad">
                <seo-button code="order.tour"
                            v-if="$isProd"
                            tag="span"
                            class="btn type-4 arrow-right text-left flex"
                            v-is="'popup-email-btn'"
                >
                    <img alt="placeholder light" src="/icon/placeholder-light.svg">
                    {{ __('tours-section.order-tour') }}
                </seo-button>
                <seo-button code="order.tour"
                            v-else
                            class="btn type-4 arrow-right text-left flex"
                            href="/order?clear=1"
                >
                    <img alt="placeholder light" src="/icon/placeholder-light.svg">
                    {{ __('tours-section.order-tour') }}
                </seo-button>
            </div>

            <div class="col-md-4 col-12 only-pad">
                <seo-button code="download.schedules"
                            class="btn type-5 arrow-right text-left flex"
                            download
                            href="/tour/download"
                >
                    <img alt="tours scedule dark" src="/icon/tours-scedule-dark.svg">
                    {{ __('sidebar-section.download-schedules') }}
                </seo-button>
            </div>

            <div class="col-md-4 col-12">
                <seo-button code="tour.search"
                            tag="span"
                            class="tour-selection-btn btn type-5 arrow-right text-left flex"
                >
                    <img alt="filter-dark" src="/icon/filter-dark.svg">
                    {{ __('sidebar-section.filter.tour-search') }}
                </seo-button>
            </div>
        </div>
        <div class="spacer-sm"></div>
    </div>
</template>

<script>
import SeoButton from '../common/SeoButton.vue'

export default {
    name: 'MobileBtnsBar',
    components: {SeoButton},
}
</script>

<style scoped>

</style>
