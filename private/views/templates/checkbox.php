<div class='checkbox_block clearfix'>
    <input type='checkbox' id='checkbox_<?= $id ?? $name ?>' name='<?= $name ?>'
           value='<?= $value ?>' <?= ($checked) ? 'checked' : '' ?>>
    <label for='checkbox_<?= $id ?? $name ?>'><?= $title ?></label>
</div>