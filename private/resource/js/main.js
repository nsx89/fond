
/* --- Замена target='_blank' на rel='external' --- */

function externalLinks() {
    if (!document.getElementsByTagName) return;
    var anchors = document.getElementsByTagName("a");
for (var i=0; i < anchors.length; i++) {
    if (anchors[i].getAttribute("href") &&

    anchors[i].getAttribute("rel") == "external") {
        anchors[i].target = "_blank";
    }
}
}
window.onload = externalLinks;

$(function() {

    $( ".sortbox" ).sortable({
		deactivate: function( event, ui ) {
			let i = $('.rate').length;
			$('.rate').each(function(){
				$(this).val(i);
				i--;
			});
			if($('.nums').length)
			{
				i = 1;
				$('.nums').each(function(){
					$(this).html(i);
					i++;
				});
			}
		}
	});
	$( ".sortbox" ).disableSelection();

	$('.sortbox-items').sortable({
		deactivate: function( event, ui ) {
			let items = [];
			let i = 0;
			let className = '';
			$('.sortbox-items .list_item').each(function(){
				items[i] = $(this).attr('data-id');
				className = $(this).attr('data-class');
				i++;
			});
			$.ajax({
				url: '/admin/ajax',
				type: 'POST',
				data: {
					  'action': 'sortbox'
					, 'items' : items
					, 'className' : className
				}
				, success: function(html){
					console.log(html);
				}
			});
		}
	});
	$('.sortbox-items').disableSelection();

    if ($('.sortbox-items').length || $('.sortbox').length) {
        $('body').addClass('body-sortable');
    }
});

/* --- // --- */

