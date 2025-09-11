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
            <div class="columns">
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
                <div class="column">
                    <div class="projects swiper-container swiper1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide projects-slide">
                                <img src="/public/src/images/projects/project1.jpg" alt="">
                            </div>
                            <div class="swiper-slide projects-slide">
                                <img src="/public/src/images/projects/project1.jpg" alt="">
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
            			<div class="swiper-button-next"></div>
            			<div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
