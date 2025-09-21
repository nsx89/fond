<? include_once VIEWS.'/layouts/header.php' ?>

<? $page = $this->page; ?>

<main class="page">
    <div class="container">
        <?= $this->edit ?>

        <? include_once VIEWS.'/components/breadcrumbs.php' ?>

        <h1 class="h1"><?= $this->page->name ?></h1>

        <div class="volunteers">
            <? if (!empty($this->volunteers)) : ?>
                <? foreach ($this->volunteers AS $item) : ?>

                    <?
                    $arr = explode(' ', $item->name);
                    $name = $arr[0];
                    $name_rest = implode(' ', array_slice($arr, 1));
                    ?>

                    <div class="volunteers-item">
                        <? if (!empty($item->image)) : ?>
                            <img src="<?= $item->image ?>" alt="<?= $item->name ?>">
                        <? else: ?>
                            <img src="/publis/src/images/no-photo.jpg" alt="Нет фото">
                        <? endif; ?>
                        <div class="volunteers-box">
                            <div class="volunteers-name"><?= $name ?> <br> <?= $name_rest ?></div>
                            <div class="volunteers-short">
                                <?= nl2br($item->short) ?>
                            </div>
                        </div>
                        <? if (!empty($item->medals)) : ?>
                            <div class="volunteers-medals">
                                <? $medals_ids = explode('|', trim($item->medals, '|')); ?>
                                <? foreach ($medals_ids AS $medal_id) : ?>
                                    <div class="volunteers-medal"><?= $this->medals[$medal_id]->name ?></div>
                                <? endforeach;  ?>
                            </div>
                        <? endif; ?>
                    </div>

                <? endforeach; ?>
                <?= $this->paginate ?>
            <? else: ?>
                <div class="not-found">Ничего не найдено</div>
            <? endif; ?>
        </div>

    </div>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
