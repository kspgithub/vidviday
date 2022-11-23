import { initCalendar } from './calendar.src';

function selectTourEvent(event)
{

    const input = document.getElementById('selected-event-id');
    if (input) {
        input.value = event.id;
    }
    const title = document.getElementById('selected-event-title');
    if (title) {
        title.innerText = event.title;
    }
}

window.selectTourEvent = selectTourEvent;

if(window.vm) {
    initCalendar()
} else {
    window.addEventListener("vueMounted", initCalendar);
}
