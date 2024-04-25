document.addEventListener("DOMContentLoaded", function(){
    // Sliders Options
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
