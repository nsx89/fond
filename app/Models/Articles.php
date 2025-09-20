<?php

namespace app\Models;

use app\Db;
use app\Model;
use app\Helpers;

class Articles extends Model
{
    public const TABLE = 'articles';

    public static function getLink($item, $page) {

        if (empty($item) || empty($page)) return;

        $link = '/'.$page->url.'/'.$item->url;

        return $link;
    }

    public static function getOther($id, $other){

        $where = '';
        $order = '';
        $limit = 15;

        if (!empty($other)) {
            $in = str_replace('|', ',', trim($other, '|'));
            $where .= "AND `id` IN ({$in})";
        }
        else {
            $order = "RAND(),";
        }

        $list = self::findWhere("WHERE `show` = 1 {$where} ORDER BY {$order} date DESC, rate DESC, id ASC LIMIT {$limit}");

        return $list;
    }
}
