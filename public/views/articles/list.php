<? include_once VIEWS.'/layouts/header.php' ?>

<main class="page">
    <div class="container">
        <?= $this->edit ?>

        <? include_once VIEWS.'/components/breadcrumbs.php' ?>

        <h1 class="h1"><?= $this->page->name ?></h1>

        <div class="articles articles-list">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <? if (!empty($this->articles)) : ?>
                        <? foreach ($this->articles AS $item) : ?>

                            <?= $this->include('articles/item', $item, $this) ?>

                        <? endforeach; ?>
                        <?= $this->paginate ?>
                    <? else: ?>
                        <div class="not-found">Ничего не найдено</div>
                    <? endif; ?>

                </div>
            </div>
        </div>

    </div>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
