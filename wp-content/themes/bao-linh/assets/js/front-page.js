document.addEventListener('DOMContentLoaded', function () {
    // 1. Cấu hình Hero Banner Slider (Tự động chuyển từ 5-8 giây)
    if (document.querySelector('.bl-hero-swiper')) {
        new Swiper('.bl-hero-swiper', {
            loop: true,
            autoplay: {
                delay: 6000, // Chuyển sau 6 giây
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            speed: 800,
        });
    }

    // 2. Cấu hình Brands Slider (Các hãng đối tác)
    if (document.querySelector('.bl-brands-swiper')) {
        new Swiper('.bl-brands-swiper', {
            slidesPerView: 2,
            spaceBetween: 15,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: { slidesPerView: 3 },
                768: { slidesPerView: 4 },
                1024: { slidesPerView: 5 },
            }
        });
    }
});