<?= $this->include('layouts/header') ?>

<? $page = $this->page; ?>

<main class="page">
    <div class="container">
        <?= $this->edit ?>

        <h1><?= $page->name ?></h1>

        <div class="page-text">
            <div class="texts">
                <?= $page->text ?>
            </div>
        </div>

    </div>
</main>

<?= $this->include('layouts/footer') ?>
