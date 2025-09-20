<? if (!empty($item)) : ?>
    <a href="<?= app\Models\Articles::getLink($item, $array->pages[6]) ?>" class="swiper-slide">
        <? if (!empty($item->image)) : ?>
            <img src="<?= $item->image ?>" alt="<?= $item->name ?>">
        <? else: ?>
            <img src="/publis/src/images/no-photo.jpg" alt="Нет фото">
        <? endif; ?>
        <div class="articles-box">
            <div class="articles-head"><?= $item->name ?></div>
            <div class="articles-text">
                <?= nl2br($item->short) ?>
            </div>
            <? if (!empty($item->date)) : ?>
                <div class="articles-date"><?= date('d.m.Y', $item->date) ?></div>
            <? endif; ?>
        </div>
    </a>
<? endif; ?>
