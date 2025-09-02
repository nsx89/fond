<?php

use app\Models\Settings;
use app\FileUpload;
use app\Helpers;
use app\Form;

$title = 'Настройки';
$add = false;
$filter = false;

include ROOT . '/private/views/layouts/head.php';

$obj = Settings::findById(1);

if (isset($_POST['edit'])) :

    unset($_POST['edit']);

    foreach ($_POST as $name => $value) {
        if (is_array($value)) continue;
         $obj->$name = trim($value);
    }

    $obj->save();

    FileUpload::uploadFile('logo', get_class($obj), 'logo', $obj->id, '/public/src/files/settings/');

    $_SESSION['notice'] = 'Сохранено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else: ?>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form' enctype='multipart/form-data'>
            <fieldset class="input_block">
                <legend>Основные настройки</legend>
                <?= Form::makeInput('Название сайта', 'title', $obj->title) ?>
            </fieldset>
            <fieldset class="input_block">
                <legend>Контактная информация</legend>
                <?= Form::makeInput('Email для отображения на сайте', 'email', $obj->email) ?>
                <?= Form::makeInput('Email для сообщений с сайта', 'email_send', $obj->email_send) ?>
                <?= Form::makeInput('Телефон', 'phone', $obj->phone) ?>
            </fieldset>
            <fieldset class="input_block">
                <legend>Ссылки на социальные сети</legend>
                <?= Form::makeInput('Telegram', 'soc1', $obj->soc1) ?>
                <?= Form::makeInput('Youtube', 'soc2', $obj->soc2) ?>
                <?= Form::makeInput('Дзен', 'soc3', $obj->soc3) ?>
            </fieldset>
         <?= Form::makeSubmit(1,1, 'Сохранить',null) ?>
        </form>
    </div>

<?php endif; ?>
