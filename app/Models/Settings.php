<?php

namespace app\Models;

use app\Db;
use app\Model;

class Settings extends Model
{
    public const TABLE = 'settings';

    public $title;

    public static function findByName($name)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . self::TABLE . ' WHERE `name` = :name LIMIT 1';
        $data = $db->query($sql,[':name' => $name],static::class);
        return $data ? $data[0] : false;
    }

    public static function getValue($name)
    {
        $db = new Db();
        $sql = 'SELECT `value` FROM ' . self::TABLE . ' WHERE `name` = :name LIMIT 1';
        $data = $db->query($sql,[':name' => $name],null);

        return $data[0]['value'] ?? false;
    }

    public static function get()
    {
        $db = new Db();
        $sql = 'SELECT `name`, `value` FROM ' . self::TABLE . '';
        $data = $db->query($sql,[],null);
        $settings = [];

        if ($data) {
            foreach ($data as $value) {
                $settings[$value['name']] = $value['value'];
            }
        }

        return $settings;
    }

    public static function phone_link($var){
        $res = preg_replace('/\D/', '', $var);
        $first = substr($res, 0, 1);
        if($first == 7) $res = '+'.$res;
        return $res;
    }

}
