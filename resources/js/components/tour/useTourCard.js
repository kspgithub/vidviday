import {useI18nLocal} from "../../composables/useI18nLocal";
import {useLocalizedProperty} from "../../composables/useLocalizedProperty";
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";


export const useTourCard = (tour) => {

    const store = useStore();

    const tourTitle = useLocalizedProperty(tour, 'title');
    const shortText = useLocalizedProperty(tour, 'short_text');

    const scheduleId = ref(tour.schedule_items.length > 0 ? tour.schedule_items[0].id : 0);

    const currentSchedule = computed(() => {
        return tour.schedule_items.find(s => s.id == scheduleId.value);
    });

    const imageSrc = ref('/img/preloader.png');

    const changeSchedule = (evt) => {
        //console.log(evt);
    }

    const toggleFavourite = async () => {
        await store.dispatch('user/toggleFavourite', tour.id);
    }

    const schedules = computed(() => {
        return tour.schedule_items.map((it) => {
            return {
                value: it.id,
                text: it.title,
            }
        })
    });

    const inFavourites = computed(() => store.getters['user/inFavourites'](tour.id));

    onMounted(() => {
        let windowWidth = document.body.clientWidth

        if(windowWidth > 575) {
            imageSrc.value = tour.main_image;
        } else {
            imageSrc.value = tour.mobile_image;
        }
    })

    const currencyIso = computed(() => store.getters['currency/iso']);
    const currencyTitle = computed(() => store.getters['currency/title']);
    const currencyRate = computed(() => store.getters['currency/rate']);
    const currencyPrice = computed(() => {
        return currentSchedule.value ? Math.ceil(currentSchedule.value.price / currencyRate.value) : Math.ceil(tour.price / currencyRate.value);
    })
    const currencyCommission = computed(() => {
        return currentSchedule.value ? Math.ceil(currentSchedule.value.commission / currencyRate.value) : Math.ceil(tour.commission / currencyRate.value);
    })
    const isTourAgent = computed(() => store.getters['user/isTourAgent']);

    const onlyQuick = computed(() => {
        return !!store.state.isProd;
        return currentSchedule.value && (currentSchedule.value.places_available === 0 || (currentSchedule.value.places_available >= 2 && currentSchedule.value.places_available <= 10))
    })

    const orderLink = computed(() => {
        let url

        if(onlyQuick.value) {
            url = tour.url + '?schedule='+scheduleId.value+'&quick=1'
        } else {
            url = '/tour/'+tour.id + '/order?clear=1&schedule='+scheduleId.value
        }

        return url
    })

    const voteLink = computed(() => {
        let url

        url = tour.url + '#tour-voting-form'

        return url
    })

    return {
        currencyTitle,
        currencyIso,
        currencyRate,
        currencyPrice,
        currencyCommission,
        tourTitle,
        shortText,
        scheduleId,
        currentSchedule,
        changeSchedule,
        toggleFavourite,
        schedules,
        imageSrc,
        inFavourites,
        isTourAgent,
        orderLink,
        voteLink,
    }
}
