<!doctype html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <title>Панель управления сайтом</title>
    <link rel='shortcut icon' href='/private/src/images/favicon.ico'>
    <link rel='stylesheet' href='/private/src/css/chosen.css?v=<?= rand() ?>'>
    <link rel='stylesheet' href='/private/src/css/main.css?v=<?= rand() ?>'>
</head>
<body>
<?php if (app\Models\Users::isAdmin()): ?>

    <header class='admin_header'>
        <div class='admin_logo'>
            <a href='/' target='_blank'><span>Перейти на сайт</span></a>
        </div>
        <div class='admin_control'>
            <span>Вы вошли как: <b><?= app\Models\Users::getLogin() ?></b></span>
            <span>Ваш IP: <b><?= app\Helpers::get_user_ip() ?></b></span>
            <a href='/admin/logout' class='admin_logout'>Выйти</a>
        </div>
    </header>

<?php endif;



if (!empty($_SESSION['notice'])) : ?>
    <div class='notice'>
        <div id='black' style='display: block; opacity: 0.4;'></div>
        <div id='alert' class='anime-mod'>
            <div id='alert_head'>Уведомление</div>
            <br>
            <?= $_SESSION['notice'] ?><br><br>
            <input type='button' value='OK' class='button_alert'>
        </div>
    </div>
    <?php $_SESSION['notice'] = '';
endif; ?>


<? if (!empty($_SESSION['error'])) : ?>
    <div class='notice error'>
        <div id='black' style='display: block; opacity: 0.4;'></div>
        <div id='alert' class='anime-mod'>
            <div id='alert_head'>Ошибка</div>
            <br>
            <?= $_SESSION['error'] ?><br><br>
            <input type='button' value='OK' class='button_alert'>
        </div>
    </div>
    <?php $_SESSION['error'] = '';
endif; ?>
