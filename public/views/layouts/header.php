<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?= $this->getParam('title') ?></title>
	<meta name="description" content="<?= $this->getParam('description') ?>" >
	<meta name="keywords" content="<?= $this->getParam('keywords') ?>" >

	<meta property="og:type" content="website" />
	<meta property="og:title" content= "<?= $this->getParam('title') ?>">
	<meta property="og:url" content= "https://<?= $_SERVER['SERVER_NAME'] ?>/<?= URI ?>">
	<meta property="og:description" content= "<?= $this->getParam('description') ?>">
	<meta property="og:image" content = "https://<?= $_SERVER['SERVER_NAME'] ?>/public/src/images/logo.svg">

	<link rel="shortcut icon" href="/public/src/images/favicon.png" />

	<link href="/public/src/css/style.css?<?= time() ?>" rel="stylesheet" />
</head>
<body class="<?= !empty($this->body_class) ? $this->body_class : '' ?>">
	<header>
		HEADER
	</header>
