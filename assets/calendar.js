import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');

    // Function to fetch availability data and render the calendar
    function fetchAndRenderCalendar() {
        fetch('/calendar')
            .then(response => response.json())
            .then(availabilities => {
                // Initialize the calendar with availability data
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
            })
            .catch(error => {
                console.error('Error fetching availability data:', error);
            });
    }

    // Initial fetch and render
    fetchAndRenderCalendar();

    // Refresh the calendar every 5 minutes
    setInterval(fetchAndRenderCalendar, 5 * 60 * 1000); // 5 minutes in milliseconds
});