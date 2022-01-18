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
        return tour.schedule_items.find(s => s.id === scheduleId.value);
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
        imageSrc.value = tour.main_image;
    })
    const currencyIso = computed(() => store.getters['currency/iso']);
    const currencyTitle = computed(() => store.getters['currency/title']);
    const currencyRate = computed(() => store.getters['currency/rate']);
    const currencyPrice = computed(() => {
        return currentSchedule.value ? (currentSchedule.value.price / currencyRate.value).toFixed(0) : (tour.price / currencyRate.value).toFixed(0);
    })
    const currencyCommission = computed(() => {
        return currentSchedule.value ? (currentSchedule.value.commission / currencyRate.value).toFixed(0) : (tour.commission / currencyRate.value).toFixed(0);
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
    }
}