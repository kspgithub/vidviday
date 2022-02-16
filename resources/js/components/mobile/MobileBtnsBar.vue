<template>
    <div class="only-pad-mobile">
        <div class="row short-distance">
            <div class="col-md-4 col-12 only-pad">
                <span class="btn type-4 arrow-right text-left flex">
                    <img alt="placeholder light" src="/icon/placeholder-light.svg">
                    {{ __('tours-section.order-tour') }}
                </span>
            </div>

            <div class="col-md-4 col-12 only-pad">
                <a class="btn type-5 arrow-right text-left flex" download
                   href="/documents/test-document.pdf"><img
                    alt="tours scedule dark"
                    src="/icon/tours-scedule-dark.svg">{{ __('sidebar-section.download-schedules') }}</a>
            </div>

            <div class="col-md-4 col-12">
                <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex">
                    <img alt="filter-dark"
                         src="/icon/filter-dark.svg">{{ __('sidebar-section.download-schedules') }}</span>
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
