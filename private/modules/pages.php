<?php

use app\Models\Page;
use app\Models\Users;
use app\Models\Gallery;
use app\Helpers;
use app\FileUpload;
use app\Form;

$add = 'страницы';

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Page();
    $obj->show = 1;

    $id = $_GET['edit'] ?? false;

    if ($id) $obj = Page::findById($id);
    ?>
    <h1><?= $id ? "Редактирование $add" : "Добавление $add" ?></h1>
    <a href='/<?= URI ?>' class='edit_links'>Назад к списку</a>
    <a href='/<?= URI ?>?add' class='edit_links'>Добавить</a>
    <? if (!empty($obj)) : ?>
        <a href='/<?= trim($obj->url, '/') ?>' target='_blank' class='edit_links'>Смотреть на сайте</a>
    <? endif; ?>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form' enctype='multipart/form-data'>
            <div class='flex top'>
                <?= Form::makeCheckbox('show', $obj->show, 'Показывать', 1) ?>
            </div>
            <?= Form::makeCheckbox('menu', $obj->menu, 'Показывать в меню', 1) ?>
            <?= Form::makeCheckbox('menu_footer', $obj->menu_footer, 'Показывать в подвале', 1) ?>
            <?= Form::makeInput('Название', 'name', $obj->name, true) ?>
            <?= Form::makeInput('Ссылка (автоматически, если пусто)', 'url', $obj->url) ?>
            <? /* Form::makeSelect('Родительская страница', 'parent', Page::findWhere("WHERE `parent` = 0 AND `id` <> ".intval($id)." ORDER BY name ASC"), $obj->parent, true, '' , '') */ ?>
            <? switch ($obj->id) {
                case 1: ?>
                    <? break;
                default: ?>
                    <?= Form::makeTextbox('Текст', 'text', $obj->text) ?>
                    <? break;
            } ?>
            <?= Form::makeInput('Рейтинг', 'rate', !empty($obj->rate) ? $obj->rate : '') ?>
            <?= Form::makeInput('Рейтинг в подвале', 'rate_footer', !empty($obj->rate_footer) ? $obj->rate_footer : '') ?>
            <?= Form::makeSubmit($id, $obj->id, 'Сохранить','') ?>
        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :

    $obj = new Page();

    if (isset($_POST['edit'])) {
        $_SESSION['notice'] = 'Сохранено';
        $obj = Page::findById($_POST['edit']);
    }
    else {
        $_SESSION['notice'] = 'Добавлено';
    }

    $obj->show = (int)$_POST['show'];
    $obj->menu = (int)$_POST['menu'];
    $obj->menu_footer = (int)$_POST['menu_footer'];
    $obj->parent = (int)$_POST['parent'];
    $obj->name = trim($_POST['name']);
    $obj->rate = (int)$_POST['rate'];
    $obj->rate_footer = (int)$_POST['rate_footer'];
    $obj->text = trim($_POST['text']);

    $url = trim($_POST['url']) ?: Helpers::str2url($obj->name);
    if(!empty($url)) {
        $page = Page::findWhere("WHERE url='{$url}' AND id <> '{$obj->id}' LIMIT 1");
        if (!empty($page)) {
            if (empty($obj->id)) $obj->save();
            $url = $url.'-'.$obj->id;
        }
    }
    $obj->url = $url;

    $obj = FileUpload::deleteImageFile($obj);

    $obj->save();

    //FileUpload::uploadImage('image4', get_class($obj), 'image4', $obj->id, 256, 250, '/public/src/images/page/', 1);

    //FileUpload::uploadFile('file', get_class($obj), 'file', $obj->id, '/public/src/files/page/');

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;
elseif (isset($_GET['delete'])) :

    $obj = Page::findById($_GET['delete']);
    unlink(ROOT.$obj->image);
    unlink(ROOT.$obj->file);

    FileUpload::deleteGalleryType('page', $obj->id);

    $obj->delete();

    $_SESSION['notice'] = 'Удалено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else :
    $title = 'Страницы';
    $filter = true;
    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `name` like '%{$search}%'";
    }

    $data = Page::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
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

                $parent = '';
                if (!empty($item->parent)) {
                    $parent_page = Page::findById($item->parent);
                    if (!empty($parent_page)) {
                        $parent = 'Родительская страница: <strong>'.$parent_page->name.'</strong>';
                    }
                }
                $rate = '';
                if (!empty($item->rate)) $rate = 'Рейтинг: '.$item->rate;

                $menu = "";
                if (!empty($item->menu)) $menu = "<div style='color: rgb(118 195 79);'>Показывается в меню</div>";

                $menu_footer = "";
                if (!empty($item->menu_footer)) $menu_footer = "<div style='color: rgb(173 158 226);'>Показывается в подвале</div>";
                ?>

                <?= Form::makeItem($item, $item->name, [$parent, $url, $rate, $menu, $menu_footer], $item->id > 1, $item->id > 1) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?
    endif;
endif;
