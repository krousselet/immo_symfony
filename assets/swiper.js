import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
// import 'swiper/swiper-bundle.min.css';
import {Navigation, Pagination} from "swiper/modules";

document.addEventListener('DOMContentLoaded', function () {
    // Initialize the main swiper for apartments
    const mainSwiper = new Swiper('.main-swiper', {
        loop: true,
        effect: 'coverflow',
        scrollable: true,
        centeredSlides: true,
        coverflow: {
            rotate: 20,
            stretch: 0,
            depth: 200,
            modifier: 1,
            slideShadows: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.main-swiper > .swiper-pagination',
            clickable: true,
        },
    });

    // Initialize swipers for rooms within each apartment
    document.querySelectorAll('.room-swiper').forEach(swiperElement => {
        const roomSwiper = new Swiper(swiperElement, {
            loop: true,
            pagination: {
                el: swiperElement.querySelector('.swiper-pagination'),
                clickable: true,
                scrollable: true,
            },
        });

        // Initialize swipers for images within each room
        const imageSwiperElement = swiperElement.querySelector('.room-images');
        new Swiper(imageSwiperElement, {
            loop: true,
            pagination: {
                el: imageSwiperElement.querySelector('.swiper-pagination'),
                clickable: true,
            },
        });
    });
});