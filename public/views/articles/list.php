<? include_once VIEWS.'/layouts/header.php' ?>

<main class="page">
    <div class="container">
        <?= $this->edit ?>

        <? include_once VIEWS.'/components/breadcrumbs.php' ?>

        <h1 class="h1"><?= $this->page->name ?></h1>

        <div class="articles articles-list">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/public/src/images/victory/victory1.jpg" alt="">
                        <div class="articles-box">
                            <div class="articles-head">Важность помощи ближнему</div>
                            <div class="articles-text dots">
                                Помощь другим — это одна из основных человеческих ценностей.
                                Она играет ключевую роль в укреплении социальных связей
                                и создании сплоченного общества.
                            </div>
                            <div class="articles-date">16.08.2025</div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/public/src/images/victory/victory2.jpg" alt="">
                        <div class="articles-box">
                            <div class="articles-head">Социальная ответственность</div>
                            <div class="articles-text dots">
                                Помощь другим способствует развитию чувства социальной ответственности.
                                Когда мы помогаем другим, что заботимся о благополучии нашего общества.
                            </div>
                            <div class="articles-date">12.08.2025</div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/public/src/images/victory/victory1.jpg" alt="">
                        <div class="articles-box">
                            <div class="articles-head">Важность помощи ближнему</div>
                            <div class="articles-text dots">
                                Помощь другим — это одна из основных человеческих ценностей.
                                Она играет ключевую роль в укреплении социальных связей
                                и создании сплоченного общества.
                            </div>
                            <div class="articles-date">11.08.2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
