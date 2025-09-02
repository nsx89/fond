<?php

namespace app;

class Form
{
    public static function makeInput($title, $name, $value, $required = false, $type = '', $dis = '', $class = '')
    {
        if(empty($required)) $required = false;
        if(empty($type)) $type = 'text';
        if(empty($dis)) $dis = '';
        if(empty($class)) $class = '';

        include ROOT . '/private/views/templates/input.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeSubmit($id, $value, $text, $ids)
    {
        if(empty($text)) $text = 'Отправить';
        if(empty($ids)) $ids = '';

        include ROOT . '/private/views/templates/submit.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeSubmitBlock($id, $value, $text,$ids)
    {
        if(empty($text)) $text = 'Отправить';
        if(empty($ids)) $ids = '';?>

        <div class='input_block'>
            <button type='submit' name='<?= $id ? 'editblock' : 'addblock' ?><?= !empty($ids)?'Item':'' ?>' value='<?= $value ?>'><?= $text ?></button>
        </div>
        <?$html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeButtonBlock($id, $value, $text,$ids, $class = '')
    {
        if(empty($text)) $text = 'Отправить';
        if(empty($ids)) $ids = '';?>

        <div class='input_block <?= $class ?>'>
            <button type='button' id='<?= $id ?>' name='addblock' value='<?= $value ?>'><?= $text ?></button>
        </div>
        <?$html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeCheckbox($name, $checked, $title, $value, $id = null)
    {
        if(empty($title)) $title = 'Показывать на сайте';
        if(empty($value)) $value = '1';
        if(empty($id)) $id = null;

        include ROOT . '/private/views/templates/checkbox.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeRadio($title, $name, $items, $checked)
    {
        if(empty($items)) $items = [];
        if(empty($checked)) $checked = null;

        include ROOT . '/private/views/templates/radio.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeTextarea($title, $name, $value, $height = null, $class = '')
    {
        include ROOT . '/private/views/templates/textarea.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeImage($title, $name, $object, $required)
    {
        if(empty($required)) $required = false;

        include ROOT . '/private/views/templates/image.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeFile($title, $name, $object, $required = '')
    {
        if(empty($required)) $required = false;

        include ROOT . '/private/views/templates/file.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeFiles($title, $name, $objects, $required, $accept)
    {
        if(empty($required)) $required = false;
        if(empty($accept)) $accept = '';

        include ROOT . '/private/views/templates/files.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeGallery($title, $name, $gallerys)
    {
        include ROOT . '/private/views/templates/gallery.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeTextbox($title, $name, $value, $class = '')
    {
        include ROOT . '/private/views/templates/textbox.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeSelect($title, $name, $object, $selectedId, $null, $nullTitle, $pole, $no_obj = 0, $class = '', $data_id = 0, $form_id = '')
    {
        if(empty($selectedId)) $selectedId = null;
        if(empty($null) && $null != false) $null = true;
        if(empty($nullTitle)) $nullTitle = 'Не выбрано';
        if(empty($pole)) $pole = 'name';

        include ROOT . '/private/views/templates/select.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeSelectWith($title, $name, $object, $selectedId, $null, $nullTitle,$pole,$secname)
    {
        if(empty($selectedId)) $selectedId = null;
        if(empty($null) && $null != false) $null = true;
        if(empty($nullTitle)) $nullTitle = 'Нет';
        if(empty($pole)) $pole = 'name';
        if(empty($secname)) $secname = '';?>

        <div class='input_block'>
            <span><?= $title ?>:</span>
            <select name='<?= $name ?>'>
                <?php if ($null): ?>
                    <option value='0'><?= $nullTitle ?></option>
                <?php endif;

                if (!empty($object)):
                    foreach ($object as $item):
                        foreach ($item->parent as $item2): ?>
                        <option value='<?= $item->id ?>' <?php if ($selectedId == $item->id) echo 'selected' ?>><?= $item->$pole ?>&nbsp;(<?= $item2->name?>)</option>
                    <?php endforeach; endforeach;
                endif; ?>
            </select>
        </div>

        <?$html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeMultiple($title, $name, $object, $value = '', $info = '')
    {
        include ROOT . '/private/views/templates/selectMultiple.php';
        $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeItem($item, $name, $txt = array(), $delete = true, $show = true, $image = false, $sortable = false)
    {
        if (empty($item)) return;
        ?>
        <div class='list_item rate' data-id='<?=$item->id?>' data-class='<?= get_class($item)?>'>
            <div class="list_item-left">
                <? if ($sortable) : ?>
                    <div class='handle' title='Доступно перетаскивание блоков для сортировки'></div>
                <? endif; ?>
                <? if ($image) : ?>
                    <img src='<?= !empty($item->image) ? $item->image : '/private/src/images/no-photo.jpg' ?>' alt=''>
                <? endif; ?>
                <div class="list_item-name">
                    <h4><?= $name ?></h4>
                    <? if (!empty($txt)) : ?>
                        <? foreach ($txt as $value) : ?>
                            <div class="txt"><?= $value ?></div>
                        <? endforeach; ?>
                    <? endif; ?>
                </div>
            </div>
            <div class='list_item-actions'>
                <? if ($show) : ?>
                    <div class='admin_show <?= ($item->show == 1) ? 'admin_show_act' : '' ?>'
                        title='Показывать на сайте' data-id='<?= $item->id ?>'
                        data-className='<?= get_class($item) ?>'>
                    </div>
                <? endif; ?>
                <a href='?edit=<?= $item->id ?>' class='admin_edit' title='Редактировать'></a>
                <? if ($delete) : ?>
                    <a href='?delete=<?= $item->id ?>' class='admin_delete' title='Удалить'></a>
                <? endif; ?>
            </div>
        </div>

        <? $html = ob_get_contents();
        ob_clean();

        return $html;
    }

    public static function makeLabel($title, $value)
    {
        if(empty($selectedId)) $selectedId = null;
        ?>
        <div class='input_block'>
            <span><?= $title ?>: <?= $value ?></span>
        </div>

        <?$html = ob_get_contents();
        ob_clean();

        return $html;
    }

}
