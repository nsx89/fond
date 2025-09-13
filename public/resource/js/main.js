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

/* --- Input number --- */

$('body').on('keyup', '.js-input-number', function () {
    if (this.value.match(/[^0-9.]/g)) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    }
});

/* --- Dotdotdot --- */

if ($('.dots').length) {
    $('.dots').dotdotdot();
}

/* --- Placeholder --- */

$('body').on('focus', '.placeholder-wrap .input', function(){
	var parent = $(this).parent();
	$('.placeholder', parent).addClass('placeholder-act');
});

$('body').on('blur', '.placeholder-wrap .input', function(){
	var val = $(this).val();
	var parent = $(this).parent();
	if (val == '') {
		$('.placeholder', parent).removeClass('placeholder-act');
	}
});

if ($('.placeholder-wrap .input').length > 0) {
	$('.placeholder-wrap .input').each(function(){
		var val = $(this).val();
		var parent = $(this).parent();
		if (val != '') {
			$('.placeholder', parent).addClass('placeholder-act');
		}
	});
}

/* --- // --- */
