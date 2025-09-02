<div class='input_block <?=$class?>'>
    <?if(!empty($title)):?>
        <span><?= $title ?>:</span>
    <?endif;?>

    <select name='<?= $name ?>' id='<?= $name ?>' class='chosen' data-id='<?=$data_id?>' <?= !empty($form_id) ? 'form='.$form_id : '' ?>>
        <?php if ($null): ?>
            <option value='0'><?= $nullTitle ?></option>
        <?php endif;

        if (!empty($object) && empty($no_obj)):
            foreach ($object as $item): ?>
                <option value='<?= $item->id ?>' <?php if ($selectedId == $item->id) echo 'selected' ?>><?= $item->$pole ?></option>
            <?php endforeach;
        elseif($no_obj == 1):
            foreach ($object as $item): ?>
                <option value='<?= $item->id ?>' <?php if ($selectedId == $item->id) echo 'selected' ?>><?= $item->surname ?>&nbsp;<?= $item->name ?>&nbsp;<?= $item->patronymic ?></option>
            <?php endforeach;
        elseif($no_obj == 2):
            foreach ($object as $key => $item): ?>
                <option value='<?= $key ?>' <?php if ($selectedId == $key) echo 'selected' ?>><?= $item ?></option>
            <?php endforeach;
        endif; ?>
    </select>

</div>
