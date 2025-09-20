<?php

use app\Models\Page;
use app\Models\Articles;
use app\Models\Users;
use app\Models\Gallery;
use app\Helpers;
use app\FileUpload;
use app\Form;

$add = 'статьи';

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Articles();
    $obj->show = 1;

    $id = $_GET['edit'] ?? false;

    if ($id) $obj = Articles::findById($id);

    $page = Page::findById(6);
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
            <?= Form::makeImage('Картинка для превью (585x310px)', 'image', $obj) ?>
            <?= Form::makeTextarea('Краткое описание', 'short', $obj->short, 90) ?>
            <?= Form::makeInput('Дата', 'date', !empty($obj->date) ? date('Y-m-d', $obj->date) : date('Y-m-d'), false, 'date') ?>
            <?= Form::makeTextbox('Текст', 'text', $obj->text) ?>
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
    $obj->rate = (int)$_POST['rate'];
    $obj->short = trim($_POST['short']);
    $obj->text = trim($_POST['text']);

    $obj->date = !empty($_POST['date']) ? strtotime($_POST['date'].' 00:00') : null;

    $url = trim($_POST['url']) ?: Helpers::str2url($obj->name);
    if(!empty($url)) {
        $other = Articles::findWhere("WHERE url='{$url}' AND id <> '{$obj->id}' LIMIT 1");
        if (!empty($other)) {
            if (empty($other->id)) $other->save();
            $url = $url.'-'.$other->id;
        }
    }
    $obj->url = $url;

    $obj = FileUpload::deleteImageFile($obj);

    $obj->save();

    FileUpload::uploadImage('image', get_class($obj), 'image', $obj->id, 585, 310, '/public/src/images/articles/', 0);

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;
elseif (isset($_GET['delete'])) :

    $obj = Articles::findById($_GET['delete']);
    unlink(ROOT.$obj->image);

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
                    $link = "/".$item->url;
                    if ($item->id == 1) $link = '/';
                    $url = "Ссылка: <a href='{$link}' target='_blank'>{$link}</a>";
                }

                $rate = '';
                if (!empty($item->rate)) $rate = 'Рейтинг: '.$item->rate;
                ?>

                <?= Form::makeItem($item, $item->name, [$url, $rate], true, true) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?
    endif;
endif;
