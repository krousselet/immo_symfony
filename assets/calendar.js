import { Calendar } from "@fullcalendar/core";
import './swiper';
import 'swiper/css/bundle';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', initializeCalendar);
window.addEventListener('load', initializeCalendar);

// If using Turbo, add this event listener
document.addEventListener('turbo:load', initializeCalendar);

function initializeCalendar() {
    console.log('Initializing calendar...');
    let calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        let apartmentId = parseInt(calendarEl.getAttribute('data-apartment-id'), 10);
        if (!isNaN(apartmentId)) {
            fetchAndRenderCalendar(apartmentId);
        } else {
            console.error('Invalid apartment ID');
        }
    } else {
        console.log('No calendar element found');
    }
}

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
            return response.json(); // Parse the JSON from the response
        })
        .then(disponibilites => {
            console.log('Received disponibilites:', disponibilites);

            let calendarEl = document.getElementById('calendar');
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
