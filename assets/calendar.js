import {Calendar} from "@fullcalendar/core";
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', function() {
    console.log('calendar.js is loaded'); // Logging to ensure script is loaded

    let calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        let apartmentId = calendarEl.getAttribute('data-apartment-id');

        fetchAndRenderCalendar(apartmentId);

        function fetchAndRenderCalendar(apartmentId) {
            fetch(`/api/availabilities/${apartmentId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    console.log('Response:', response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(disponibilites => {
                    console.log('Received disponibilites:', disponibilites);

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
                        events: disponibilites.map(disponibilite => ({
                            title: 'Disponible',
                            start: disponibilite.start,
                            end: disponibilite.end,
                        }))
                    });

                    calendar.render();
                })
                .catch(error => {
                    console.error('Error fetching availability data:', error);
                });
        }
    }
});

