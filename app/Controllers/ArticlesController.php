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

        $count = 8;
        $data = Articles::paginate("WHERE `show` = 1 ORDER BY rate DESC, date DESC, id ASC", $count);
        $view->total = $data['total'];
        $view->paginate = $data['paginate'];
        $view->articles = $data['list'];

        $view = Seo::default($view, $page->name);

        $view->edit = Users::edit("articles", $view->edit_seo);

        return $view->show('articles/list.php');
    }

    //детальная страница
    protected static function detail($url, $view){

        $page = $view->page;

        $article = Articles::findUrl($url);
        if (empty($article)) return $view->show('errors/404.php');

        $article_id = $article->id;

        $view->edit = Users::edit("articles?edit=".$article_id, $view->edit_seo);

        $name = !empty($article->h1) ? $article->h1 : $article->name;

        $views = (array)$_SESSION['views'];
        if (!in_array($article_id, $views)) {
            $article->views = intval($article->views) + 1;
            $article->save();
            $views[] = $article_id;
            $_SESSION['views'] = $views;
        }

        $view = Seo::default($view, $article->name);

        $breadcrumbs = [];
        $breadcrumbs[] = array('Главная', '/');
        $breadcrumbs[] = array($page->name, '/'.$page->url);
        $breadcrumbs[] = array($name);
        $view->breadcrumbs = $breadcrumbs;

        $view->article = $article;

        //other
        $view->articles = Articles::getOther($article->id, $article->other);

        return $view->show('articles/detail.php');
    }
}
