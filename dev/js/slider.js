document.addEventListener("DOMContentLoaded", function(){
    // Sliders Options
    swiperSlider('.logoCarousel', {
        spaceBetween: 0,
        centeredSlides: true,
        speed: 5000,
        autoplay: {
            delay: 0,
        },
        loop: true,
        slidesPerView: 'auto',
        allowTouchMove: true,
        disableOnInteraction: true,
        breakpoints: {
            480: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 30
            },
            1280: {
                slidesPerView: 8,
                spaceBetween: 30
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
