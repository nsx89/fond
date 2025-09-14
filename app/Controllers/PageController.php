<?php

namespace app\Controllers;

use app\Controller;
use app\Helpers;
use app\Models\Page;
use app\Models\Settings;
use app\Models\Seo;
use app\Models\Users;

class PageController extends Controller {
    protected function handle(...$params) {

        $view = $this->view;
        $url = $params[0];
        $url1 = $params[1];

        //Главная
        if (empty($url)) return self::main($view);

        if (!empty($url1)) return $view->show('errors/404.php');

        //Страницы
        $page = Page::findByUrl($url, true);
        if (!empty($page)) {
            $view->page = $page;
            $view->body_class = 'body-page';

            $view->edit = Users::edit("pages?edit={$page->id}", $view->edit_seo);

            switch ($page->id) {
                //case 2: return self::shops($view); break; //магазины
                default: return $view->show('page.php'); break; //страницы
            }
        }

        return $view->show('errors/404.php');
    }

    protected static function main($view){



        return $view->show('main.php');
    }
}
