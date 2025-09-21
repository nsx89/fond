<? include_once VIEWS.'/layouts/header.php' ?>

<? $page = $this->page; ?>

<main class="page">
    <div class="container">
        <?= $this->edit ?>

        <? include_once VIEWS.'/components/breadcrumbs.php' ?>

        <h1 class="h1"><?= $this->page->name ?></h1>

        <div class="page-text">
            <div class="texts">
                <?= $page->text ?>
            </div>
        </div>

    </div>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
