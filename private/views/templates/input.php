<div class='input_block'>
    <? if(!empty($title)): ?>
        <span><?= $title ?>:</span>
    <? endif; ?>
    <input type='<?= $type ?>' name='<?= $name ?>' value='<?= $value ?>'
        <?php if ($required) echo 'required' ?>
        <?php if ($dis) echo 'disabled' ?>
        <?= !empty($class)?'class="'.$class.'"':'' ?>
        autocomplete='<?= $name == 'password' ? 'new-password' : 'off' ?>' maxlength='255'
        <?= ($type == 'number')?' step=".01"':'' ?>
        >
</div>
