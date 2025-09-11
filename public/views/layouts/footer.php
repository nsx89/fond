    <footer class="footer">
        <div class="container">
            <a href="/" class="logo"></a>
            <div class="footer-center">
                <div class="footer-menu">
                    <?
                    $count = !empty($this->footer_menu) ? count($this->footer_menu) : 0;
                    $count_columns = ceil($count / 4);
                    ?>
                    <div class="footer-menu-column">
        				<? $i = 1; foreach ($this->footer_menu AS $page) : ?>
        					<a href="/<?= $page->url ?>" class="footer-menu-item <?= URI == $page->url ? 'active' : '' ?>">
                                <?= $page->name ?>
                            </a>
                            <? if ($i % $count_columns == 0) : ?>
                                </div><div class="footer-menu-column">
                            <? endif; ?>
        		        <? $i++; endforeach; ?>
                    </div>
    			</div>
                <div class="footer-copy">© <?= $this->settings->copy ?> <?= date('Y') ?>. <?= $this->settings->copy2 ?></div>
            </div>
            <div class="footer-info">
                <? if (!empty($this->settings->phone)) : ?>
					<a href="tel:<?= app\Helpers::clearPhone($this->settings->phone) ?>" class="phone"><?= $this->settings->phone ?></a>
				<? endif; ?>
                <? if (!empty($this->settings->email)) : ?>
					<div><a href="mailto:<?= $this->settings->email ?>" class="email"><?= $this->settings->email ?></a></div>
				<? endif; ?>
                <div class="socs">
    				<? if (!empty($this->settings->soc1)) : ?>
    					<a class="soc soc1" href="<?= $this->settings->soc1 ?>" target="_blank" rel="nofollow" title="Наш Telegram"></a>
    				<? endif; ?>
    				<? if (!empty($this->settings->soc2)) : ?>
    					<a class="soc soc2" href="<?= $this->settings->soc2 ?>" target="_blank" rel="nofollow" title="Наш Вконтакте"></a>
    				<? endif; ?>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="/public/src/js/lib/jquery.js"></script>
    <script src="/public/src/js/lib/swiper.js"></script>
    <script src="/public/src/js/lib/swal.js"></script>
    <script defer src="/public/src/js/app.js?<?= time() ?>"></script>
    <!-- // -->

</body>

</html>
