<template>
    <div class="accordion-all-expand inner-not-expand">
        <div class="expand-all-button">
            <div class="expand-all open">Розгорнути все</div>
            <div class="expand-all close">Згорнути все</div>
        </div>
        <div class="accordion type-4 accordions-inner-wrap">
            <div v-for="country in countries" class="accordion-item">
                <div class="accordion-title" @click="loadRegions(country)">{{ country.text }}<i></i></div>

                <div class="accordion-inner">
                    <div class="accordion type-2">
                        <div v-for="region in getRegions(country)" class="accordion-item">
                            <div class="accordion-title" @click="loadDistricts(region)"
                                 v-html="region.text + '<i></i>'"></div>

                            <div class="accordion-inner">
                                <div class="accordion type-2" style="margin-left: 15px">
                                    <div v-for="district in getDistricts(region)" class="accordion-item">
                                        <div class="accordion-title" @click="loadPlaces(district)"
                                             v-html="district.text + '<i></i>'"></div>

                                        <div class="accordion-inner">
                                            <div class="accordion type-2" style="margin-left: 15px">
                                                <div v-for="place in getPlaces(district)" class="tickets text text-md">
                                                    <a :href="place.url" class="accordion-title">{{ place.text }}</a>
                                                    <!--                                                        <place-accordion-item :key="'place-'+place.id" :place="place"-->
                                                    <!--                                                                              :district="district"-->
                                                    <!--                                                                              @load-place="loadPlace"/>-->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="expand-all-button">
            <div class="expand-all open">Розгорнути все</div>
            <div class="expand-all close">Згорнути все</div>
        </div>
    </div>

</template>

<script>
import apiClient from "../../services/api";
import PlaceAccordionItem from "./PlaceAccordionItem";

export default {
    name: "PlacesAccordion",
    components: {PlaceAccordionItem},
    props: {
        countries: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            // countries: [],
            regions: {},
            districts: {},
            places: {},
        }
    },
    computed: {
        // getRegions() {
        //     return country => this.regions[country.value] || []
        // },
        // getDistricts() {
        //     return region => this.districts[region.value] || []
        // },
        // getPlaces() {
        //     return district => this.places[district.value] || []
        // },
    },
    methods: {
        getRegions(country) {
            return this.regions[country.value] || []
        },
        getDistricts(region) {
            return this.districts[region.value] || []
        },
        getPlaces(district) {
            return this.places[district.value] || [];
        },

        async loadRegions(country) {
            const response = await apiClient.get('/location/regions', {
                params: {country_id: country.value},
            }).catch(error => {
                console.error(error)
            })

            if (response) {
                this.regions[country.value] = response.data
            }
        },
        async loadDistricts(region) {
            const response = await apiClient.get('/location/districts', {
                params: {region_id: region.value},
            }).catch(error => {
                console.error(error)
            })

            if (response) {
                this.districts[region.value] = response.data
            }
        },
        async loadPlaces(district) {
            const response = await apiClient.get('/places/select-box', {
                params: {district_id: district.value, text: 'title', url: 1},
            }).catch(error => {
                console.error(error)
            })

            if (response) {
                this.places[district.value] = response.data.results
            }
        },
        async loadPlace({district, place}) {
            const response = await apiClient.get('/places/find', {
                params: {place_id: place.id},
            }).catch(error => {
                console.error(error)
            })

            if (response) {
                let index = this.places[district.value].indexOf(place)
                this.places[district.value][index] = {
                    ...response.data,
                    ...place,
                }
            }
        },
    }
}
</script>
