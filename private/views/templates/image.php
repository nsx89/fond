<div class='input_block input_file_block'>
    <span><?= $title ?>:</span>
    <input id='image_<?= $name ?>' type='file' name='<?= $name ?>' accept='image/jpeg,image/png,image/jpg' <?php if($required) echo 'required' ?>>
    <label for='image_<?= $name ?>'>Выбрать файл</label>

    <?
    $old_name = $name;
    if(substr($name,0,10) == 'link_image') $name = 'image';
    ?>

    <?php if (!empty($object->$name)): ?>
        <div class='admin_img_blocks'>
            <div class='admin_img_card'>
                <div class='card_image_block _transparent'>
                    <img src='<?= $object->$name ?>' alt=''>
                </div>
                <div class='img_card_panel'>
                     <a class='img_preview_open' title='Открыть' target='_blank' href='<?= $object->$name ?>'></a>
                    <input type='hidden' name='image_preview_del[]' class='image_preview_del' value='0'>
                    <input type='hidden' name='image_preview_class[]' value='<?= get_class($object) ?>'>
                    <input type='hidden' name='image_preview_id[]' value='<?= $object->id ?>'>
                    <button type='button' class='img_preview_delete' data-id='<?= $object->id ?>'
                            data-className='<?= get_class($object) ?>'
                            data-field='<?= $old_name ?>'
                            title='Удалить'>
                   </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
