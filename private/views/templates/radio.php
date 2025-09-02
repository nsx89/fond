<div class='input_block'>
    <span><?= $title ?>:</span>
    <div class='radio_block'>
        <?php $i = 1;
        foreach ($items as $value => $label): ?>

            <input type='radio' name='<?= $name ?>' id='radio_<?= $name ?>_<?= $i ?>'
                   value='<?= $value ?>' <?php if ($value == $checked) echo 'checked' ?>>
            <label for='radio_<?= $name ?>_<?= $i ?>'><?= $label ?></label>

            <?php $i++;
        endforeach; ?>
    </div>
</div>