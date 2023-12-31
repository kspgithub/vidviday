<template>
    <div id="tour-selection-dropdown" class="sidebar-item selection-tour notice">
        <div class="top-part">
            <div class="title h3 light title-icon"><img alt="filter" src="/icon/filter.svg">
                {{ __('sidebar-section.filter.tour-search') }}
            </div>
            <div class="btn-close light">
                <span></span>
            </div>
        </div>
        <div class="bottom-part">
            <form action="/">
                <form-double-picker
                    v-model:date-from="dateFrom"
                    v-model:date-to="dateTo"
                    :max-date="options.date_to"
                    :min-date="options.date_from"
                    :from-title="__('sidebar-section.filter.from-date')"
                    :to-title="__('sidebar-section.filter.to-date')"
                />

                <form-range v-model="duration"
                            :max="options.duration_to"
                            :min="options.duration_from"
                            :label="__('sidebar-section.filter.duration')"
                            name="duration"
                />


                <form-range v-model="price"
                            :max="options.price_to"
                            :min="options.price_from"
                            :step="Math.ceil(100 / currencyRate)"
                            :label="__('sidebar-section.filter.price', {currency: currencyTitle})"
                            name="price"
                />

                <form-select v-model="direction"
                             :options="options.directions"
                             name="direction"
                             :search="true"
                             :multiple="true"
                />

                <form-select-place v-model="place"
                             ref="placeSelectRef"
                             :options="places"
                             name="place"
                             :search="true"
                             :multiple="true"
                             @search="searchPlaces"
                />

                <form-select v-model="type"
                             :options="options.types"
                             name="type"
                             :search="true"
                             :multiple="true"
                />

                <form-select v-model="landing"
                             :options="options.landings"
                             name="landing"
                             :search="true"
                             :multiple="true"
                />

                <seo-button code="filter.clear" class="btn type-3" @click.prevent="clear()">{{ __('sidebar-section.filter.clear') }}</seo-button>
                <seo-button code="filter.search" class="btn type-1" @click.prevent="submit()">{{ __('sidebar-section.filter.search') }}</seo-button>
            </form>
        </div>
    </div>
</template>

<script>
import FormDoublePicker from "../form/FormDoublePicker";
import {useFormDataProperty} from "../../store/composables/useFormData";
import {useStore} from "vuex";
import {computed, nextTick, ref, watch} from 'vue'
import FormRange from "../form/FormRange";
import FormSelect from "../form/FormSelect";
import * as urlUtils from "../../utils/url";
import FormAutocomplete from '../form/FormAutocomplete.vue'
import {fetchPlaces} from '../../services/places-service'
import SeoButton from '../common/SeoButton.vue'
import FormSelectPlace from "../form/FormSelectPlace.vue";

export default {
    name: "SidebarFilter",
    components: {SeoButton, FormAutocomplete, FormSelect, FormRange, FormDoublePicker, FormSelectPlace},
    props: {
        options: {
            type: Object,
            default() {
                return {
                    date_from: "",
                    date_to: "",
                    duration_from: 0,
                    duration_to: 10,
                    price_from: 0,
                    price_to: 10000,
                    directions: [],
                    subjects: [],
                    types: [],
                    places: [],
                    landings: [],
                }
            }
        }
    },
    setup({options}) {
        const store = useStore();

        store.commit('tourFilter/SET_OPTIONS', options);

        watch(() => store.state.tourFilter.initialized, (value) => {
            store.dispatch('tourFilter/initFilter');
        })
        const dateFrom = useFormDataProperty('tourFilter', 'date_from');
        const dateTo = useFormDataProperty('tourFilter', 'date_to');
        const duration = useFormDataProperty('tourFilter', 'duration');
        const price = useFormDataProperty('tourFilter', 'price');
        const direction = useFormDataProperty('tourFilter', 'direction');
        const type = useFormDataProperty('tourFilter', 'type');
        const subject = useFormDataProperty('tourFilter', 'subject');
        const place = useFormDataProperty('tourFilter', 'place');
        const landing = useFormDataProperty('tourFilter', 'landing');


        const params = computed(() => store.getters['tourFilter/formData']);
        const defaultParams = computed(() => store.getters['tourFilter/defaultData']);

        // const submit = async () => {
        //     await store.dispatch('tourFilter/submit')
        // }
        const submit = async () => {
            const path = document.location.pathname;

            const query = urlUtils.filterParams(params.value, defaultParams.value);

            if (path === '/' || $('.error:contains(404)').length ) {
                document.location.href = urlUtils.makeUrl('/tours', query);
            } else {
                query.page = 1;
                urlUtils.updateUrl(path, query, true);
                await store.dispatch('tourFilter/fetchTours', query);
            }

            $('#tour-selection-dropdown .btn-close').click()
        }

        const clear = async () => {
            await store.dispatch('tourFilter/clearFilter');
            // await submit();
        }

        const places = ref(options.places);
        const placeSelectRef = ref(null)

        const searchPlaces = async (q) => {
            const items = await fetchPlaces({
                q,
                place: place.value,
            });
            places.value = [options.places[0]];

            if(items.results) {
                for (let i in items.results) {
                    places.value.push(items.results[i])
                }
            }

            await nextTick(() => {
                if (placeSelectRef.value) {
                    placeSelectRef.value.update(places.value);
                }
            })
        }

        const currencyTitle = computed(() => store.getters['currency/title']);
        const currencyRate = computed(() => store.getters['currency/rate']);

        return {
            dateFrom,
            dateTo,
            duration,
            price,
            direction,
            type,
            place,
            landing,
            subject,
            clear,
            submit,
            placeSelectRef,
            places,
            searchPlaces,
            currencyTitle,
            currencyRate,
        }
    }
}
</script>

<style scoped>

</style>
