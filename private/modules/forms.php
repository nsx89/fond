<?php

use app\Models\Forms;
use app\Models\Forms_type;
use app\Helpers;
use app\FileUpload;
use app\Form;

$title = 'Заявки';

$filter = true;
$filter_placeholder = 'Введите фио, телефон или email';
include ROOT . '/private/views/layouts/head.php';

$where = '';
$search = trim($_GET['search']);
if (!empty($search)) {
    $where .= " AND (`name` like '%{$search}%' OR `phone` like '%{$search}%' OR `email` like '%{$search}%')";
}

$type = trim($_GET['type']);
if (!empty($type)) {
    $where .= " AND `type` = '{$type}'";
}
?>
<div class="filter-inline js-filter-inline">
    <?= Form::makeSelect('Тип заявки', 'type', Forms_type::findAll(), $type, true, '' , '', '', '', '', 'form-filter') ?>
</div>
<?
$data = Forms::paginate("WHERE 1=1 {$where} ORDER BY id DESC");
$total = $data['total'];
$paginate = $data['paginate'];
$list = $data['list'];
if (!empty($list)):?>
    <div class="total">Общее количество: <?= $total ?></div>
    <table class="table">
        <tr>
            <th>№</th>
            <th>Дата</th>
            <th>Тип заявки</th>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>E-mail</th>
            <th>Комментарий</th>
            <th>Ссылка</th>
            <th>IP</th>
        </tr>
        <? $i = 1; foreach ($list as $item): ?>
            <tr class="<?= empty($item->read) ? 'no-read' : '' ?>">
                <td><?= $i ?></td>
                <td><div style="font-size: 12px;"><?= date('d.m.Y H:i', $item->date) ?></div></td>
                <td><?= Forms_type::findById($item->type)->name ?></td>
                <td><?= $item->name ?></td>
                <td><?= $item->phone ?></td>
                <td><?= $item->email ?></td>
                <td><?= nl2br($item->text) ?></td>
                <td><div style="font-size: 12px; max-width: 300px; word-wrap: break-word;"><?= $item->url ?></div></td>
                <td><?= $item->ip ?></td>
            </tr>
            <?
            Forms::Sql("UPDATE `forms` SET `read` = 1 WHERE `id` = '{$item->id}'");
            ?>
        <? $i++; endforeach; ?>
    </table>
    <?= $paginate ?>
<?else: ?>
    <div class='not_found set'>Ничего не найдено</div>
<?
endif;
?>
<style>
.filter {
    max-width: 980px;
}
.admin_content_scroll {
    width: 100%;
}
</style>
