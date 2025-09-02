<?php

use app\Models\Users_ip;
use app\Helpers;
use app\FileUpload;
use app\Form;

$add = 'IP адреса';

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Users_ip();
    $obj->show = 1;

    $id = $_GET['edit'] ?? false;

    if ($id) $obj = Users_ip::findById($id);
    ?>
    <h1><?= $id ? "Редактирование $add:" : "Добавление $add" ?></h1>
    <a href='/<?= URI ?>' class='edit_links'>Назад к списку</a>
    <? if (!empty($obj)) : ?>
        <a href='/<?= trim($obj->url, '/') ?>' target='_blank' class='edit_links'>Смотреть на сайте</a>
    <? endif; ?>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form' enctype='multipart/form-data'>
            <?= Form::makeInput('IP адрес', 'name', $obj->name) ?>
            <?= Form::makeTextarea('Комментарий', 'text', $obj->text, null, 'compact') ?>
            <?= Form::makeSubmit($id, $obj->id, 'Сохранить','') ?>
        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :

    $obj = new Users_ip();

    if (isset($_POST['edit'])) {
        $_SESSION['notice'] = 'Сохранено';
        $obj = Users_ip::findById($_POST['edit']);
    }
    else {
        $_SESSION['notice'] = 'Добавлено';
    }

    $obj->name = trim($_POST['name']);
    $obj->text = trim($_POST['text']);
    $obj->save();

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;
elseif (isset($_GET['delete'])) :

    $obj = Users_ip::findById($_GET['delete']);
    $obj->delete();

    $_SESSION['notice'] = 'Удалено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else :
    $title = 'Разрешённые IP адреса для входа';
    $filter = true;
    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `name` like '%{$search}%'";
    }

    $data = Users_ip::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
    $total = $data['total'];
    $paginate = $data['paginate'];
    $list = $data['list'];
    if (!empty($list)):?>
        <div class="total">Общее количество: <?= $total ?></div>
        <div class='list'>
            <?foreach ($list as $item):?>

                <?= Form::makeItem($item, $item->name, [$item->text], true, false, false, false) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?php
    endif;

endif;
