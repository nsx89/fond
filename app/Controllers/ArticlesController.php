<?php

namespace app\Controllers;

use app\Controller;
use app\Helpers;
use app\Models\Page;
use app\Models\Settings;
use app\Models\Seo;
use app\Models\Users;
use app\Models\Articles;

class ArticlesController extends Controller {
    protected function handle(...$params) {

        $view = $this->view;
        $view->body_class = 'body-page';

        $view->page = Page::findById(6);

        $url = $params[0];
        if (!empty($url)) return self::detail($url, $view);

        return self::list($view);
    }

    //список
    protected static function list($view){

        $page = $view->page;

        $breadcrumbs = [];
        $breadcrumbs[] = array('Главная', '/');
        $breadcrumbs[] = array($page->name);
        $view->breadcrumbs = $breadcrumbs;

        $count = 1;
        $data = Articles::paginate("WHERE `show` = 1 {$where} ORDER BY rate DESC, id ASC", $count);
        $view->total = $data['total'];
        $view->paginate = $data['paginate'];
        $view->articles = $data['list'];

        $view->edit = Users::edit("articles", $view->edit_seo);

        return $view->show('articles/list.php');
    }

    //детальная страница
    protected static function detail($url, $view){

        $page = $view->page;

        $article = Articles::findUrl($url);
        if (empty($article)) return $view->show('errors/404.php');

        $view->edit = Users::edit("articles?edit=".$article->id, $view->edit_seo);

        /* --- SEO --- */

        $view = Seo::default($view, $article->name);

        /* --- // --- */

        $breadcrumbs = [];
        $breadcrumbs[] = array('Главная', '/');
        $breadcrumbs[] = array($page->name, '/'.$page->url);
        $view->breadcrumbs = $breadcrumbs;

        $view->article = $article;

        return $view->show('articles/detail.php');
    }
}
