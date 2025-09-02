var swiper1 = new Swiper(".mySwiper1", {
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    },
    loop: true, //  Зацикливание слайдера (необязательно, но рекомендуется)
    autoplay: { //  Автопрокрутка слайдера
        delay: 7000, //  Задержка между сменой слайдов (в миллисекундах)
        disableOnInteraction: false, //  Продолжать автопрокрутку после взаимодействия пользователя
    },
});

var swiper2 = new Swiper(".mySwiper2", {
    navigation: {
        nextEl: ".swiper-button-next_swiper2",
        prevEl: ".swiper-button-prev_swiper2",
    },
    slidesPerView: '8.1',
    spaceBetween: 42,
    breakpoints: {
        1600: {
            spaceBetween: 42,
            slidesPerView: '8.1',
        },
        1450: {
            spaceBetween: 30,
            slidesPerView: '8.1',
        },
        1300: {
            spaceBetween: 30,
            slidesPerView: '7.1',
        },
        1180: {
            spaceBetween: 30,
            slidesPerView: '6.1',
        },
        980: {
            spaceBetween: 30,
            slidesPerView: '5.1',
        },
        275: {
            spaceBetween: 16,
            slidesPerView: '2.7',
        },
    }
});


var swiper3 = new Swiper(".mySwiper3", {
    navigation: {
        nextEl: ".swiper-button-next_swiper3",
        prevEl: ".swiper-button-prev_swiper3",
    },
    slidesPerView: '1.5',
    spaceBetween: 40,
    breakpoints: {
        1680: {
            spaceBetween: 40,
            slidesPerView: 3,
        },
        1300: {
            spaceBetween: 40,
            slidesPerView: '3',
        },
        980: {
            spaceBetween: 40,
            slidesPerView: '3',
        },
        275: {
            spaceBetween: 27,
            slidesPerView: '1.45',
        },
    }
});

var swiper33 = new Swiper(".mySwiper33", {
    navigation: {
        nextEl: ".swiper-button-next_swiper33",
        prevEl: ".swiper-button-prev_swiper33",
    },
    slidesPerView: '1.5',
    spaceBetween: 40,
    breakpoints: {
        1680: {
            spaceBetween: 40,
            slidesPerView: 3,
        },
        1300: {
            spaceBetween: 40,
            slidesPerView: '3',
        },
        980: {
            spaceBetween: 40,
            slidesPerView: '3',
        },
        275: {
            spaceBetween: 27,
            slidesPerView: '1.45',
        },
    }
});

//Партнеры
var swiper9 = new Swiper(".mySwiper9", {
    navigation: {
        nextEl: ".swiper-button-next_swiper9",
        prevEl: ".swiper-button-prev_swiper9",
    },
    slidesPerView: '4',
    spaceBetween: 40,
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    },
    breakpoints: {
        980: {
            spaceBetween: 40,
            slidesPerView: '4',
        },
        275: {
            spaceBetween: 21,
            slidesPerView: '2.27',
        },
    }
});

//Блог. Может быть интересно
var swiper10 = new Swiper(".mySwiper10", {
    navigation: {
        nextEl: ".swiper-button-next_swiper10",
        prevEl: ".swiper-button-prev_swiper10",
    },
    slidesPerView: '3',
    spaceBetween: 41,
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        1600: {
            spaceBetween: 41,
            slidesPerView: 3,
        },
        1180: {
            spaceBetween: 30,
            slidesPerView: 3,
        },
        980: {
            spaceBetween: 25,
            slidesPerView: 3,
        },
        275: {
            slidesPerView: 1,
        },
    }
});

var swiper7 = new Swiper(".mySwiper7", {
    navigation: {
        nextEl: ".swiper-button-next_swiper7",
        prevEl: ".swiper-button-prev_swiper7",
    },
    spaceBetween: 40,
    slidesPerView: 4,
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        1600: {
            spaceBetween: 40,
            slidesPerView: 4,
        },
        1300: {
            spaceBetween: 30,
            slidesPerView: 4,
        },
        1180: {
            spaceBetween: 30,
            slidesPerView: 4,
        },
        980: {
            spaceBetween: 30,
            slidesPerView: 3,
        },
        275: {
            slidesPerView: 2,
        },
    }
});

var swiper8 = new Swiper(".mySwiper8", {
    navigation: {
        nextEl: ".swiper-button-next_swiper8",
        prevEl: ".swiper-button-prev_swiper8",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    spaceBetween: 40,
    slidesPerView: 4,
    breakpoints: {
        1600: {
            spaceBetween: 40,
            slidesPerView: 4,
        },
        1300: {
            spaceBetween: 30,
            slidesPerView: 4,
        },
        1180: {
            spaceBetween: 30,
            slidesPerView: 4,
        },
        980: {
            spaceBetween: 30,
            slidesPerView: 3,
        },
        275: {
            slidesPerView: 2,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        },
    }
});


// Свайпер Традиции познаются в семье
var swiper4 = new Swiper(".mySwiper4", {
    slidesPerView: 1.45,
    spaceBetween: 37,
    pagination: {
        el: ".swiper-pagination",
    },
});


var swiper11 = new Swiper(".mySwiper11", {
    navigation: {
        nextEl: ".swiper-button-next_swiper11",
        prevEl: ".swiper-button-prev_swiper11",
    },
    slidesPerView: '1.5',
    spaceBetween: 40,
    breakpoints: {
        1600: {
            spaceBetween: 40,
            slidesPerView: 4,
        },
        1300: {
            spaceBetween: 30,
            slidesPerView: 4,
        },
        1180: {
            spaceBetween: 30,
            slidesPerView: 4,
        },
        980: {
            spaceBetween: 30,
            slidesPerView: 3,
        },
        275: {
            slidesPerView: 2,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        },
    }
});


var swiper5;
var swiper12;

initSwiper();
function initSwiper() {

    var mobile = isMobile();

    //swiper5
    if ($('.mySwiper5').length) {
        if (mobile && !swiper5) {
            swiper5 = new Swiper('.mySwiper5', {
                slidesPerView: 1.3,
                spaceBetween: 30,
                //loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        } else if (!mobile && swiper5) {
            swiper5.destroy();
            swiper5 = undefined;
        }
    }

    //swiper12
    if ($('.mySwiper12').length) {
        if (mobile && !swiper12) {
            swiper12 = new Swiper('.mySwiper12', {
                //slidesPerView: 1,
                //spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        } else if (!mobile && swiper12) {
            swiper12.destroy();
            swiper12 = undefined;
        }
    }
}

$(window).on('resize', function(){
    initSwiper();
});

var swiper6 = new Swiper(".mySwiper6", {
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
        el: ".swiper-pagination",
    },
});

var b = 1;
$('.mySwiperBlog').each(function(){
    var id = $(this).attr('id');
    var swiperBlog = new Swiper('#'+id, {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
        spaceBetween: 40,
        slidesPerView: 3,
        breakpoints: {
            1600: {
                spaceBetween: 40,
                slidesPerView: 3,
            },
            1180: {
                spaceBetween: 30,
                slidesPerView: 3,
            },
            980: {
                spaceBetween: 30,
                slidesPerView: 3,
            },
            275: {
                spaceBetween: 30,
                slidesPerView: 2,
            },
        }
    });
});

var swiper13 = new Swiper('.mySwiper13', {
    slidesPerView: 1.2,
    spaceBetween: 33,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

var swiper14 = new Swiper('.mySwiper14', {
    slidesPerView: 1.525,
    spaceBetween: 50,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});
