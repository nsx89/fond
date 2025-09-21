<?php

namespace app\Models;

use app\Db;
use app\Model;
use app\Helpers;

class Volunteers extends Model
{
    public const TABLE = 'volunteers';

    public static function getLink($item, $page) {

        if (empty($item) || empty($page)) return;

        $link = '/'.$page->url.'/'.$item->url;

        return $link;
    }
}
