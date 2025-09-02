<div class='input_block textarea'>
    <? if (!empty($title)): ?>
      <span>
          <?= $title ?>:
      </span>
    <? endif; ?>
    <textarea name='<?= $name ?>' class='input <?= $class ?>' style='<?= !empty($height) ? 'height: '.$height.'px' : '' ?>'><?= $value ?></textarea>
</div>
