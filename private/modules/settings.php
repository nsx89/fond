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

    $obj = FileUpload::deleteImageFile($obj);

    $obj->save();

    FileUpload::uploadImage('image', get_class($obj), 'image', $obj->id, 108, 108, '/public/src/images/settings/', 0);
    FileUpload::uploadImage('image2', get_class($obj), 'image2', $obj->id, 957, 953, '/public/src/images/settings/', 0);
    FileUpload::uploadImage('image3', get_class($obj), 'image3', $obj->id, 1920, 818, '/public/src/images/settings/', 1);
    FileUpload::uploadFile('logo', get_class($obj), 'logo', $obj->id, '/public/src/files/settings/');
    FileUpload::uploadFile('logo2', get_class($obj), 'logo2', $obj->id, '/public/src/files/settings/');

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
                <legend>Логотип</legend>
                <?= Form::makeFile('Логотип (211x202px)', 'logo', $obj, '') ?>
                <?= Form::makeFile('Логотип крупный (332x318px)', 'logo2', $obj, '') ?>
            </fieldset>
            <fieldset class="input_block">
                <legend>Оплата</legend>
                <?= Form::makeImage('Картинка QR кода (108x108px)', 'image', $obj) ?>
                <?= Form::makeInput('Ссылка', 'link', $obj->link) ?>
                <?= Form::makeInput('Ссылка «Оплата по реквизитам»', 'link2', $obj->link2) ?>
            </fieldset>
            <fieldset class="input_block">
                <legend>Блоки на главной</legend>
                <?= Form::makeInput('Заголовок перед Видео', 'head', $obj->head) ?>
                <fieldset class="input_block">
                    <legend>Блок оплаты</legend>
                    <?= Form::makeImage('Фото слева от блока оплаты (957x953px)', 'image2', $obj) ?>
                    <div class="columns">
                        <?= Form::makeInput('Заголовок справа в блоке оплаты', 'head2', $obj->head2) ?>
                        <?= Form::makeInput('Заголовок справа в блоке оплаты (красный)', 'head3', $obj->head3) ?>
                    </div>
                </fieldset>
                <fieldset class="input_block">
                    <legend>Блок документы</legend>
                    <div class="columns">
                        <?= Form::makeInput('Заголовок перед документами', 'head4', $obj->head4) ?>
                        <?= Form::makeInput('Заголовок перед документами (красный)', 'head5', $obj->head5) ?>
                    </div>
                    <?= Form::makeTextarea('Краткое описание перед документами', 'short', $obj->short, 80) ?>
                </fieldset>
                <fieldset class="input_block">
                    <legend>Блок ссылок</legend>
                    <div class="columns">
                        <?= Form::makeInput('Заголовок перед блоком с ссылками', 'head6', $obj->head6) ?>
                        <?= Form::makeInput('Заголовок перед блоком с ссылками (красный)', 'head7', $obj->head7) ?>
                    </div>
                </fieldset>
                <fieldset class="input_block">
                    <legend>Блок партнеры</legend>
                    <?= Form::makeInput('Заголовок перед партнерами', 'head8', $obj->head8) ?>
                </fieldset>
                <fieldset class="input_block">
                    <legend>Статьи</legend>
                    <div class="columns">
                        <?= Form::makeInput('Заголовок перед статьями', 'head9', $obj->head9) ?>
                        <?= Form::makeInput('Заголовок перед статьями', 'head10', $obj->head10) ?>
                    </div>
                </fieldset>
                <fieldset class="input_block">
                    <legend>Контакты</legend>
                    <div class="columns">
                        <?= Form::makeInput('Заголовок перед контактами', 'head11', $obj->head11) ?>
                        <?= Form::makeInput('Подзаголовок перед контактами', 'head12', $obj->head12) ?>
                    </div>
                    <?= Form::makeImage('Картинка фона (1920x818px)', 'image3', $obj) ?>
                </fieldset>
            </fieldset>
            <fieldset class="input_block">
                <legend>Ссылки на социальные сети</legend>
                <div class="columns">
                    <?= Form::makeInput('Telegram. Ссылка', 'soc1', $obj->soc1) ?>
                    <?= Form::makeInput('Telegram. Название', 'soc_name1', $obj->soc_name1) ?>
                </div>
                <div class="columns">
                    <?= Form::makeInput('Вконтакте. Ссылка', 'soc2', $obj->soc2) ?>
                    <?= Form::makeInput('Вконтакте. Название', 'soc_name2', $obj->soc_name2) ?>
                </div>
            </fieldset>
            <fieldset class="input_block">
                <legend>Тексты в подвале</legend>
                <div class="columns">
                    <?= Form::makeInput('Копирайт', 'copy', $obj->copy) ?>
                    <?= Form::makeInput('Копирайт2', 'copy2', $obj->copy2) ?>
                </div>
            </fieldset>
         <?= Form::makeSubmit(1,1, 'Сохранить',null) ?>
        </form>
    </div>

<?php endif; ?>