$(document).ready(function () {

    // Нажатие кнопки сохранить в правом верхнем углу
    $('body').on('click', '.save', function(){
        $('button[type=submit]').click();
    });

    // Анимация модального окна авторизации
    $('.login_modal').addClass('login_modal_animate');

    // Подтвердить удаление
    $('.admin_delete').click(function () {
        let i = $(this).attr('href');

        Swal.fire({
            title: 'Вы действительно хотите удалить?',
            text: 'Отменить это действие будет невозможно',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена',
        }).then((result) => {
            if (result.value) {
                top.location.href = i;
            }
        });

        return false;
    });

    // Скрывать/показывать по кнопке глаза
    $('body').on('click', '.admin_show', function () {

        let id = $(this).attr('data-id');
        let className = $(this).attr('data-className');
        let show;

        if ($(this).hasClass('admin_show_act')) {
            $(this).removeClass('admin_show_act');
            show = 0;
        } else {
            $(this).addClass('admin_show_act');
            show = 1;
        }

        $.ajax({
            url: '/admin/ajax',
            type: 'POST',
            data: {
                'action': 'adminShow',
                'id': id,
                'className': className,
                'show': show
            },
            success: function (html) {
                console.log(html);
            }
        });

    });

      // Удалить файл
    $('.file_delete').click(function () {
        let i = $(this).attr('data-id');
        let imgCard = $(this).closest('tr');
        imgCard.hide();
        $('#file_del'+i).val(i);
    });

    // Удалить картинку из галереи
    $('.img_control_delete').click(function () {

        let imgCard = $(this).closest('.admin_img_card');

        if (confirm('Вы действительно хотите удалить?')) {
            let id = $(this).attr('data-id');
            let className = $(this).attr('data-className');
            let path = $(this).attr('data-path');

            $.ajax({
                url: '/admin/ajax',
                type: 'POST',
                data: {
                    'action': 'adminGalleryDelete',
                    'id': id,
                    'className': className,
                    'path': path,
                },
                success: function (html) {
                    imgCard.hide();
                }
            });
        }

    });

    // Удалить превью товара
    $('.img_preview_delete').click(function () {

        Swal.fire({
            title: 'Вы действительно хотите удалить?',
            text: 'Отменить это действие будет невозможно',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена',
        }).then((result) => {
            if (result.value) {
                let imgCard = $(this).closest('.admin_img_blocks');
                imgCard.hide();

                let field = $(this).data('field');
                let id = $(this).data('id');

                $('.image_preview_del',imgCard).val(field);
            }
        });

    });

     // Удалить фотографию из галереи
    $('.img_gallery_delete').click(function () {
        let i = $(this).attr('data-id');
        let imgCard = $(this).closest('.admin_img_block');
        imgCard.hide();
        $('#image_gallery_del'+i).val(i);
    });

    // Количество выбранных файлов при загрузке изображений в галерею
    $('#upload').change(function () {

        let count = this.files.length;
        let file = declOfNum(count, ['файл', 'файла', 'файлов']);
        let fileCount = 'Выбрано';

        if (count === 1) {
            fileCount = 'Выбран';
        }

        $('#upload + label').text(fileCount + ' ' + count + ' ' + file);
    });

    // Название файла в кнопке выбора файла
    $('#image').change(function () {
        $('#image + label').text(this.files[0].name);
    });

    // Высота select под количество пунктов
    let optionLength = $('.select_block option').length;
    // if (optionLength < $('.select_block select').attr('size')) {
    //     $('.select_block select').attr('size', optionLength);
    // }
    $('.select_block select').attr('size', optionLength);

    // Добавить новый пункт в фильтры
    $('.add_filters_item').click(function () {
        let filterItem = $('<div>').addClass('filters_list-item')
            .append(
                $('<input>')
                    .attr({
                        type: 'text',
                        name: 'filtersList[]'
                    })
            ).append(
                $('<button>')
                    .attr('type', 'button')
                    .addClass('delete_filters_item')
                    .text('Удалить')
            );

        $('.filters_list-item:last-child').before(filterItem);

    });

    // Удалить пункт из фильтров
    $('fieldset').on('click', '.delete_filters_item', function () {
        let filterItem = $(this);
        let id = filterItem.data('id');
        if (id !== undefined) {
            if (confirm('Вы действительно хотите удалить?')) {
                $.ajax({
                    url: '/admin/ajax',
                    type: 'POST',
                    data: {
                        'action': 'filtersListDelete',
                        'id': id,
                    },
                    success: function (html) {
                        filterItem.parent('.filters_list-item').remove();
                    }
                });
            }
        } else {
            filterItem.parent('.filters_list-item').remove();
        }
    });





    var fixEmptyParagraphs = function(editor) {
        $('p', editor.dom.doc.body).each(function(index, self) {
            self = $(self);
            if (!self[0].innerText && !self.hasClass('empty-paragraph')) {
                self.addClass('empty-paragraph');
            }
        });
    };


    function initTiny() {
        tinymce.remove();

        var Theme = 'lightgray';
        if($('body').hasClass('TinyDark')) Theme = 'dark';

        tinymce.init({
            selector: '.editor',
            skin: Theme,
            schema: 'html5',
            branding: false,
            height: 260,
            autoresize_bottom_margin: 30,
            autoresize_min_height: 260,
            autoresize_max_height: 260,
            autoresize_on_init: true,
            language: 'ru',
            language_url : '/vendor/tinymce/tinymce/lang/ru.js',
            external_filemanager_path:"/vendor/tinymce/tinymce/filemanager/",
            external_plugins: { "filemanager" : "/vendor/tinymce/tinymce/filemanager/plugin.min.js"},
            filemanager_title: 'Менеджер файлов',
            filemanager_sort_by: 'date',
            filemanager_descending: 0,
            plugins: 'autoresize imagetools advlist anchor autolink code colorpicker fullscreen hr insertdatetime link lists nonbreaking noneditable paste searchreplace table textcolor textpattern visualblocks visualchars wordcount image filemanager',
            image_advtab: true,
            toolbar1: 'bold italic underline strikethrough | bullist numlist table hr | alignleft aligncenter alignright alignjustify | link unlink | code fullscreen',
            toolbar2: 'styleselect | fontsizeselect forecolor backcolor removeformat outdent indent | undo, redo | mybutton image imagetools responsivefilemanager',
            images_upload_base_path: '/public/src/img/upload',
            relative_urls: false,
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            browser_spellcheck: true,
            fix_list_elements: true,
            keep_styles: false,
            link_class_list: [
                {title: 'None', value: ''},
                {title: 'Gallery', value: 'gallery'}
            ],
            paste_enable_default_filters: false,
            paste_filter_drop: false,
            paste_as_text: false,
            convert_fonts_to_spans : true,
            force_hex_style_colors : true,
            force_p_newlines: true,
            forced_root_block : 'p',
            end_container_on_empty_block: true,
            menubar: false,
            textcolor_map: [
                "000000", "Черный",
                "993300", "Утомленный оранжевый",
                "333300", "Темно-оливковый",
                "003300", "Темно-зеленый",
                "003366", "Темно-лазурный",
                "000080", "Темно-синий",
                "333399", "Индиго",
                "333333", "Очень темно-серый",
                "800000", "Бордовый",
                "FF6600", "Оранжевый",
                "808000", "Оливковый",
                "008000", "Зеленый",
                "008080", "Изумрудный",
                "0000FF", "Синий",
                "666699", "Серовато-синий",
                "808080", "Серый",
                "FF0000", "Красный",
                "FF9900", "Янтарный",
                "339966", "Морской зеленый",
                "33CCCC", "Бирюзовый",
                "3366FF", "Королевский синий",
                "800080", "Фиолетовый",
                "999999", "Средне-серый",
                "FF00FF", "Пурпурный",
                "FFCC00", "Золотой",
                "FFFF00", "Желтый",
                "00FF00", "Лайм",
                "00FFFF", "Аква",
                "00CCFF", "Небесно-голубой",
                "993366", "Красно-фиолетовый",
                "FFFFFF", "Белый",
                "FF99CC", "Розовый",
                "FFCC99", "Персиковый",
                "FFFF99", "Светло-желтый",
                "CCFFCC", "Бледно-зеленый",
                "CCFFFF", "Бледно-голубой",
                "99CCFF", "Светло-голубой",
                "CC99FF", "Слива"
            ],
            body_class: 'tiny-content tiny-portfolio',
            content_css: '/private/src/css/tiny.css',
            cache_suffix: '?v=5',
            setup: function(editor) {
                var e = editor;
                e.addButton('mybutton', {
                    tooltip: 'Высокая видимость курсора',
                    icon: 'preview',
                    onclick: function() {
                        var $body = $(e.contentDocument.body);
                        if (!$body.hasClass('high-visibility')) {
                            $body.addClass('high-visibility');

                            this.$el.addClass('mce-active');
                        } else {
                            $body.removeClass('high-visibility');
                            $('.wide-img', $body).removeClass('wide-img');

                            this.$el.removeClass('mce-active');
                        }
                    }
                });
            },
            init_instance_callback: function(editor) {
                var $window = $(editor.contentWindow),
                    $body = $(editor.contentDocument.body);

                editor.on('change', function() {
                    fixEmptyParagraphs(editor);
                });

                $window.on('resize', function() {
                    setTimeout(function() {
                        var w = $window.width();

                        var p = Math.floor((w - 1140) / 2);
                        if (p < 15) p = 15;
                        $body.css({
                            paddingLeft: p + 'px',
                            paddingRight: p + 'px'
                        });
                    }, 0);
                });
            },
            formats: {
                alignleft: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'left' }},
                aligncenter: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'center' }},
                alignright: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'right' }},
                alignjustify: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'justify' }},
                bold: {
                    inline: 'strong'
                },
                italic: {
                    inline: 'em',
                },
                strikethrough: {
                    inline: 'del'
                },
            },
            insertdatetime_formats: ['%H:%M:%S', '%d.%m.%Y']
        });
    }



    $('.admin_panel-open-name').click(function () {

        if ($(this).hasClass('state-close')) {
            $(this).removeClass('state-close');
        } else {
            $(this).addClass('state-close');
        }

        $(this).next('.admin_panel-open-block').slideToggle();

    });
    initTiny();

    $('body').on('click', '.button_alert, #black', function () {
        $('.notice').hide();
        $('#black').hide();
    });

    if ($('.notice #alert').length) {
        $('.notice #alert').addClass('anime-mod-show');
        if (!$('.notice').hasClass('error')) {
            setTimeout(function () {
                $('.notice').fadeOut(150);
            }, 1200);
        }
    }

    $('.input_file_block input[type=file]').change(function(){
		var val = $(this).val();
		val = val.replace("fakepath", "...");
		var parent = $(this).closest('.input_file_block');
		$('label', parent).html(val);
	});

});


