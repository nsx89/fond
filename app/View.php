<?php

namespace app;

use app\Models\Settings;
use app\Models\Page;
use app\Models\Seo;
use app\Models\Users;
use app\Helpers;

class View
{
    protected $data = [];
    protected $params = [];

    public function __construct()
    {
        if (!AJAX) {
            $seo = Seo::findByUrl(URI);
            $settings = Settings::findById(1);
            $sitename = $settings->title;

            $isAdmin = Users::isAdmin();

            $this->settings = $settings;

            $this->title = !empty($seo->title) ? $seo->title : $sitename;
            $this->keywords = !empty($seo->keywords) ? $seo->keywords : $sitename;
            $this->description = !empty($seo->description) ? $seo->description : $sitename;

            $this->edit_seo = Seo::edit($seo);

            $this->footer_menu = Page::findWhere("WHERE `show` = 1 AND `menu_footer` = 1 ORDER BY rate_footer DESC, rate DESC");
        }
        $this->pages = Page::getArray();
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    public function show($template)
    {
        $template = ROOT . '/public/views/'.$template;
        echo $this->render($template);
    }

    public function render($template)
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function getParam($param)
    {
        return $this->params[$param] ?? null;
    }
    public function getParams()
    {
        return $this->params ?? null;
    }

    public function include($path, $item = null, $array = [])
    {
        $view = $item;
        include $_SERVER['DOCUMENT_ROOT']."/public/views/{$path}.php";
    }

    public function includeHtml($path)
    {
        include $_SERVER['DOCUMENT_ROOT']."/public/views/{$path}.html";
    }
}
