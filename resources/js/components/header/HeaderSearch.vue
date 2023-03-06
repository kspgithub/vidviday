<template>
    <form action="/tours" class="header-search" :class="{active}" ref="formRef" @mouseleave="active = false">
        <input type="text"
               name="q"
               v-model="searchText"
               :placeholder="__('header-section.find-tour-dots')"
               class="input-search"
               ref="searchRef"
               @input="debounce(() => search())"
               autocomplete="off">

        <div class="search-toggle">
            <ul>
                <li v-for="place in places" :key="'hsp-'+place.id">
                    <a :href="place.url">
                        <span class="img">
                            <img :data-src="place.main_image" :alt="place.title">
                        </span>
                        <span class="text">{{ place.title }}</span>
                    </a>
                </li>
                <li v-for="tour in tours" :key="'hst-'+tour.id">
                    <a :href="tour.url">
                        <span class="img">
                        <img :data-src="tour.main_image" :alt="tour.title">
                    </span>
                        <span class="text">{{ tour.title }}</span>
                    </a>
                </li>

            </ul>
            <div class="search-toggle-footer disabled" v-if="searchText.length >= 3 && !request && tours.length === 0">
                <span class="text">{{ __('header-section.nothing-found') }}</span>

                <seo-button code="forms.send_feedback" v-if="popularToursUrl" :href="popularToursUrl" class="btn type-1 btn-block">{{ __('tours-section.popular-title') }}</seo-button>
            </div>
            <div class="search-toggle-footer disabled" v-if="request">
                <span class="text">{{ __('header-section.search-dots') }}</span>
            </div>
            <div class="search-toggle-footer disabled" v-if="searchText.length < 3  && !request">
                <span class="text">{{ __('header-section.enter-name-of-tour') }}</span>
            </div>
            <div @click="submit()" class="search-toggle-footer" v-if="tours.length > 0  && !request">
                <span class="text">{{ __('header-section.all-search-results') }}</span>
            </div>
        </div>
        <button type="submit" :disabled="searchText.length < 3">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18px" height="18px"
                 viewBox="0 0 18 18">
                <path
                    d="M8 2c3.308 0 6 2.692 6 6s-2.692 6-6 6-6-2.692-6-6 2.692-6 6-6m0-2C3.582 0 0 3.582 0 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8z"/>
                <path d="M14 12.999l-1 1 4 4 1-1-4-4z"/>
            </svg>
        </button>
        <div class="voice-search-btn only-desktop" @click="openVoiceSearch()" v-if="voiceSupport">
            <svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 1c-.569 0-1.114.23-1.515.64-.402.41-.628.966-.628 1.546v5.828c0 .58.226 1.136.628 1.546.401.41.946.64 1.515.64.568 0 1.113-.23 1.515-.64.402-.41.628-.966.628-1.546V3.186c0-.58-.226-1.136-.628-1.546A2.122 2.122 0 006 1v0z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path
                    d="M11 7.522v1.47a5.228 5.228 0 01-1.464 3.642A4.928 4.928 0 016 14.142a4.928 4.928 0 01-3.536-1.508A5.228 5.228 0 011 8.993V7.522M6 14.571v2.01M3.143 17h5.714"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <span class="vertical-separator" v-if="voiceSupport"></span>
        <div class="full-size" @click="mobileActive = true"></div>
        <div class="btn-close" @click="close()"><span></span></div>
    </form>
</template>

<script>
import useSearch from "./useSearch";
import SeoButton from '../common/SeoButton.vue'


export default {
    name: "HeaderSearch",
    components: {SeoButton},
    props: {
        popularToursUrl: String
    },
    setup() {
        return {
            ...useSearch()
        }
    }
}
</script>

<style scoped>

</style>
