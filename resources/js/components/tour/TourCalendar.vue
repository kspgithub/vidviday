<template>
    <div class="calendar-wrapper">
        <div class="calendar-header-center" v-if="header">
            <span class="text-sm">10+ {{ t('places') }}</span>
            <span class="text-sm">2 — 10 {{ t('places') }}</span>
            <span class="text-sm">{{ t('noPlaces') }}</span>
            <span v-if="viewChange" class="text">{{ t('view') }}</span>
            <form-select v-if="viewChange" v-model="viewType" :options="viewTypes" class="view-change"/>
        </div>
        <full-calendar ref="calendarEl" :options="calendarOptions"/>
        <div class="calendar-footer-center" v-if="footer">
            <span class="text-sm">10+ {{ t('places') }}</span>
            <span class="text-sm">2 — 10 {{ t('places') }}</span>
            <span class="text-sm">{{ t('noPlaces') }}</span>
            <span v-if="viewChange" class="text">{{ t('view') }}</span>
            <form-select v-if="viewChange" v-model="viewType" :options="viewTypes" class="view-change"/>
        </div>
    </div>
</template>

<script>
import { computed, onMounted, onUnmounted, ref, watch } from "vue";
//import '@fullcalendar/core/vdom' // solves problem with Vite
import { Calendar } from '@fullcalendar/core';
import FullCalendar from '@fullcalendar/vue3/dist/FullCalendar'
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import FormSelect from "../form/FormSelect";
import { useI18nLocal } from "../../composables/useI18nLocal";

export default {
    name: "TourCalendar",
    components: {FormSelect, FullCalendar},
    props: {
        filter: Object,
        viewChange: {
            type: Boolean,
            default: true,
        },
        footer: {
            type: Boolean,
            default: true,
        },
        header: {
            type: Boolean,
            default: true,
        },
        initialView: {
            type: String,
            default: 'dayGridMonth'
        },
        url: {
            type: String,
            default: '/api/calendar/events',
        },
        events: {
            type: Array,
            default: undefined
        },

        options: {
            type: Object,
            default() {
                return {}
            }
        }
    },
    emits: ['event-click'],
    setup(props, {emit}) {
        const calendarEl = ref(null);
        const calendar = ref(null);

        const viewType = ref(props.initialView);

        const viewTypes = computed(() => {
            return [
                {value: 'dayGridMonth', text: t('month')},
                {value: 'dayGridDay', text: t('day')},
            ]
        });

        const {t, locale} = useI18nLocal({
            messages: {
                uk: {
                    today: 'Сьогодні',
                    month: 'Місяць',
                    week: 'Тиждень',
                    day: 'День',
                    list: 'Список',
                    places: 'місць',
                    noPlaces: 'Немає місць',
                    view: 'Вигляд',
                },
                ru: {
                    today: 'Сегодня',
                    month: 'Месяц',
                    week: 'Неделя',
                    day: 'День',
                    list: 'Список',
                    places: 'мест',
                    noPlaces: 'Нет мест',
                    view: 'Вид',
                },
                en: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    list: 'List',
                    places: 'places',
                    noPlaces: 'No places',
                    view: 'View',
                },
                pl: {
                    today: 'Dzisiaj',
                    month: 'Miesiąc',
                    week: 'Tydzień',
                    day: 'Dzień',
                    list: 'Lista',
                    places: 'miejsca',
                    noPlaces: 'Brak miejsc',
                    view: 'Widok',
                },
            }
        });

        const calendarOptions = ref(
            Object.assign({
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
                headerToolbar: props.header ? {
                    left: 'prev title next today',
                    center: '',
                    right: '',
                } : false,
                footerToolbar: props.footer ? {
                    left: 'prev title next today',
                    center: '',
                    right: '',
                } : false,
                titleFormat: function (value) {
                    var localeData = moment.localeData();
                    var format = localeData.longDateFormat('L')

                    if (viewType.value === 'dayGridDay') {
                        format = format.replace(localeData._longDateFormat.L, 'D MMMM YYYY');
                    } else {
                        format = format.replace(localeData._longDateFormat.L, 'MMMM YYYY');
                    }
                    var momentTime = moment(value.date);
                    return momentTime.format(format)
                },
                eventContent: function (info) {
                    return {html: `<div class="fc-event-title fc-sticky">${info.event.title}</div>`};
                },
                firstDay: 1,
                contentHeight: "auto",
                aspectRatio: 2,
                fixedWeekCount: false,
                navLinks: true,
                editable: false,
                buttonText: {
                    today: t('today'),
                    month: t('month'),
                    week: t('week'),
                    day: t('day'),
                    list: t('list')
                },
                initialView: viewType.value,
                locale: locale.value,
                events: props.events || {
                    url: props.url,
                    extraParams: props.filter
                },
                eventClick: (info) => {
                    console.log(info)
                    if (info.jsEvent && !$(info.jsEvent.target).is('.tooltip-wrap') && !$(info.jsEvent.target).is('.tooltip')) {

                        emit('event-click', {
                            id: parseInt(info.event.id),
                            title: info.event.title,
                            url: info.event.url,
                        });
                    }
                },
                navLinkDayClick: (date) => {
                    if (props.viewChange) {
                        viewType.value = 'dayGridDay'
                        calendar.value.changeView(viewType.value);
                        calendar.value.gotoDate(date);
                    }
                },
            }, props.options)
        );

        const scrollToEnd = () => {
            setTimeout(() => {
                let calendarWrapper = $('.calendar-wrapper > .fc')

                if (calendarWrapper.length) {
                    if (calendarWrapper.find('.fc-dayGridMonth-view').length) {
                        let width = calendarWrapper.find('.fc-view .fc-scrollgrid').width();
                        calendarWrapper.scrollLeft(width);
                    }
                }
            }, 0)
        }

        watch(viewType, () => {
            calendar.value = calendarEl.value.getApi();
            calendar.value.changeView(viewType.value);

            if (viewType.value === 'dayGridMonth') {
                scrollToEnd()
            }

        });

        watch(() => props.filter, _.debounce(function () {
            calendarOptions.value.events.extraParams = props.filter;
        }, 500));

        onMounted(() => {
            calendar.value = calendarEl.value.getApi();
            calendar.value.changeView(viewType.value);

            calendarOptions.value.events.extraParams = props.filter;

            scrollToEnd()
        })

        const onDateSelect = (date) => {

        }

        const handleScroll = (e) => {
            const scrollPosition = e.target.scrollLeft;
        }

        onMounted(() => {
            let calendarWrapper = $('.calendar-wrapper > .fc')

            if (calendarWrapper.length) {
                // calendarWrapper[0].addEventListener('scroll', handleScroll, false)
            }


        })

        return {
            t,
            viewTypes,
            viewType,
            calendarEl,
            calendarOptions,
        }
    }
}
</script>

<style scoped>

</style>
