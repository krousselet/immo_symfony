import Swiper from 'swiper/bundle';
document.addEventListener('DOMContentLoaded', function () {
    let roomSwiper = new Swiper('.room-swiper', {
        direction: 'horizontal',
        loop: true,
        effect: 'coverflow',
        pagination: {
            el: '.room-swiper .swiper-pagination',
            clickable: true
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        nested: false
    });

    // Initialize vertical swipers for each room's pictures
    document.querySelectorAll('.picture-swiper').forEach(function(pictureSwiperEl) {
        new Swiper(pictureSwiperEl, {
            direction: 'vertical',
            loop: true,
            effect: 'coverflow',
            pagination: {
                el: pictureSwiperEl.querySelector('.swiper-pagination'),
                clickable: true
            },
            nested: true
        });
    });
});
