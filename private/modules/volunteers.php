<?php

use app\Models\Page;
use app\Models\Volunteers;
use app\Models\Users;
use app\Models\Medal;
use app\Helpers;
use app\FileUpload;
use app\Form;

$add = 'волонтера';
$page = Page::findById(7);

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Volunteers();
    $obj->show = 1;

    $id = $_GET['edit'] ?? false;

    if ($id) $obj = Volunteers::findById($id);
    ?>
    <h1><?= $id ? "Редактирование $add" : "Добавление $add" ?></h1>
    <a href='/<?= URI ?>' class='edit_links'>Назад к списку</a>
    <a href='/<?= URI ?>?add' class='edit_links'>Добавить</a>
    <? if (!empty($obj)) : ?>
        <a href='/<?= $page->url ?>/<?= trim($obj->url, '/') ?>' target='_blank' class='edit_links'>Смотреть на сайте</a>
    <? endif; ?>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form' enctype='multipart/form-data'>
            <div class='flex top'>
                <?= Form::makeCheckbox('show', $obj->show, 'Показывать', 1) ?>
            </div>
            <?= Form::makeInput('Название', 'name', $obj->name, true) ?>
            <fieldset>
                <legend>Превью</legend>
                <?= Form::makeImage('Картинка для превью (281x259px)', 'image', $obj) ?>
                <?= Form::makeTextarea('Краткое описание', 'short', $obj->short, 90) ?>
                <?= Form::makeMultiple('Медали', 'medals', Medal::findWhere("ORDER BY rate DESC, name ASC"), $obj->medals) ?>
            </fieldset>
            <?= Form::makeInput('Рейтинг', 'rate', !empty($obj->rate) ? $obj->rate : '') ?>
            <?= Form::makeSubmit($id, $obj->id, 'Сохранить','') ?>
        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :

    $obj = new Volunteers();

    if (isset($_POST['edit'])) {
        $_SESSION['notice'] = 'Сохранено';
        $obj = Volunteers::findById($_POST['edit']);
    }
    else {
        $_SESSION['notice'] = 'Добавлено';
    }

    $obj->show = (int)$_POST['show'];
    $obj->name = trim($_POST['name']);
    $obj->rate = (int)$_POST['rate'];
    $obj->short = trim($_POST['short']);

    $url = trim($_POST['url']) ?: Helpers::str2url($obj->name);
    if(!empty($url)) {
        $other = Volunteers::findWhere("WHERE url='{$url}' AND id <> '{$obj->id}' LIMIT 1");
        if (!empty($other)) {
            if (empty($obj->id)) $obj->save();
            $url = $url.'-'.$obj->id;
        }
    }
    $obj->url = $url;

    $obj = FileUpload::deleteImageFile($obj);

    $obj->medals = !empty($_POST['medals']) ? '|'.implode('|', $_POST['medals']).'|' : null;

    $obj->save();

    FileUpload::uploadImage('image', get_class($obj), 'image', $obj->id, 281, 259, '/public/src/images/volunteers/', 0);

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;
elseif (isset($_GET['delete'])) :

    $obj = Volunteers::findById($_GET['delete']);
    unlink(ROOT.$obj->image);

    FileUpload::deleteGalleryType('Volunteers', $obj->id);

    $obj->delete();

    $_SESSION['notice'] = 'Удалено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else :
    $title = 'Волонтеры';
    $filter = true;
    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `name` like '%{$search}%'";
    }

    $data = Volunteers::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
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

                <?= Form::makeItem($item, $item->name, [$rate], true, true, $image) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?
    endif;
endif;
