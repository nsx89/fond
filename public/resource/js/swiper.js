var swiper1 = new Swiper(".swiper1", {
    navigation: {
        prevEl: ".swiper-button-prev-swiper1",
        nextEl: ".swiper-button-next-swiper1",
    },
    pagination: {
        el: ".swiper-pagination-swiper1",
        clickable: true
    },
    slidesPerView: '1',
    spaceBetween: 0,
    loop: false,
    breakpoints: {

    }
});

var swiper2 = new Swiper(".swiper2", {
    navigation: {
        prevEl: ".swiper-button-prev-swiper2",
        nextEl: ".swiper-button-next-swiper2",
    },
    pagination: {
        el: ".swiper-pagination-swiper2",
        clickable: true
    },
    slidesPerView: '2',
    spaceBetween: 30,
    loop: false,
    breakpoints: {

    }
});
