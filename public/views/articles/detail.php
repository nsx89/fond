<? include_once VIEWS.'/layouts/header.php' ?>

<? $article = $this->article; ?>

<main class="page">
    <div class="container">
        <?= $this->edit ?>

        <h1><?= $article->name ?></h1>



    </div>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
