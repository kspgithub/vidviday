<template>
    <div class="thumb-wrap row">
        <div class="col-lg-4 col-sm-6 col-12" v-for="tour in tours">
            <tour-card :tour="tour" like-btn/>
        </div>

        <div class="col-12" v-if="!request && tours.length === 0">
            <span class="text text-md">{{ __('tours-section.no-tours') }}</span>
        </div>
        <div class="col-12" v-if="currentPage < lastPage">
            <div class="spacer-xs"></div>
            <div class="text-center">
                <button id="b30" class="btn type-2" :disabled="request" @click.prevent="loadMore()">
                    {{ __('tours-section.show-more-12') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import TourCard from "../tour/TourCard";
import axios from "axios";

export default {
    name: "ProfileFavourites",
    components: {TourCard},
    setup() {
        const request = ref(false);
        const tours = ref([]);
        const currentPage = ref(1);
        const lastPage = ref(1);

        const loadTours = async (page = 1) => {
            request.value = true;
            const {data: response} = await axios.get('/profile/history?page=' + page);
            if (response) {
                tours.value = [...tours.value, ...response.data];
                currentPage.value = response.current_page;
                lastPage.value = response.last_page;
            }
            request.value = false;
        }

        const loadMore = async () => {
            await loadTours(currentPage.value + 1);
        }

        loadTours();

        return {
            request,
            tours,
            currentPage,
            lastPage,
            loadMore,
        }
    }
}
</script>

<style scoped>

</style>
