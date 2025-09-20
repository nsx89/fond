<?php
header("HTTP/1.0 404 Not Found");
$this->title = '404';
$this->body_class = 'body-page';
?>

<? include_once VIEWS.'/layouts/header.php' ?>

<main class="page">
    <div class="container">
		<div class="page-404">
			<h1>
				Что-то пошло не так
			</h1>
			<h2>
				404. Страница не найдена
			</h2>
			<h3>
				Неправильно набран адрес или такой страницы больше не существует, а возможно никогда и не существовало.
			</h3>
			<h3>
				<strong>Проверьте адрес или перейдите на <a href='/'>главную страницу</a></strong>
			</h3>
		</div>
    </div>
</main>

<? include_once VIEWS.'/layouts/footer.php' ?>
