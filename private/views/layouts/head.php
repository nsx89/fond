<h1><?= $title ?></h1>

<div class='filter'>

    <? if (!empty($_GET['search']) || !empty($_GET['type']) || !empty($_GET['status']) || !empty($_GET['category'])) : ?>
        <a class="filter_reset" href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>">Сбросить</a>
    <? endif; ?>

    <? if ($filter): ?>
        <form id="form-filter" action='/<?= URI ?>' method='get' class='filter_form'>
            <span>Поиск:</span>
            <input type='text' name='search' placeholder='<?= !empty($filter_placeholder) ? $filter_placeholder : 'Введите название' ?>'
            value='<?= isset($_GET['search']) ? $_GET['search'] : '' ?>'>
            <button type='submit' class='blue_btn'>Поиск</button>
        </form>
    <? endif; ?>

    <? if (!empty($filters)): ?>
        <?= $filters ?>
    <? endif; ?>

    <? if ($add): ?>
        <a href='?add' class='admin_add'><?= !empty($add_text) ? $add_text : 'Добавить' ?></a>
    <? endif; ?>
</div>
