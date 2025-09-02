<?php

namespace app\Controllers;


use app\Controller;

class Error extends Controller
{
    protected function handle(...$parameters)
    {
        $this->view->display(ROOT . '/public/views/404.php');
    }
}