<? include_once VIEWS.'/layouts/header.php' ?>

<main>
    <div class="logo"></div>

    <section class="main">
        <div class="container">
            <div class="main-text">
                Помогаем фронту<br> и заботимся<br> <span>о героях</span>
            </div>
            <div class="button-wrap">
                <button class="button">Поддержать</button>
                <img class="main-qr" src="/public/src/images/qr.png" alt=">Поддержать">
            </div>
        </div>
    </section>

    <section class="main-projects">
        <div class="container">
            <div class="columns main-projects-columns">
                <div class="column main-projects-eagle">
                    <h2 class="h2 h2-quot">О проекте</h2>
                    <div class="main-projects-text">
                        <p>
                            Фонд был основан для того, чтобы каждый из нас мог внести свою лепту
                            в достижение Победы и спасение жизней наших защитников, которые
                            в данный момент подвергают свои жизни и здоровье большому риску.
                        </p>
                        <strong>
                            Мы являемся мостом между теми, кто хочет
                            оказать помощь, и военнослужащими, нуждающимися в поддержке.
                        </strong>
                        <p>
                            Каждая отправленная на фронт партия гуманитарной
                            помощи, каждый переведенный рубль и каждое
                            поддерживающее слово приближают нас к Победе.
                        </p>
                        <div class="button-wrap">
                            <button class="button">Хочу поддержать</button>
                        </div>
                    </div>
                </div>
                <div class="column projects">
                    <div class="swiper-container swiper1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/public/src/images/projects/project1.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/public/src/images/projects/project1.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/public/src/images/projects/project1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-prev-swiper1"></div>
                    <div class="swiper-button-next swiper-button-next-swiper1"></div>
                    <div class="swiper-pagination swiper-pagination-swiper1"></div>
                </div>
            </div>
            <div class="videos-wrap">
                <h2 class="h2">Благодаря вам они получили помощь</h2>
                <div class="videos">
                    <div class="swiper-container swiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/public/src/images/video/video1.jpg" alt="">
                                <span class="video-play js-video-modal" title="Смотреть видео" data-video=""></span>
                            </div>
                            <div class="swiper-slide">
                                <img src="/public/src/images/video/video2.jpg" alt="">
                                <span class="video-play js-video-modal" title="Смотреть видео" data-video=""></span>
                            </div>
                            <div class="swiper-slide">
                                <img src="/public/src/images/video/video1.jpg" alt="">
                                <span class="video-play js-video-modal" title="Смотреть видео" data-video=""></span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-prev-swiper2"></div>
                    <div class="swiper-button-next swiper-button-next-swiper2"></div>
                    <div class="swiper-pagination swiper-pagination-swiper2"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="pay">
        <div class="pay-left"></div>
        <div class="pay-right">
            <div class="pay-form">
                <h2 class="h2">Как внести вклад <span>в общее дело</span></h2>
                <div class="pay-box">
                    <div class="pay-box-items">
                        <div class="pay-box-item" data-value="100">100<i>₽</i></div>
                        <div class="pay-box-item" data-value="500">500<i>₽</i></div>
                        <div class="pay-box-item" data-value="1000">1 000<i>₽</i></div>
                        <div class="pay-box-item" data-value="5000">5 000<i>₽</i></div>
                        <div class="pay-box-item" data-value="10000">10 000<i>₽</i></div>
                        <div class="pay-box-item" data-value="50000">50 000<i>₽</i></div>
                        <div class="pay-box-item pay-box-item-input placeholder-wrap">
                            <span class="placeholder">Другая сумма</span>
                            <input type="text" class="input js-input-number">
                        </div>
                    </div>
                    <button class="button">Отправить помощь</button>
                </div>
                <div class="pay-box pay-box-link">
                    <div class="pay-box-head">Оплата по <span>qr</span></div>
                    <img class="pay-box-qr" src="/public/src/images/qr.png" alt=">Оплата по qr">
                </div>
                <div class="pay-box pay-box-link">
                    <div class="pay-box-head">Оплата <span>по реквизитам</span></div>
                    <img class="pay-box-arrow" src="/public/src/images/svg/arrow-left.svg" alt=">Оплата по qr">
                </div>
            </div>
        </div>
    </section>

    <section class="main-back">
        <div class="container">

            <div class="columns">
                <div class="column">
                    <h2 class="h2 h2-back">Помогаем как делом <br><span>так и словом</span></h2>
                    <div class="main-back-text">
                        Официально ведем благотворительную деятельность и имеем все необходимые документы,
                        чтобы ежедневно быть рядом с теми, кто защищает страну и рискует жизнями ради ее безопасности
                    </div>
                </div>
                <div class="column main-back-logo-wrap">
                    <div class="main-back-logo"></div>
                </div>
            </div>

            <div class="documents">
                <div class="swiper-container swiper3">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="documents-head dots">Документ о регистрации фонда</div>
                            <div class="documents-text dots">Смотреть</div>
                            <img class="documents-img" src="/public/src/images/documents/1.jpg" alt="">
                            <div class="documents-arrow"></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="documents-head dots">Благодарственное письмо волонтерам фонда агодарственное письмо волонтерам фонда</div>
                            <div class="documents-text dots">От СГБУ «Центр содействия семейному воспитанию №15» >От СГБУ «Центр содействия семейному воспитанию №15»</div>
                            <img class="documents-img" src="/public/src/images/documents/2.jpg" alt="">
                            <div class="documents-arrow"></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="documents-head dots">Благодарственное письмо волонтерам фонда</div>
                            <div class="documents-text dots">От ЛОГБУ «Волосовский ПНИ»</div>
                            <img class="documents-img" src="/public/src/images/documents/3.jpg" alt="">
                            <div class="documents-arrow"></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="documents-head dots">Документ о регистрации фонда</div>
                            <div class="documents-text dots">Смотреть</div>
                            <img class="documents-img" src="/public/src/images/documents/1.jpg" alt="">
                            <div class="documents-arrow"></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev swiper-button-prev-swiper3"></div>
                <div class="swiper-button-next swiper-button-next-swiper3"></div>
                <div class="swiper-pagination swiper-pagination-swiper3"></div>
            </div>

            <div class="medication">
                <h2 class="h2">на благо героев <span>и будущего страны</span></h2>
                <div class="swiper-container swiper4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="medication-head">Документ о регистрации фонда</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="medication-head">Документ о регистрации фонда</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="medication-head">Документ о регистрации фонда</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev swiper-button-prev-swiper4"></div>
                <div class="swiper-button-next swiper-button-next-swiper4"></div>
                <div class="swiper-pagination swiper-pagination-swiper4"></div>
            </div>

        </div>
    </section>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
