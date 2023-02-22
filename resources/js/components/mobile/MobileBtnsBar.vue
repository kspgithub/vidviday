<template>
    <div class="only-pad-mobile">
        <div class="row short-distance">
            <div class="col-md-4 col-12 only-pad">
                <span v-bind="$buttons('order.tour')" v-if="$isProd" class="btn type-4 arrow-right text-left flex" v-is="'popup-email-btn'">
                    <img alt="placeholder light" src="/icon/placeholder-light.svg">
                    {{ __('tours-section.order-tour') }}
                </span>
                <a v-else v-bind="$buttons('order.tour')" class="btn type-4 arrow-right text-left flex" href="/order?clear=1">
                    <img alt="placeholder light" src="/icon/placeholder-light.svg">
                    {{ __('tours-section.order-tour') }}
                </a>
            </div>

            <div class="col-md-4 col-12 only-pad">
                <a v-bind="$buttons('download.schedules')" class="btn type-5 arrow-right text-left flex" download
                   href="/tour/download"><img
                    alt="tours scedule dark"
                    src="/icon/tours-scedule-dark.svg">{{ __('sidebar-section.download-schedules') }}</a>
            </div>

            <div class="col-md-4 col-12">
                <span v-bind="$buttons('tour.search')" id="tour-selection-btn" class="btn type-5 arrow-right text-left flex">
                    <img alt="filter-dark" src="/icon/filter-dark.svg">
                    {{ __('sidebar-section.filter.tour-search') }}
                </span>
            </div>
        </div>
        <div class="spacer-sm"></div>
    </div>
</template>

<script>
export default {
    name: "MobileBtnsBar"
}
</script>

<style scoped>

</style>
