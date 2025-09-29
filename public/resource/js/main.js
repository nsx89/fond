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

/* --- Modal --- */

function modal_auto() {
    var w = $('#modal-mod').width();
    var w1 = w/2-w;
    //$('#modal-mod').css({'margin-left' : w1});
    var h = $('#modal-mod').height();
    var h1 = h/2-h;
    w = $(window).height();
    if (h > w) {
        //$('#modal-mod').css({'top' : '0px'});
        //$('#modal-mod').css({'margin-top' : '7px'});
        $('body').css('overflow', 'hidden');
    }
    else {
        //$('#modal-mod').css({'top' : '50%'});
        //$('#modal-mod').css({'margin-top' : h1});
        $('body').css('overflow', 'auto');
    }
}
function modal(html = ''){
    $('#modal-wrap').fadeIn(300);
    if (html != '') $('#modal-modbox').html(html);
    $('#modal-mod').addClass('anime-mod-show');
    modal_auto();
    setTimeout(function(){
        modal_auto();
    }, 100);
}
function modal_close(){
    $('#modal-wrap').fadeOut(300, function(){
        $('#modal-modbox').html('');
    });
    $('#modal-mod').removeClass('anime-mod-show');
    $('body').css('overflow', 'auto');
}
$('body').on('click', '#modal-close, #modal-black', function(){
    modal_close();
});
$(window).resize(function(){
    modal_auto();
});

/* --- Video modal --- */

$('body').on('click', '.js-video-modal', function(){
	var video = $(this).attr('data-video') || '';
    var html = '<video class="modal-video" preload="" playsinline controls autoplay><source src="'+video+'" type="video/mp4">';
    modal(html);
});

/* --- Pay box --- */

$('body').on('click', '.pay-box-item', function(){
	$('.pay-box-item').removeClass('active');
	$(this).addClass('active');
});

/* --- Documents --- */

$('body').on('click', '.js-documents-open', function(){
	var src = $(this).attr('data-src');
    if (src != '') {
        var html = '<img class="modal-documents-img" src="'+src+'" />';
        modal(html);
    }
});

/* --- Scroll to  --- */

$('body').on('click', '.js-scroll-form', function(){
    var element = $('.main-contacts');
    if (!element.length) return;
    var scrollTop = element.offset().top - 80;
    $('html, body').animate({scrollTop: scrollTop}, 300);
});

/* --- // --- */

$('body').on('click', '.js-mobile-menu-btn', function(){
    var menu = $('.mobile-menu');
    if (!menu.hasClass('active')) {
        menu.fadeIn(300, function() {
            menu.addClass('active');
            $('body').css('overflow', 'hidden');
        });
    }
    else {
        menu.fadeOut(100, function() {
            menu.removeClass('active');
            $('body').css('overflow', 'auto');
        });
    }
});

/* --- // --- */
