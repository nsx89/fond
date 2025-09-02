<div class='input_block'>
    <span><?= $title ?>:</span>
    <div class="multiple">

        <?
        $array = explode('|', trim($value, '|'));
        ?>

        <? foreach ($object as $item): ?>

            <?
            $item_id = 'multiple_checkbox_'.$name.'_'.$item->id;
            $checked = in_array($item->id, $array) ? 'checked="checked"' : '';
            ?>

            <div class='checkbox_default clearfix
                <?= !empty($item->parent) ? 'checkbox_default_child' : '' ?>
                <?= !empty($item->parent_main) ? 'checkbox_default_child2' : '' ?>'>
                <input class="js-multiple-checkbox" type='checkbox'
                    id='<?= $item_id ?>' name='<?= $name ?>[]'
                    value='<?= $item->id ?>' <?= $checked ?>
                    data-id="<?= $item->id ?>" data-parent="<?= $item->parent ?>" data-parent_main="<?= $item->parent_main ?>"
                    >
                <label for='<?= $item_id ?>'>ID: <?= $item->id ?> | <?= $item->name ?></label>
            </div>

        <? endforeach; ?>
    </div>
</div>
