<?php

namespace app\Controllers;

use app\Controller;
use app\Models\Users;
use app\Form;
use app\Models\Page;

class AdminForms extends Controller
{
    protected function handle(...$parameters)
    {
        if (!empty($_POST)) {
            $action = array_shift($_POST);
            call_user_func_array([$this, $action], []);
        }
    }

    protected function adminShow()
    {
        $id = $_POST['id'];
        $className = $_POST['className'];
        $show = $_POST['show'];
        $className::findById($id)->show($show);
    }
}
