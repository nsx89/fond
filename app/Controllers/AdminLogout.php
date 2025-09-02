<?php

namespace app\Controllers;

use app\Controller;
use app\Models\Users;

class AdminLogout extends Controller
{
    public function handle(...$params)
    {
        Users::logout();

        header("Location: /admin");
    }
}
