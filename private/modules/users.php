<?php
use app\Models\Users;
use app\Models\Users_class;
use app\Helpers;
use app\Form;

$add = 'пользователя';
$title = 'Пользователи';

if (isset($_GET['add']) || isset($_GET['edit'])) :

    $obj = new Users();
    $id = $_GET['edit'] ?? false;
    if ($id) $obj = Users::findById($id);

    ?>
    <h1><?= $id ? "Редактирование $add: $obj->login" : "Добавление $add" ?></h1>
    <a href='/<?= URI ?>' class='edit_links'>Назад к списку</a>
    <div class='admin_edit_block admin_scroll'>
        <form action='/<?= URI ?>' method='post' class='admin_edit_form'>
            <?= Form::makeLabel('Дата регистрации', !empty($obj->date) ? date('d.m.Y H:i', $obj->date) : '') ?>
            <?= Form::makeLabel('Дата последнего визита', !empty($obj->date_visit) ? date('d.m.Y H:i', $obj->date_visit) : '') ?>
            <br>
            <div class='flex2'>
                <?= Form::makeInput('Логин (E-mail)', 'login', $obj->login, true, '','','') ?>
                <?= Form::makeInput('Новый пароль', 'password', '', '', 'password','','') ?>
            </div>
            <?= Form::makeSubmit($id, $obj->id, 'Сохранить',null) ?>

        </form>
    </div>

<?php
elseif (isset($_POST['add']) || isset($_POST['edit'])) :
    $obj = new Users();

    if (isset($_POST['add'])) {
        $id = 0;
        $obj->date = time();
        $_SESSION['notice'] = 'Добавлено';
    }
    else {
        $id = (int)$_POST['edit'];
        $obj = Users::findById($id);
        $_SESSION['notice'] = 'Сохранено';
    }

    $obj->class = 1;

    $login = trim($_POST['login']);
    $other = Users::findWhere("WHERE `login` = '{$login}' AND `id` <> '{$id}' LIMIT 1");
    if (!empty($other[0])) {
        $_SESSION['error'] = 'Пользователь с таким Логином (E-mail) <br>'.$code.' уже существует';
        $login = null;
    }
    if (!empty($login)) $obj->login = $login;

    $hash = Helpers::hash();
    if (empty($obj->hash)) $obj->hash = $hash;

    if (!empty($_POST['password'])) {
        $obj->password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $obj->hash = $hash;
    }

    $obj->save();

    header("Location: {$_SERVER['REQUEST_URI']}?edit={$obj->id}");
    exit;

elseif (isset($_GET['delete'])) :

    if ($_GET['delete'] != 1) {
        $obj = Users::findById($_GET['delete']);

        if ($obj->id == $_SESSION['user']['id']) {
            unset($_SESSION['user']);
        }
        $obj->delete();
    }

    $_SESSION['notice'] = 'Удалено';
    header("Location: {$_SERVER['REDIRECT_URL']}");
    exit;

else :
    $filter = true;
    include ROOT . '/private/views/layouts/head.php';

    $where = '';
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $where .= " AND `name` like '%{$search}%'";
    }

    $data = Users::paginate("WHERE `class` = 1 {$where} ORDER BY id DESC");
    $total = $data['total'];
    $paginate = $data['paginate'];
    $list = $data['list'];
    if (!empty($list)):?>
        <div class="total">Общее количество: <?= $total ?></div>
        <div class='list'>
            <? foreach ($list as $item): ?>
                <?
                $item->class = Users_class::findById($item->class);
                ?>
                <?= Form::makeItem($item, $item->login, [$item->class->name], $item->id > 1, false, false) ?>

            <?endforeach;?>
        </div>
        <?= $paginate ?>
    <?else: ?>
        <div class='not_found set'>Ничего не найдено</div>
    <?
    endif;
endif;
