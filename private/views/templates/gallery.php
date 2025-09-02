<div class='input_file_block'>
    <span><?= $title ?>:</span>
    <input id='gallery_<?= $name ?>' type='file' name='<?= $name ?>[]' multiple='true' min=1 max=999 accept='image/jpeg,image/png,image/jpg'>
    <label for='gallery_<?= $name ?>'>Выбрать файлы</label>
</div>

<? if(!empty($gallerys)) : ?>
    <div class='admin_gallery_block sortbox' title='Перетащите для сортировки'>

        <? foreach($gallerys AS $gallery) : ?>
            <div class='admin_img_block filter'>
                <div class='admin_img_card'>
                    <div class='card_image_block _transparent'>
                        <img src='<?= $gallery->image_small ?>' alt=''>
                    </div>
                    <div class='img_card_panel'>
                        <input type='hidden' name='gallery_id[]' value='<?= $gallery->id ?>'>
                        <input type='hidden' name='gallery_rate[]' class='rate' value='<?= $gallery->rate ?>'>

                        <a class='img_preview_open' title='Открыть' target='_blank' href='<?= $gallery->image ?>'></a>
                        <input type='hidden' name='image_gallery_del[]' id='image_gallery_del<?= $gallery->id ?>' value='0'>
                        <button type='button' class='img_gallery_delete' data-id='<?= $gallery->id ?>'
                                data-className='<?= get_class($gallery) ?>' data-field='image'></button>
                    </div>
                    <div class='names none'>
                        <input type='text' name='gallery_name[]' class='name' value='<?= $gallery->name ?>' placeholder='Alt'>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
<? endif;?>
