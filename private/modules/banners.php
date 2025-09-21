<?php

use app\Models\Page;
use app\Models\Banners;
use app\Models\Users;
use app\Helpers;
use app\FileUpload;
use app\Form;

$add = 'баннера';

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Banners();
    $obj->show = 1;

    $id = $_GET['edit'] ?? false;

    if ($id) $obj = Banners::findById($id);
    ?>
    <h1><?= $id ? "Редактирование $add" : "Добавление $add" ?></h1>
    <a href='/<?= URI ?>' class='edit_links'>Назад к списку</a>
    <a href='/<?= URI ?>?add' class='edit_links'>Добавить</a>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form' enctype='multipart/form-data'>
            <div class='flex top'>
                <?= Form::makeCheckbox('show', $obj->show, 'Показывать', 1) ?>
            </div>
            <?= Form::makeTextarea('Заголовок', 'name', $obj->name, 60) ?>
            <?= Form::makeTextarea('Заголовок2', 'name2', $obj->name2, 60) ?>
            <?= Form::makeImage('Баннер (1920x901px)', 'image', $obj) ?>
            <?= Form::makeInput('Рейтинг', 'rate', !empty($obj->rate) ? $obj->rate : '') ?>
            <?= Form::makeSubmit($id, $obj->id, 'Сохранить','') ?>
        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :

    $obj = new Banners();

    if (isset($_POST['edit'])) {
        $_SESSION['notice'] = 'Сохранено';
        $obj = Banners::findById($_POST['edit']);
    }
    else {
        $_SESSION['notice'] = 'Добавлено';
    }

    $obj->show = (int)$_POST['show'];
    $obj->name = trim($_POST['name']);
    $obj->name2 = trim($_POST['name2']);
    $obj->rate = (int)$_POST['rate'];

    $obj = FileUpload::deleteImageFile($obj);

    $obj->save();

    FileUpload::uploadImage('image', get_class($obj), 'image', $obj->id, 1920, 901, '/public/src/images/banners/', 0);

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;
elseif (isset($_GET['delete'])) :

    $obj = Banners::findById($_GET['delete']);
    unlink(ROOT.$obj->image);

    $obj->delete();

    $_SESSION['notice'] = 'Удалено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else :
    $title = 'Баннеры';
    $filter = true;
    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `name` like '%{$search}%'";
    }

    $data = Banners::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
    $total = $data['total'];
    $paginate = $data['paginate'];
    $list = $data['list'];
    if (!empty($list)):?>
        <div class="total">Общее количество: <?= $total ?></div>
        <div class='list'>
            <?foreach ($list as $item):?>

                <?
                $rate = '';
                if (!empty($item->rate)) $rate = 'Рейтинг: '.$item->rate;

                if (!empty($item->image)) $image = $item->image;
                else $image = '/publis/src/images/no-photo.jpg';
                ?>

                <?= Form::makeItem($item, $item->name, [$rate], $item->id > 1, $item->id > 1, $image) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?
    endif;
endif;
