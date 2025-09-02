<?php

namespace app\Models;

class Admin
{
    public static function getMenu()
    {
        $adminPanel = (include ROOT . '/config.php')['adminPanel'];
        return $adminPanel;
    }
}