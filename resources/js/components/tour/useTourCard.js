import {useI18nLocal} from "../../composables/useI18nLocal";
import {useLocalizedProperty} from "../../composables/useLocalizedProperty";
import {computed, onMounted, ref} from "vue";


export const useTourCard = (tour) => {
    const {t} = useI18nLocal({
        messages: {
            uk: {
                days: 'д',
                nights: 'н',
                peoples: '{count} людей',
                more: 'Більше',
                commission: 'Комісія агента',
                order: 'Замовити Тур',
                price: 'Ціна',
            },
            ru: {
                days: 'д',
                nights: 'н',
                peoples: '{count} человек',
                more: 'Больше',
                commission: 'Комиссия агента',
                order: 'Заказать Тур',
                price: 'Цена',
            },
            en: {
                days: 'd',
                nights: 'n',
                peoples: '{count} peoples',
                more: 'More',
                commission: 'Agent commission',
                order: 'Order Tour',
                price: 'Price',

            },
            pl: {
                days: 'd',
                nights: 'n',
                peoples: '{count} osób',
                more: 'Więcej',
                commission: 'Prowizja agenta',
                order: 'Zamów wycieczkę',
                price: 'Cena',
            },
        }
    })

    const tourTitle = useLocalizedProperty(tour, 'title');
    const shortText = useLocalizedProperty(tour, 'short_text');

    const scheduleId = ref(tour.schedule_items.length > 0 ? tour.schedule_items[0].id : 0);

    const currentSchedule = computed(() => {
        return tour.schedule_items.find(s => s.id === scheduleId.value);
    });

    const imageSrc = ref('/img/preloader.png');

    const changeSchedule = (evt) => {
        console.log(evt);
    }

    const schedules = computed(() => {
        return tour.schedule_items.map((it) => {
            return {
                value: it.id,
                text: it.title,
            }
        })
    });

    onMounted(() => {
        imageSrc.value = tour.main_image;
    })

    return {
        tourTitle,
        shortText,
        scheduleId,
        currentSchedule,
        changeSchedule,
        schedules,
        t,
        imageSrc,
    }
}
