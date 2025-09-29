<? include_once VIEWS.'/layouts/header.php' ?>

<? $article = $this->article; ?>

<main class="page">

    <div class="container-small">
        <?= $this->edit ?>

        <? include_once VIEWS.'/components/breadcrumbs.php' ?>

        <h1 class="article-h1"><?= !empty($article->h1) ? $article->h1 : $article->name ?></h1>

        <div class="article-info">
            <? if (!empty($article->date)) : ?>
                <div class="article-date"><?= app\Helpers::dateText($article->date) ?>, <?= date('H:i', $article->date) ?></div>
            <? endif; ?>
            <div class="article-views"><?= number_format($article->views, 0, '', ' ') ?></div>
        </div>

        <? if (!empty($article->image2)) : ?>
            <div class="article-image">
                <img src="<?= $article->image2 ?>" alt="<?= $article->name ?>">
            </div>
        <? endif; ?>

        <div class="article-text texts">
            <?= $article->text ?>
        </div>

        <div class="article-bottom">
            <div class="article-socs">
                <div class="article-socs-name">Поделиться:</div>
                <script src="https://yastatic.net/share2/share.js" defer></script>
                <div class="ya-share2" data-curtain data-size="l" data-shape="round" data-color-scheme="whiteblack" data-services="telegram,vkontakte"></div>
            </div>
            <? if (!empty($article->author)) : ?>
                <div class="article-author">Автор: <span><?= $article->author ?></span></div>
            <? endif; ?>
        </div>
    </div>

    <div class="article-other">
        <div class="container">
            <? if (!empty($this->articles)) : ?>
                <div class="h2-wrap">
                    <h2 class="h2">Читайте так же</h2>
                    <a href="/<?= $this->pages[6]->url ?>" class="h2-link">
                        Смотреть все
                    </a>
                </div>
                <div class="articles">
                    <div class="swiper-container swiper6">
                        <div class="swiper-wrapper">
                            <? foreach ($this->articles AS $item) : ?>

                                <?= $this->include('articles/item', $item, $this) ?>

                            <? endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-prev-swiper6"></div>
                    <div class="swiper-button-next swiper-button-next-swiper6"></div>
                    <div class="swiper-pagination swiper-pagination-swiper6"></div>
                </div>
            <? endif; ?>
        </div>
    </div>

</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
