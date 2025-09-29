<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?= $this->title ?></title>
	<meta name="description" content="<?= $this->description ?>" >
	<meta name="keywords" content="<?= $this->keywords ?>" >

	<meta property="og:type" content="website" />
	<meta property="og:title" content= "<?= $this->title ?>">
	<meta property="og:url" content= "https://<?= $_SERVER['SERVER_NAME'] ?>/<?= URI ?>">
	<meta property="og:description" content= "<?= $this->description ?>">
	<meta property="og:image" content = "https://<?= $_SERVER['SERVER_NAME'] ?>/public/src/images/logo.svg">

	<link rel="preload" href="/public/src/fonts/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/public/src/fonts/Inter-Bold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/public/src/fonts/Inter-Light.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/public/src/fonts/Inter-Thin.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/public/src/fonts/BebasNeue.woff2" as="font" type="font/woff2" crossorigin>

	<link rel="shortcut icon" href="/public/src/images/favicon.png" />

	<link href="/public/src/css/style.css?<?= time() ?>" rel="stylesheet" />
</head>
<body class="<?= !empty($this->body_class) ? $this->body_class : '' ?>">
	<div class="wrapper">
		<a href="/" class="logo header-logo" style="background: url(<?= $this->settings->logo ?>) no-repeat center center;"></a>
		<header class="header">
			<div class="container">
				<div class="header-menu">
					<a href="/" class="logo header-info-logo" style="background: url(<?= $this->settings->logo ?>) no-repeat center center;"></a>
					<nav class="header-nav">
						<? $i = 1; foreach ($this->pages AS $page) : ?>
				            <? if ($page->menu <> 1 || !empty($page->parent) || $i > 7) continue; ?>
							<a href="/<?= $page->url ?>" class="header-nav-item <?= URI == $page->url ? 'active' : '' ?>">
								<?= $page->name ?>
							</a>
				        <? $i++; endforeach; ?>
					</nav>
					<div class="header-info">
						<? if (!empty($this->settings->phone)) : ?>
							<a href="tel:<?= app\Helpers::clearPhone($this->settings->phone) ?>" class="phone"><?= $this->settings->phone ?></a>
						<? endif; ?>
						<? if (!empty($this->settings->soc1)) : ?>
							<a class="soc soc1" href="<?= $this->settings->soc1 ?>" target="_blank" rel="nofollow" title="Наш Telegram"></a>
						<? endif; ?>
						<? if (!empty($this->settings->soc2)) : ?>
							<a class="soc soc2" href="<?= $this->settings->soc2 ?>" target="_blank" rel="nofollow" title="Наш Вконтакте"></a>
						<? endif; ?>
						<div class="mobile-menu-btn js-mobile-menu-btn"><span></span></div>
					</div>
				</div>
			</div>
		</header>
		<div class="mobile-menu">
			<div class="mobile-menu-content">
				<div class="container mobile-menu-header">
					<div class="header-menu">
						<a href="/" class="logo header-info-logo" style="background: url(<?= $this->settings->logo ?>) no-repeat center center;"></a>
						<div class="header-info">
							<? if (!empty($this->settings->phone)) : ?>
								<a href="tel:<?= app\Helpers::clearPhone($this->settings->phone) ?>" class="phone"><?= $this->settings->phone ?></a>
							<? endif; ?>
							<? if (!empty($this->settings->soc1)) : ?>
								<a class="soc soc1" href="<?= $this->settings->soc1 ?>" target="_blank" rel="nofollow" title="Наш Telegram"></a>
							<? endif; ?>
							<? if (!empty($this->settings->soc2)) : ?>
								<a class="soc soc2" href="<?= $this->settings->soc2 ?>" target="_blank" rel="nofollow" title="Наш Вконтакте"></a>
							<? endif; ?>
							<div class="mobile-menu-btn active js-mobile-menu-btn"><span></span></div>
						</div>
					</div>
				</div>
				<div class="mobile-menu-links">
					<? $i = 1; foreach ($this->pages AS $page) : ?>
						<? if ($page->menu <> 1 || !empty($page->parent) || $i > 7) continue; ?>
						<a href="/<?= $page->url ?>" class="mobile-menu-link <?= URI == $page->url ? 'active' : '' ?>">
							<?= $page->name ?>
						</a>
					<? $i++; endforeach; ?>
				</div>
				<div class="footer-info">
					<? if (!empty($this->settings->phone)) : ?>
						<a href="tel:<?= app\Helpers::clearPhone($this->settings->phone) ?>" class="phone"><?= $this->settings->phone ?></a>
					<? endif; ?>
					<? if (!empty($this->settings->email)) : ?>
						<div><a href="mailto:<?= $this->settings->email ?>" class="email"><?= $this->settings->email ?></a></div>
					<? endif; ?>
					<div class="mobile-footer-copy">© <?= $this->settings->copy ?> <?= date('Y') ?>. <?= $this->settings->copy2 ?></div>
				</div>
			</div>
		</div>
