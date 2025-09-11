<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
	<header class="header">
		<div class="container">
			<nav class="header-nav">
				<? foreach ($this->pages AS $page) : ?>
		            <? if ($page->menu <> 1 || !empty($page->parent)) continue; ?>
					<a href="/<?= $page->url ?>" class="header-nav-item <?= URI == $page->url ? 'active' : '' ?>">
						<?= $page->name ?>
					</a>
		        <? endforeach; ?>
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
			</div>
		</div>
	</header>
