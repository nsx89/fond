<?php

namespace app\Controllers;

use app\Controller;
use app\Models\Users;

class AdminPanel extends Controller
{
    protected function handle(...$parameters)
    {
        $user = Users::checkLogged(true);
        $this->view->user = $user;

        //Вход в админку только с определенных IP
        if (!Users::isPermittedIP()) return $this->view->show('errors/404.php');

        $url = array_shift($parameters);
        $page = array_shift($parameters);
        $p = array_shift($parameters);

        if (!empty($url)) {
            $module = ROOT.'/private/modules/'.$url.'.php';

            if (is_file($module)) { ob_start(); include $module; $module = ob_get_contents(); ob_clean(); } else $module = false;
        }

        $this->view->module = $module;
        $this->view->display(ROOT . '/private/views/panel.php');
    }
}
