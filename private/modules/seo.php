<?php

use app\Models\Seo;
use app\Form;

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $seo = new Seo();

    $id = $_GET['edit'] ?? false;

    if ($id) {
        $seo = Seo::findById($id);
    }

    if(isset($_GET['add']) && isset($_GET['url'])) $seo->url = $_GET['url'];

    ?>
    <h1><?= $id ? "Редактирование SEO: $seo->url" : 'Добавление SEO' ?></h1>
    <a href='/<?= URI ?>' class='edit_links'>Назад к списку</a>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form'
              enctype='multipart/form-data'>

            <?= Form::makeInput('Ссылка', 'url', $seo->url, 0, '','','') ?>
            <?= Form::makeInput('Title', 'title', $seo->title, 0, '','','') ?>
            <?= Form::makeInput('Keywords', 'keywords', $seo->keywords, 0, '','','') ?>
            <?= Form::makeInput('Description', 'description', $seo->description, 0, '','','') ?>
            <?= Form::makeSubmit($id, $seo->id, 'Сохранить','') ?>

        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :

    $seo = new Seo();

    if (isset($_POST['edit'])) {
        $_SESSION['notice'] = 'Сохранено';
        $seo = Seo::findById($_POST['edit']);
    } else {
        $_SESSION['notice'] = 'Добавлено';
    }

    $seo->url = trim($_POST['url']);
    $seo->title = trim($_POST['title']);
    $seo->keywords = trim($_POST['keywords']);
    $seo->description = trim($_POST['description']);

    $seo->save();

    header("Location: {$_SERVER['REQUEST_URI']}?edit=$seo->id");
    exit;
elseif (isset($_GET['delete'])) :

    $seo = Seo::findById($_GET['delete']);

    $seo->delete();
    $_SESSION['notice'] = 'Удалено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else :
    $title = 'SEO';
    $add = 'SEO';

    $filter = true;

    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `url` like '%{$search}%'";
    }

    $data = Seo::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
    $total = $data['total'];
    $paginate = $data['paginate'];
    $list = $data['list'];
    if (!empty($list)): ?>
        <div class="total">Общее количество: <?= $total ?></div>
        <div class='list'>
            <? foreach ($list as $item): ?>
               <?
               $txt = array();
               $txt[] = 'Title: '.$item->title;
               $txt[] = 'Keywords: '.$item->keywords;
               $txt[] = 'Description: '.$item->description;
               ?>

               <?= Form::makeItem($item, $item->url, $txt, true, false) ?>

            <? endforeach; ?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found'>Ничего не найдено</div>
    <?php
    endif;

endif;
