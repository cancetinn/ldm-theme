document.addEventListener("DOMContentLoaded", function(){
    // Sliders Options
    swiperSlider('.logo-slider', {
        slidesPerView: 2,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        spaceBetween: 30,
        breakpoints: {
            480: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            992: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 5
            }
        }
    });

    function swiperSlider(item, options = {}) {
        const isItem = selector(item)

        if (isItem) {
            const slider = new Swiper(item, options)
        }
    }
})
