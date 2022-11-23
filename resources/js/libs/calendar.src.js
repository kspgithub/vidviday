import { Calendar } from "@fullcalendar/core";

export function initCalendar() {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const filter = JSON.parse(calendarEl.dataset.filter || '{}');

        let calendar = new Calendar(calendarEl, {
            plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
            initialView: 'dayGridMonth',
            locale: 'uk',
            events: {
                url: '/api/calendar/events',
                extraParams: filter
            },
            headerToolbar: {
                left: 'prev title next today',
                center: '',
                right: '',

            },
            footerToolbar: {
                left: 'prev title next today',
                center: '',
                right: '',
            },
            firstDay: 1,
            contentHeight: "auto",
            aspectRatio: 2,
            fixedWeekCount: false,
            navLinks: true,
            editable: false,
            buttonText: {
                today:    'Сьогодні',
                month:    'Місяць',
                week:     'Тиждень',
                day:      'День',
                list:     'Список'
            },
            windowResize: function (view) {
                if ($(window).width() < 514) {
                    calendar.changeView('dayGridDay');
                } else {
                    calendar.changeView('dayGridMonth');
                }
            },

        });
        calendar.render();
        const viewSelects = document.querySelectorAll('.view-change');

        viewSelects.forEach(function (select) {
            select.addEventListener('sumo:change', function (evt) {
                const view = evt.target.value;
                calendar.changeView(view);
                viewSelects.forEach((el) => {
                    if (el !== select && el.sumo) {
                        el.sumo.selectItem(view);
                    }

                });
            });
        })
    }
}
