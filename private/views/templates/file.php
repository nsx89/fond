<div class='input_block input_file_block'>
    <span><?= $title ?>:</span>
    <input id='file_<?= $name ?>' type='file' name='<?= $name ?>' accept='' <?php if($required) echo 'required' ?>>
    <label for='file_<?= $name ?>'>Выбрать файл</label>

    <?php if (!empty($object->$name)): ?>
        <div class='admin_img_blocks'>
            <div class='admin_img_card'>
                <div class='img_card_panel file_card_panel'>
                    <a class='file_name' title='Открыть' target='_blank' href='<?= $object->$name ?>'><?= basename($object->$name) ?></a>
                    <a class='img_preview_open' title='Открыть' target='_blank' href='<?= $object->$name ?>'></a>
                    <input type='hidden' name='image_preview_del[]' class='image_preview_del' value='0'>
                    <button type='button' class='img_preview_delete' data-id='<?= $object->id ?>'
                        data-className='<?= get_class($object) ?>'
                        data-field='<?= $name ?>'
                        title='Удалить'>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
