<template>
    <form action="/tours" class="header-search" :class="{active: active}" ref="formRef">
        <input type="text" name="search" v-model="searchText" :placeholder="__('Find tour...')" class="input-search"
               @input="debounce(() => searchTours())"
               autocomplete="off">
        <div class="search-toggle">
            <ul>

                <li v-for="tour in tours" :key="'hst-'+tour.id">
                    <a :href="tour.url">
                        <span class="img">
                        <img :src="tour.main_image" :alt="tour.title">
                    </span>
                        <span class="text">{{ tour.title }}</span>
                    </a>
                </li>

            </ul>
            <div class="search-toggle-footer disabled" v-if="searchText.length >= 3 && !request && tours.length === 0">
                <span class="text">{{ __('Nothing found') }}</span>
            </div>
            <div class="search-toggle-footer disabled" v-if="request">
                <span class="text">{{ __('Search...') }}</span>
            </div>
            <div class="search-toggle-footer disabled" v-if="searchText.length < 3  && !request">
                <span class="text">{{ __('Enter a name for the tour') }}</span>
            </div>
            <div @click="submit()" class="search-toggle-footer" v-if="tours.length > 0  && !request">
                <span class="text">{{ __('All search results') }}</span>
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
        <div class="voice-search-btn only-desktop" @click="openVoiceSearch()">
            <svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 1c-.569 0-1.114.23-1.515.64-.402.41-.628.966-.628 1.546v5.828c0 .58.226 1.136.628 1.546.401.41.946.64 1.515.64.568 0 1.113-.23 1.515-.64.402-.41.628-.966.628-1.546V3.186c0-.58-.226-1.136-.628-1.546A2.122 2.122 0 006 1v0z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path
                    d="M11 7.522v1.47a5.228 5.228 0 01-1.464 3.642A4.928 4.928 0 016 14.142a4.928 4.928 0 01-3.536-1.508A5.228 5.228 0 011 8.993V7.522M6 14.571v2.01M3.143 17h5.714"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <span class="vertical-separator"></span>
        <div id="search-btn" class="full-size"></div>
        <div class="btn-close" @click="searchText = ''"><span></span></div>
    </form>
</template>

<script>
import {computed, ref} from "vue";
import {autocompleteTours} from "../../services/tour-service";
import {useStore} from "vuex";


export default {
    name: "HeaderSearch",
    setup() {
        const store = useStore();
        const formRef = ref(null);
        const request = computed(() => store.state.headerSearch.request);
        const active = computed(() => store.state.headerSearch.active);
        const searchText = computed({
            get: () => store.state.headerSearch.searchText,
            set: (val) => store.commit('headerSearch/SET_SEARCH_TEXT', val)
        });
        const tours = computed(() => store.state.headerSearch.tours);


        function createDebounce() {
            let timeout = null;
            return function (fnc, delayMs) {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    fnc();
                }, delayMs || 500);
            };
        }

        const searchTours = async () => {
            await store.dispatch('headerSearch/searchTours');
        }

        const openVoiceSearch = () => {
            store.commit('headerSearch/SET_POPUP_OPEN', true);
        }

        const submit = async () => {
            if (searchText.value.length > 2) {
                formRef.value.submit();
            }
        }

        return {
            formRef,
            active,
            searchText,
            tours,
            debounce: createDebounce(),
            searchTours,
            openVoiceSearch,
            submit,
            request,
        }
    }
}
</script>

<style scoped>

</style>
