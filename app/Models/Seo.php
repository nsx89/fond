<?php

namespace app\Models;

use app\Model;
use app\Db;
use app\Models\Users;
use app\Models\Settings;

class Seo extends Model
{
    public const TABLE = 'seo';

    public $url;
    public $title;
    public $keywords;
    public $description;

    public static function findByUrl($url, $show = false)
    {

        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `url` = :url';

        if ($show) {
            $sql .= ' AND `show` = 1';
        }

        $sql .= ' LIMIT 1';

        $data = $db->query(
            $sql,
            [':url' => $url],
            static::class
        );

        return $data ? $data[0] : null;
    }

    public static function edit($seo)
    {
        if (!Users::isAdmin()) return;

        $url = URI;
        if (empty($seo)) $seo = Seo::findByUrl($url);

        if($seo) $link = "/admin/seo?edit={$seo->id}";
        else $link = "/admin/seo?add&url={$url}";

        return "<a href='/admin/seo?add&url={$url}' target='_blank'>SEO</a>";
    }

    //SEO META по умолчанию
   public static function default($view, $name) {

       $name = strip_tags($name);

       $settings = Settings::findById(1);
       $title = $keywords = $description = $settings->title;

       if (empty($view->title) || $view->title == $title) $view->title = $name.' | '.$title;
       if (empty($view->keywords)) $view->keywords = $name.' | '.$keywords;
       if (empty($view->description)) $view->description = $name.' | '.$description;

       return $view;
   }
}