function declOfNum(number, titles) {
    let cases = [2, 0, 1, 1, 1, 2];
    return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
}


if($('#YMapsID').length)
{
	ymaps.ready(init);

	function init() {

		let lat = parseFloat($('#YMapsID').attr('data-lat'));
		let lng = parseFloat($('#YMapsID').attr('data-lng'));
		let myPlacemark;

		if(lat == '0' || lng == '0')
		{
			lat = parseFloat('59.939023');
			lng = parseFloat('30.315865');
		}

		let myMap = new ymaps.Map('YMapsID', {
			center: [lat,lng],
			zoom: 15,
			controls: []
		});

		myMap.controls.add('zoomControl');
		myMap.behaviors.disable('scrollZoom');

		let placemark = new ymaps.Placemark([lat,lng],{},
		{
			iconLayout: 'default#image',
			iconImageHref: '/public/src/img/marker.svg',
			iconImageSize: [104, 112],
			iconImageOffset: [-52, -90],
			iconContentOffset:[0, 0]
		});
		myMap.geoObjects.add(placemark);

		myMap.events.add('click', function (e) {
			var coords = e.get('coords');

			$('#YMapsID').attr('data-lat',coords[0]);
			$('#YMapsID').attr('data-lng',coords[1]);

			let c = coords[0]+','+coords[1];
			$('input[name=coords]').val(c);

			if (myPlacemark) {
				myPlacemark.geometry.setCoordinates(coords);
			}
			else {
				myPlacemark = createPlacemark(coords);
				myMap.geoObjects.add(myPlacemark);
				myPlacemark.events.add('dragend', function () {
					getAddress(myPlacemark.geometry.getCoordinates());
				});
			}
		});
	}
	function createPlacemark(coords) {
		return new ymaps.Placemark(coords, {
			iconCaption: coords
		}, {
			preset: 'islands#violetDotIconWithCaption',
			draggable: true
		});
	}
}


