<?php

ini_set("session.cookie_secure", 1);

session_start();

define('ROOT', __DIR__);

ini_set('error_reporting', 0);

/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/

require ROOT.'/vendor/autoload.php';

spl_autoload_register(function ($class) {
	require_once ROOT.'/'.str_replace('\\', '/', $class).'.php';
});

define('URI', app\Router::getURI());

// определяем ссылку и в роутере перенаправляем на нужный контроллер, правила описаны в файле config.php
// контроллеры находятся в папке app/Controllers
// основной контроллер для всех страниц сайта PageController

// если запрос ajax
define('AJAX', strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ? true : false);

// папка с вьюхами
define('VIEWS', ROOT.'/public/views');

(new app\Router())->run();
