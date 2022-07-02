import {useStore} from "vuex";
import {computed, ref, watch} from "vue";

export default () => {
    const store = useStore();
    const formRef = ref(null);
    const searchRef = ref(null);
    const request = computed(() => store.state.headerSearch.request);
    const voiceSupport = computed(() => store.getters['headerSearch/voiceSupport']);
    const recording = computed({
        get: () => store.state.headerSearch.recording,
        set: (val) => store.commit('headerSearch/SET_RECORDING', val)
    });
    const active = computed({
        get: () => store.state.headerSearch.active,
        set: (val) => store.commit('headerSearch/SET_ACTIVE', val)
    });
    const mobileActive = computed({
        get: () => store.state.headerSearch.mobileActive,
        set: (val) => store.commit('headerSearch/SET_MOBILE_ACTIVE', val)
    });
    const searchText = computed({
        get: () => store.state.headerSearch.searchText,
        set: (val) => store.commit('headerSearch/SET_SEARCH_TEXT', val)
    });
    const tours = computed(() => store.state.headerSearch.tours);
    const places = computed(() => store.state.headerSearch.places);


    function createDebounce() {
        let timeout = null;
        return function (fnc, delayMs) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fnc();
            }, delayMs || 500);
        };
    }

    const search = async () => {
        await store.dispatch('headerSearch/search');
    }

    const openVoiceSearch = () => {
        searchText.value = '';
        store.commit('headerSearch/SET_POPUP_OPEN', true);
        store.dispatch('headerSearch/startVoice');
    }

    const submit = async () => {
        if (searchText.value.length > 2) {
            formRef.value.submit();
        }
    }

    watch(recording, async (newValue, oldValue) => {
        if (newValue === false && oldValue === true) {
            store.commit('headerSearch/SET_POPUP_OPEN', false);
            await submit();
        }
    })

    const close = async () => {
        searchText.value = '';
        await search();
    }

    return {
        formRef,
        searchRef,
        active,
        mobileActive,
        searchText,
        voiceSupport,
        tours,
        places,
        debounce: createDebounce(),
        search,
        openVoiceSearch,
        submit,
        request,
        close,

    }
}
