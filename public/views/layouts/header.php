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

	<link rel="shortcut icon" href="/public/src/images/favicon.png" />

	<link href="/public/src/css/style.css?<?= time() ?>" rel="stylesheet" />
</head>
<body class="<?= !empty($this->body_class) ? $this->body_class : '' ?>">
	<header class="header">
		<div class="container">
			<nav class="nav">
				<? foreach ($this->pages AS $page) : ?>
		            <? if ($page->menu <> 1 || !empty($page->parent)) continue; ?>
					<div class="nav-item"><?= $page->name ?></div>
		        <? endforeach; ?>
			</nav>
		</div>
	</header>
