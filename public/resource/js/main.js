/* --- isMobile --- */

function isMobile(){
    if ($(window).outerWidth() < 980) return true;
    return false;
}

/* --- Header Fixed --- */

const scrollFixed = 72;
function headerActive() {
    const header = $('.header');
    if (header.length == 0) return;

    var scrollTop = $(window).scrollTop();
    if (scrollTop > scrollFixed) {
        header.addClass('active');
    }
    else {
        header.removeClass('active');
    }
}
headerActive();
$(window).scroll(function(){
     headerActive();
});

/* --- // --- */