$('body').on('click', '.admin_menu_link2', function(){

	if(!$(this).hasClass('admin_menu_link_act'))
	{
		$(this).addClass('admin_menu_link_act');
	}
	else
	{
		$(this).removeClass('admin_menu_link_act');
	}
});
$('body').on('click', '.admin_panel-open-block', function(){
	return false;
});
$('body').on('click', '.admin_link', function(){
	window.location.href=$(this).attr('href');
});


$(document).ready(function(){
	$('.js-phone').mask('+7 (999) 999-99-99');
});


$('body').on('submit', '#login_form', function(){
	$(this).ajaxSubmit({
		url: '/user/ajax',
		type: 'POST',
		success: function (html) {
            console.log(html);
            top.location.reload();
		}
	});
	return false;
});

/* --- Chosen --- */

function chosen_init(){
    if ($('.chosen').length > 0) {
        $('.chosen').chosen({
    		no_results_text: "Ничего не найдено...",
    		width:'100%',
    		search_contains: true
    	});
    }
}
chosen_init();

/* --- Input number --- */

$('body').on('keyup', '.js-input-number', function () {
    if (this.value.match(/[^0-9.]/g)) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    }
});

/* --- // --- */


/* --- Multiple tree --- */

$('body').on('change', '.js-multiple-checkbox', function () {
    var id = $(this).attr('data-id');
    var parent = $(this).attr('data-parent');
    var parent_main = $(this).attr('data-parent_main');

    var checked = $(this).prop('checked');

    if (parent != '') {
        var parent_element = $('.js-multiple-checkbox[data-id='+parent+']');
        if (parent_element.length) {
            if (checked) parent_element.prop('checked', checked);
        }
    }
    if (parent_main != '') {
        var parent_main_element = $('.js-multiple-checkbox[data-id='+parent_main+']');
        if (parent_main_element.length) {
            if (checked) parent_main_element.prop('checked', checked);
        }
    }

    if (!checked) {
        var child_elements = $('.js-multiple-checkbox[data-parent='+id+']');
        if (child_elements.length) {
            child_elements.prop('checked', false);
        }

        var child_elements_main = $('.js-multiple-checkbox[data-parent_main='+id+']');
        if (child_elements_main.length) {
            child_elements_main.prop('checked', false);
        }
    }
});

/* --- Filter inline --- */

$('body').on('change', '.js-filter-inline select', function(){
    var form = $('#form-filter');
    $('button', form).trigger('click');
});

/* --- // --- */
