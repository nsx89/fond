<? if (!empty($this->breadcrumbs)) : ?>
    <div class="breadcrumbs">
        <? foreach ($this->breadcrumbs AS $val) : ?>
            <? if (!empty($val[1])) : ?>
                <a href="<?= $val[1] ?>" class="breadcrumbs-item"><?= $val[0] ?></a>
            <? else: ?>
                <span class="breadcrumbs-item"><?= $val[0] ?></span>
            <? endif; ?>
        <? endforeach; ?>
    </div>
<? endif; ?>
