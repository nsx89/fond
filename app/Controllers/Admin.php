<?php

namespace app\Controllers;

use app\Controller;
use app\Models\Users;

class Admin extends Controller
{
    protected function handle(...$parameters)
    {
        if (Users::isAdmin()) {
            header('Location: /admin/settings');
        }

        //Вход в админку только с определенных IP
        if (!Users::isPermittedIP()) return $this->view->show('errors/404.php');

        $this->view->display(ROOT . '/private/views/login.php');
    }

    protected function access(): bool
    {
        if (isset($_POST['submit'])) {

            $login = trim($_POST['login']);
            $password = trim($_POST['password']);

            $user = Users::checkUserData($login, $password);
            if (!$user) return true;

            Users::auth($user);

            header('Location: /admin/settings');
        }

        return true;
    }
}
