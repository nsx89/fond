
/* --- Form --- */

function isValidEmail(email) {
    var pattern = new RegExp(/^(('[\w-\s]+')|([\w-]+(?:\.[\w-]+)*)|('[\w-\s]+')([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(email);
}
function formClear(form){
    $('input, textarea', form).val('');
    var checkbox = $('input[name=agree]', form);
    if (checkbox.length) {
        checkbox.prop('checked', false);
    }
}
function modal(title, type = 'error', reload = false){
    Swal.fire({
        title: title,
        type: type,
        showCancelButton: false,
        confirmButtonText: 'Закрыть',
    }).then((result) => {
        if (result.value && reload) {
            top.location.reload();
        }
    });
}

/* --- Subscribe --- */
/*
$('body').on('click', '.js-subscribe-btn', function(event){
    event.preventDefault();
    //if (loadingStop()) return false;

	var form = $(this).closest('form');
	var email = $('input[name=email]', form).val().trim();
    $('.placeholder-wrap', form).removeClass('error-wrap');
    if (email == '' || !isValidEmail(email)) {
        setTimeout(function(){
            $('.placeholder-wrap', form).addClass('error-wrap');
        }, 300);
        if (email == '') modal('Введите ваш e-mail');
        else modal('Введите корректный e-mail');
        return false;
    }

    //loadingShow();
    $.ajax({
        url: '/user/ajax',
        type: 'POST',
        data: {
              'action': 'subsEmailAdd'
            , 'email' : email
        },
        success: function(html){
           loadingHide();
           if (html == 1) {
               formClear(form);
               modal('Спасибо! Вы успешно подписаны на рассылку', 'info');
           }
           else {
               modal(html);
           }
        }
    });
});
*/
/* --- // --- */
