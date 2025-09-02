<?php

namespace app\Controllers;

use app\Controller;
use app\Models\Users;
use app\Form;
use app\Models\Page;

class AdminAjax extends Controller
{
    protected function handle(...$parameters)
    {
        $action = trim($_POST['action']);

        //Вход в админку только с определенных IP
        if (!Users::isPermittedIP() && $action <> 'userLogin') return;

        if (!empty($_POST)) {
            $action = array_shift($_POST);
            call_user_func_array([$this, $action], []);
        }
    }

    protected function access(): bool
    {
        if (!Users::isGuest()) {
            return true;
        }
        return false;
    }

    protected function adminShow()
    {
        $id = $_POST['id'];
        $className = $_POST['className'];
        $show = $_POST['show'];
        $className::findById($id)->show($show);
    }

    protected function adminPreviewDelete()
    {
        $id = $_POST['id'];
        $className = $_POST['className'];
        $path = $_POST['path'];
        $field = $_POST['field'];

        $image = $className::findById($id);
        unlink(ROOT . $path . '/' . $image->$field);
        $image->$field = null;
        $image->save();
    }

    protected function sortbox()
    {
        $className = trim($_POST['className']);
        $items = $_POST['items'];
        $i = count($items);
        foreach($items AS $item) {
            $obj = $className::findById($item);
            $obj->rate = $i;
            $obj->save();
            $i--;
        }
    }
}
