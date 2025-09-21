<?php
use app\Models\Medals;
use app\Helpers;
use app\FileUpload;
use app\Form;

$add = 'медали';

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Medals();
    $obj->show = 1;

    $id = $_GET['edit'] ?? false;

    if ($id) $obj = Medals::findById($id);
    ?>
    <h1><?= $id ? "Редактирование $add" : "Добавление $add" ?></h1>
    <a href='/<?= URI ?>' class='edit_links'>Назад к списку</a>
    <a href='/<?= URI ?>?add' class='edit_links'>Добавить</a>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form' enctype='multipart/form-data'>
            <div class='flex top'>
                <?= Form::makeCheckbox('show', $obj->show, 'Показывать', 1) ?>
            </div>
            <?= Form::makeInput('Название', 'name', $obj->name, true) ?>
            <?= Form::makeInput('Рейтинг', 'rate', !empty($obj->rate) ? $obj->rate : '') ?>
            <?= Form::makeSubmit($id, $obj->id, 'Сохранить','') ?>
        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :

    $obj = new Medals();

    if (isset($_POST['edit'])) {
        $_SESSION['notice'] = 'Сохранено';
        $obj = Medals::findById($_POST['edit']);
    }
    else {
        $_SESSION['notice'] = 'Добавлено';
    }

    $obj->show = (int)$_POST['show'];
    $obj->name = trim($_POST['name']);
    $obj->rate = (int)$_POST['rate'];
    $obj->save();

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;
elseif (isset($_GET['delete'])) :

    $obj = Medals::findById($_GET['delete']);
    $obj->delete();

    $_SESSION['notice'] = 'Удалено';

    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;
else :
    $title = 'Медали';
    $filter = true;
    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `name` like '%{$search}%'";
    }

    $data = Medals::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
    $total = $data['total'];
    $paginate = $data['paginate'];
    $list = $data['list'];
    if (!empty($list)):?>
        <div class="total">Общее количество: <?= $total ?></div>
        <div class='list'>
            <?foreach ($list as $item):?>

                <?= Form::makeItem($item, $item->name, [], true, true) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?
    endif;
endif;
