<?php

namespace app\Controllers;

use app\Controller;
use app\Helpers;
use app\Models\Page;
use app\Models\Settings;
use app\Models\Seo;
use app\Models\Users;
use app\Models\Articles;
use app\Models\Volunteers;
use app\Models\Medals;
use app\Models\Banners;
use app\Models\Video;
use app\Models\Documents;
use app\Models\Medication;
use app\Models\Partners;

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

            $breadcrumbs = [];
            $breadcrumbs[] = array('Главная', '/');
            $breadcrumbs[] = array($page->name);
            $view->breadcrumbs = $breadcrumbs;

            switch ($page->id) {
                case 7: return self::volunteers($view); break; //волонтеры
                default: return $view->show('page.php'); break; //страницы
            }
        }

        return $view->show('errors/404.php');
    }

    protected static function main($view){

        $view->articles = Articles::findWhere("WHERE `show` = 1 ORDER BY rate DESC, date DESC, id ASC LIMIT 10");
        $view->banners = Banners::findWhere("WHERE `show` = 1 ORDER BY rate DESC, id ASC LIMIT 1");
        $view->video = Video::findWhere("WHERE `show` = 1 ORDER BY rate DESC, id ASC LIMIT 20");
        $view->documents = Documents::findWhere("WHERE `show` = 1 ORDER BY rate DESC, id ASC LIMIT 20");
        $view->medication = Medication::findWhere("WHERE `show` = 1 ORDER BY rate DESC, id ASC LIMIT 20");
        $view->partners = Partners::findWhere("WHERE `show` = 1 AND image IS NOT NULL ORDER BY rate DESC, id ASC LIMIT 30");

        $view->edit_banners = Users::edit("banners");
        $view->edit_project = Users::edit("pages?edit=3");
        $view->edit_video = Users::edit("video");
        $view->edit_settings = Users::edit("settings");
        $view->edit_documents = Users::edit("documents");
        $view->edit_medication = Users::edit("medication");
        $view->edit_partners = Users::edit("partners");

        return $view->show('main.php');
    }

    protected static function volunteers($view){

        $count = 9;
        $data = Volunteers::paginate("WHERE `show` = 1 ORDER BY rate DESC, id ASC", $count);
        $view->total = $data['total'];
        $view->paginate = $data['paginate'];
        $view->volunteers = $data['list'];

        $view->medals = Medals::findArray();

        $view->edit = Users::edit("volunteers", $view->edit_seo);

        return $view->show('pages/volunteers.php');
    }
}
