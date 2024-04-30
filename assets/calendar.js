import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let availabilities = JSON.parse(calendarEl.dataset.availabilities);
    let calendar = new Calendar(calendarEl, {
        locales: [ frLocale ],
        locale: 'fr',
        plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek',
        },
        events: availabilities.map(availability => ({
            title: 'Disponible',
            start: availability.start,
            end: availability.end,

        }))
    });

    calendar.render();
});