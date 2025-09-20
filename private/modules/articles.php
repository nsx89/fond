<?php

use app\Models\Page;
use app\Models\Articles;
use app\Models\Users;
use app\Models\Gallery;
use app\Helpers;
use app\FileUpload;
use app\Form;

$add = 'статьи';
$page = Page::findById(6);

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Articles();
    $obj->show = 1;

    $id = $_GET['edit'] ?? false;

    if ($id) $obj = Articles::findById($id);
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
            <?= Form::makeInput('Ссылка (автоматически, если пусто)', 'url', $obj->url) ?>
            <fieldset>
                <legend>Превью</legend>
                <?= Form::makeImage('Картинка для превью (585x310px)', 'image', $obj) ?>
                <?= Form::makeTextarea('Краткое описание', 'short', $obj->short, 90) ?>
                <div class="columns">
                    <?= Form::makeInput('Дата', 'date', !empty($obj->date) ? date('Y-m-d', $obj->date) : date('Y-m-d'), false, 'date') ?>
                    <?= Form::makeInput('Время', 'time', !empty($obj->date) ? date('H:i', $obj->date) : date('H:i'), false, 'time') ?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Детальная страница</legend>
                <?= Form::makeTextarea('H1 (для детальной страницы, необязательно)', 'h1', $obj->h1, 60) ?>
                <?= Form::makeImage('Картинка детальная (980x440px)', 'image2', $obj) ?>
                <?= Form::makeTextbox('Текст', 'text', $obj->text) ?>
                <?= Form::makeInput('Автор', 'author', $obj->author) ?>
                <?= Form::makeMultiple('Блок «Читайте также» (по умолчанию автоматически другие статьи)', 'other', Articles::findWhere("WHERE `id` <> '".$obj->id."' ORDER BY name ASC"), $obj->other) ?>
            </fieldset>
            <?= Form::makeInput('Рейтинг', 'rate', !empty($obj->rate) ? $obj->rate : '') ?>
            <?= Form::makeSubmit($id, $obj->id, 'Сохранить','') ?>
        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :

    $obj = new Articles();

    if (isset($_POST['edit'])) {
        $_SESSION['notice'] = 'Сохранено';
        $obj = Articles::findById($_POST['edit']);
    }
    else {
        $_SESSION['notice'] = 'Добавлено';
    }

    $obj->show = (int)$_POST['show'];
    $obj->name = trim($_POST['name']);
    $obj->h1 = trim($_POST['h1']);
    $obj->rate = (int)$_POST['rate'];
    $obj->short = trim($_POST['short']);
    $obj->text = trim($_POST['text']);
    $obj->author = trim($_POST['author']);

    $time = trim($_POST['time']);
    if (empty($time)) $time = '00:00';
    $obj->date = !empty($_POST['date']) ? strtotime($_POST['date'].' '.$time) : null;

    $url = trim($_POST['url']) ?: Helpers::str2url($obj->name);
    if(!empty($url)) {
        $other = Articles::findWhere("WHERE url='{$url}' AND id <> '{$obj->id}' LIMIT 1");
        if (!empty($other)) {
            if (empty($obj->id)) $obj->save();
            $url = $url.'-'.$obj->id;
        }
    }
    $obj->url = $url;

    $obj->other = !empty($_POST['other']) ? '|'.implode('|', $_POST['other']).'|' : null;

    $obj = FileUpload::deleteImageFile($obj);

    $obj->save();

    FileUpload::uploadImage('image', get_class($obj), 'image', $obj->id, 585, 310, '/public/src/images/articles/', 0);
    FileUpload::uploadImage('image2', get_class($obj), 'image2', $obj->id, 980, 440, '/public/src/images/articles/', 1);

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;
elseif (isset($_GET['delete'])) :

    $obj = Articles::findById($_GET['delete']);
    unlink(ROOT.$obj->image);
    unlink(ROOT.$obj->image2);

    FileUpload::deleteGalleryType('articles', $obj->id);

    $obj->delete();

    $_SESSION['notice'] = 'Удалено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else :
    $title = 'Статьи';
    $filter = true;
    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `name` like '%{$search}%'";
    }

    $data = Articles::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
    $total = $data['total'];
    $paginate = $data['paginate'];
    $list = $data['list'];
    if (!empty($list)):?>
        <div class="total">Общее количество: <?= $total ?></div>
        <div class='list'>
            <?foreach ($list as $item):?>

                <?
                $url = "";
                if (!empty($item->url)) {
                    $link = '/'.$page->url.'/'.$item->url;
                    $url = "Ссылка: <a href='{$link}' target='_blank'>{$link}</a>";
                }

                $rate = '';
                if (!empty($item->rate)) $rate = 'Рейтинг: '.$item->rate;

                if (!empty($item->image)) $image = $item->image;
                else $image = '/publis/src/images/no-photo.jpg';

                $date = '';
                if (!empty($item->date)) $date = date('d.m.Y', $item->date);
                ?>

                <?= Form::makeItem($item, $item->name, [$url, $rate, $date], true, true, $image) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?
    endif;
endif;
