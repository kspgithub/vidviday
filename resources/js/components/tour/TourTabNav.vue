<template>
    <div class="tab-nav">
        <ul class="tab-toggle">
            <li :class="{active: viewType === 'gallery'}" class="tab-caption"
                @click.prevent.stop="setTab('gallery')">
                <svg fill="none" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8 1a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V1zM8 9a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V9zM0 9a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H1a1 1 0 01-1-1V9zM0 1a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H1a1 1 0 01-1-1V1z"/>
                </svg>
                <span>{{ __('tours-section.gallery') }}</span>
            </li>

            <li :class="{active: viewType === 'list'}" class="tab-caption only-desktop"
                @click.prevent.stop="setTab('list')">
                <svg fill="none" height="12" width="16" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4 1a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 1a1 1 0 112 0 1 1 0 01-2 0zM4 6a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 6a1 1 0 112 0 1 1 0 01-2 0zM4 11a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 11a1 1 0 112 0 1 1 0 01-2 0z"/>
                </svg>
                <span>{{ __('tours-section.list') }}</span>
            </li>

            <li :class="{active: viewType === 'calendar'}" class="tab-caption"
                @click.prevent.stop="setTab('calendar')">
                <svg fill="none" height="17" width="15" xmlns="http://www.w3.org/2000/svg">
                    <rect height="13.5" rx="1.25" stroke-width="1.5" width="13.5" x=".75" y="2.75"/>
                    <path
                        d="M3 8h2v2H3V8zM6.5 8h2v2h-2V8zM10 8h2v2h-2V8zM3 12h2v2H3v-2zM6.5 12h2v2h-2v-2zM10 12h2v2h-2v-2zM3.25 2.5a.75.75 0 001.5 0h-1.5zM4.75 1a.75.75 0 00-1.5 0h1.5zm5.5 1.5a.75.75 0 001.5 0h-1.5zm1.5-1.5a.75.75 0 00-1.5 0h1.5zM0 6.75h15v-1.5H0v1.5zM4.75 2.5V1h-1.5v1.5h1.5zm7 0V1h-1.5v1.5h1.5z"/>
                </svg>
                <span>{{ __('tours-section.calendar') }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
import {computed, onMounted} from "vue";
import {useStore} from "vuex";

export default {
    name: "TourTabNav",
    setup() {
        const queryParams = new URLSearchParams(window.location.search);
        const store = useStore();
        const viewType = computed({
            get() {
                return store.state.tourFilter.viewType;
            },
            set(value) {
                return store.commit('tourFilter/SET_VIEW_TYPE', value);
            }
        })

        const setTab = (tab) => {
            queryParams.set('tab', tab);
            history.replaceState(null, null, "?"+queryParams.toString());
            viewType.value = tab;
        };

        onMounted(() => {
            if(queryParams.get("tab") != null ) viewType.value = queryParams.get("tab");
        })

        return {
            viewType,
            setTab
        }
    }
}
</script>

<style scoped>

</style>
