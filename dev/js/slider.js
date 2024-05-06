document.addEventListener("DOMContentLoaded", function(){
    // Sliders Options
    swiperSlider('.caseSlider', {
        autoplay: true,
        speed: 500,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        centeredSlides: true,
        paginationClickable: true,
        watchSlidesProgress: true,
        loop: true,
        slidesPerView: 2,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    swiperSlider('.logoCarousel', {
        spaceBetween: 40,
        grabCursor: true,
        a11y: false,
        freeMode: true,
        speed: 7000,
        loop: true,
        slidesPerView: "auto",
        autoplay: {
            delay: 0.5,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                spaceBetween: 30,
            },
            480: {
                spaceBetween: 30,
            },
            767: {
                spaceBetween: 40,
            },
            992: {
                spaceBetween: 40,
            }
        },
    });


    swiperSlider('.zoneSlider', {
        autoplay: true,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    function swiperSlider(item, options = {}) {
        const isItem = selector(item)

        if (isItem) {
            const slider = new Swiper(item, options)
        }
    }
})
