<? include_once VIEWS.'/layouts/header.php' ?>

<main>

    <? foreach ($this->banners AS $banner) : ?>
        <section class="main" style="background: url(<?= $banner->image ?>) no-repeat top center; background-size: cover;">
            <div class="container">
                <div class="main-text">
                    <?= $this->edit_banners ?>
                    <?= nl2br($banner->name) ?><br> <span><?= nl2br($banner->name2) ?></span>
                </div>
                <? if (!empty($this->settings->link)) : ?>
                    <div class="button-wrap">
                        <a href="<?= $this->settings->link ?>" target="_blank" rel="nofollow" class="button">Поддержать</a>
                        <? if (!empty($this->settings->image)) : ?>
                            <img class="main-qr" src="<?= $this->settings->image ?>" alt=">Поддержать">
                        <? endif; ?>
                    </div>
                <? endif; ?>
            </div>
        </section>
    <? endforeach; ?>

    <section class="main-projects">
        <div class="container">
            <div class="columns main-projects-columns">
                <div class="column main-projects-eagle">
                    <?= $this->edit_project ?>
                    <h2 class="h2 h2-quot"><?= $this->pages[3]->name ?></h2>
                    <div class="main-projects-text">
                        <?= $this->pages[3]->short ?>
                        <? if (!empty($this->settings->link)) : ?>
                            <div class="button-wrap">
                                <a href="<?= $this->settings->link ?>" target="_blank" rel="nofollow" class="button">Хочу поддержать</a>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <div class="column projects">
                    <? $gallery = app\Models\Gallery::findGallery('page', $this->pages[3]->id, 10); ?>
                    <? if (!empty($gallery)) : ?>
                        <div class="swiper-container swiper1">
                            <div class="swiper-wrapper">
                                <? foreach ($gallery AS $photo) : ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $photo->image_small ?>" alt="<?= $this->pages[3]->name ?><?= $photo->id ?>">
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-button-prev swiper-button-prev-swiper1"></div>
                        <div class="swiper-button-next swiper-button-next-swiper1"></div>
                        <div class="swiper-pagination swiper-pagination-swiper1"></div>
                    <? endif; ?>
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

            <div class="medication-wrap">
                <h2 class="h2">на благо героев <span>и будущего страны</span></h2>
                <div class="medication">
                    <div class="swiper-container swiper4">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="medication-head dots">Лечение<br> и реабилитация</div>
                                <div class="medication-items">
                                    <span>лечение для военнослужащих</span>
                                    <span>медицинское обслуживание</span>
                                </div>
                                <img class="medication-img" src="/public/src/images/medication/medication1.png" alt="">
                                <div class="medication-link js-scroll-form">Отправить помощь</div>
                            </div>
                            <div class="swiper-slide">
                                <div class="medication-head">Передаем<br> гуманитарную помощь</div>
                                <div class="medication-items">
                                    <span>строительные материалы</span>
                                    <span>оптика</span>
                                    <span>генераторы</span>
                                    <span>технические средства</span>
                                    <span>технические средства</span>
                                    <span>технические средства</span>
                                </div>
                                <img class="medication-img" src="/public/src/images/medication/medication2.png" alt="">
                                <div class="medication-link js-scroll-form">Отправить помощь</div>
                            </div>
                            <div class="swiper-slide">
                                <div class="medication-head">Лечение и реабилитация</div>
                                <img class="medication-img" src="/public/src/images/medication/medication1.png" alt="">
                                <div class="medication-link js-scroll-form">Отправить помощь</div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-prev-swiper4"></div>
                    <div class="swiper-button-next swiper-button-next-swiper4"></div>
                    <div class="swiper-pagination swiper-pagination-swiper4"></div>
                </div>
            </div>

            <div class="partners-wrap">
                <h2 class="h2">Наши партнеры</h2>
                <div class="partners">
                    <div class="swiper-container swiper5">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner1.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner2.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner3.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner4.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner2.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner1.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner5.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner3.svg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="partners-img">
                                    <img src="/public/src/images/partners/partner4.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-prev-swiper5"></div>
                    <div class="swiper-button-next swiper-button-next-swiper5"></div>
                    <div class="swiper-pagination swiper-pagination-swiper5"></div>
                </div>
            </div>

        </div>
    </section>

    <? if (!empty($this->articles)) : ?>
        <section class="main-articles">
            <div class="container">
                <div class="h2-wrap">
                    <h2 class="h2">Приближаем победу <span>вместе</span></h2>
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
            </div>
        </section>
    <? endif; ?>

    <section class="main-contacts">
         <div class="contacts">
             <div class="container">
                 <h2 class="h2">Контакты</h2>
                 <div class="contacts-text">Поддержите тех, кто стоит на защите Родины</div>
                 <div class="contacts-box">
                     <? if (!empty($this->settings->phone)) : ?>
     					<a href="tel:<?= app\Helpers::clearPhone($this->settings->phone) ?>" class="contacts-box-item">
                            <span class="contacts-box-icon contacts-box-icon-phone"></span>
                            <span class="contacts-phone"><?= $this->settings->phone ?></span>
                        </a>
     				<? endif; ?>
                    <? if (!empty($this->settings->email)) : ?>
    					<a href="mailto:<?= $this->settings->email ?>" class="contacts-box-item">
                            <span class="contacts-box-icon contacts-box-icon-email"></span>
                            <span class="contacts-email"><?= $this->settings->email ?></span>
                        </a>
    				<? endif; ?>
                    <? if (!empty($this->settings->soc1)) : ?>
    					<a href="<?= $this->settings->soc1 ?>" target="_blank" rel="nofollow" title="Наш Telegram" class="contacts-box-item">
                            <span class="contacts-box-icon contacts-box-icon-soc1"></span>
                            <span class="contacts-soc contacts-soc1"><?= $this->settings->soc_name1 ?></span>
                        </a>
    				<? endif; ?>
    				<? if (!empty($this->settings->soc2)) : ?>
    					<a href="<?= $this->settings->soc2 ?>" target="_blank" rel="nofollow" title="Наш Вконтакте" class="contacts-box-item">
                            <span class="contacts-box-icon contacts-box-icon-soc2"></span>
                            <span class="contacts-soc contacts-soc2"><?= $this->settings->soc_name2 ?></span>
                        </a>
    				<? endif; ?>
                    <div class="contacts-button-wrap">
                        <button class="button">Пожертвования</button>
                        <img class="contacts-qr" src="/public/src/images/qr.png" alt=">Поддержать">
                    </div>
                 </div>
             </div>
         </div>
    </section>

</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
