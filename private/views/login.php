<? require 'layouts/header.php'; ?>

<main class='login_bg'>
    <div class='login_modal'>
        <h1>Авторизация</h1>
        <form action='/admin/' method='post' id='login_form'>
            <input type='hidden' name='action' value='userLogin'>
            <div class='input_block'>
                <span>Логин:</span>
                <input type='text' name='login' placeholder=''>
            </div>
            <div class='input_block'>
                <span>Пароль:</span>
                <input type='password' name='password' placeholder=''>
            </div>
            <div class='input_block_submit'>
                <button type='submit' name='submit'>Войти</button>
            </div>
        </form>
    </div>
</main>

<? require 'layouts/footer.php';
