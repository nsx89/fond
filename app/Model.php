<?php

namespace app;

use app\Paginate;

abstract class Model
{
    public $id;

    public static function findAll($order = null)
    {
        if(empty($order)) $order = 'id ASC';

        $db = new Db();
        $sql = 'SELECT * FROM '.static::TABLE.' ORDER BY '.$order;

        return $db->query(
            $sql,
            [],
            static::class
        );
    }

    public static function findAllShow($order = null, $show = true)
    {
        if(empty($order)) $order = '`rate` DESC, id ASC';

        $and = '';
        if ($show) $and = 'AND `show` = 1';

        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE 1 '.$and.' ORDER BY '.$order;

        return $db->query(
            $sql,
            [],
            static::class
        );
    }

    public static function findArray($order = null, $show = true)
    {
        $array = array();
        $items = self::findAllShow($order, $show);
        foreach ($items AS $item) {
            $index = $item->id;
            $array[$index] = $item;
        }
        return $array;
    }

    public static function findArrayIds($order = "id ASC")
    {
        $array = array();
        $items = self::findAllShow($order, false);
        foreach ($items AS $item) {
            $index = $item->id;
            $array[] = $index;
        }
        return $array;
    }

    public static function findUrl($url)
    {
        $db = new Db();
        $sql = 'SELECT * FROM '.static::TABLE.' WHERE `show` = 1 AND `url` = "'.$url.'" LIMIT 1';

        $data = $db->query($sql,[],static::class);

        return $data ? $data[0] : null;
    }

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

    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';

        $data = $db->query(
            $sql,
            [':id' => $id],
            static::class
        );

        return $data ? $data[0] : false;
    }

    public static function findByHash($hash)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE hash=:hash';

        $data = $db->query(
            $sql,
            [':hash' => $hash],
            static::class
        );

        return $data ? $data[0] : false;
    }

    public static function findByArticul($articul)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE articul=:articul';

        $data = $db->query(
            $sql,
            [':articul' => $articul],
            static::class
        );

        return $data ? $data[0] : false;
    }

    public static function findByID1C($id_1c)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id_1c=:id_1c';

        $data = $db->query(
            $sql,
            [':id_1c' => $id_1c],
            static::class
        );

        return $data ? $data[0] : false;
    }

    public static function findByIds($val,$order)
    {
        if(empty($val)) $val = '';
        if(empty($order)) $order = 'id ASC';

        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `ids`="'.$val.'" ORDER BY '.$order;
        $data = $db->query($sql,[],static::class);
        return $data ? $data : false;
    }

    public static function findWhere($where)
    {
        $db = new Db();
        $sql = 'SELECT * FROM `'.static::TABLE.'` '.$where;
        $data = $db->query($sql,[],static::class);
        return $data ? $data : false;
    }

    public static function findWhereArray($where, $field = 'id')
    {
        $array = array();
        $items = self::findWhere($where);
        foreach ($items AS $item) {
            $index = $item->{$field};
            $array[$index] = $item;
        }
        return $array;
    }

    public static function findSql($sql)
    {
        if(empty($sql)) $sql = '';
        if(!empty($sql)) {
            $db = new Db();
            $data = $db->query($sql,[],static::class);
            return $data ? $data : false;
        }
        else return false;
    }

    public static function Sql($sql)
    {
        if(empty($sql)) $sql = '';
        if(!empty($sql)) {
            $db = new Db();
            $data = $db->query($sql,[],static::class);
            return $data ? $data : false;
        }
        else return false;
    }

    public static function findByName($name)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `name` LIKE "%'.$name.'%"';

        $data = $db->query($sql,[],static::class);

        return $data ? $data : false;
    }

    public static function findByField($field, $val = '', $order = '')
    {
        if(empty($val)) $val = '';
        if(empty($order)) $order = 'id ASC';

        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `'.$field.'`="'.$val.'" ORDER BY '.$order;
        $data = $db->query($sql,[],static::class);
        return $data ? $data : false;
    }

    public static function menuShow()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `show` = 1 AND `menu`=1 ORDER BY `rate` DESC, id ASC';

        return $db->query($sql,[],static::class);
    }

    public function insert()
    {
        // Принимает объект, возвращает массив с ключами из его свойств(полей) и заченимями с содежанием полей
        $fields = get_object_vars($this);

        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {

            if ('id' === $name) {
                continue;
            }

            $cols[] = '`'.$name.'`'; // Имена полей
            $data[':' . $name] = $value; // Имена полей с ':', чтобы подставить в запрос
        }

        $sql = '
            INSERT INTO ' . static::TABLE . '
            (' . implode(', ', $cols) . ')
            VALUES
            (' . implode(', ', array_keys($data)) . ')
        ';

        $db = new Db();
        $db->execute($sql, $data);

        $this->id = $db->getLastId();

        return $this->id;
    }

    public function update()
    {
        $fields = get_object_vars($this);

        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {

            if ('id' === $name) {
                continue;
            }

            $cols[] = '`'.$name.'` = :'.$name;
            $data[':' . $name] = $value;
        }

        $data[':id'] = $this->id;

        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(', ', $cols) . ' WHERE id = :id';

        $db = new Db();
        $db->execute($sql, $data);
    }

    public function save()
    {
        if (empty($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';
        $db = new Db();
        $db->execute($sql, [':id' => $this->id]);
    }


    public function show($show)
    {
        $sql = 'UPDATE ' . static::TABLE . ' SET `show` = "'.$show.'" WHERE id='.$this->id;

        $db = new Db();
        $db->execute($sql,[]);
    }

    static function paginate($where, $pnumber = null, $select = '*') {

        $array = [];
        $page = (int)$_GET['page'];

        $db = new Db();

        $sql = 'SELECT '.$select.' FROM `'.static::TABLE.'` '.$where;

        $sql_count = 'SELECT count(*) AS total FROM `'.static::TABLE.'` '.$where;
        $data = $db->query($sql_count, [], static::class);

        if (empty($data[0])) return $array;

	    $total = $data[0]->total;
	    if ($total) {

	        if (empty($pnumber)) $pnumber = Paginate::pnumber();

            $paginate = new Paginate($total, $pnumber);

            $psql = $sql." LIMIT ".$paginate->start().",$pnumber";
    		$pdata = $db->query($psql, [], static::class);

	        $array['list'] = $pdata;
	        $array['paginate'] = $paginate->links();
	        $array['total'] = $total;
	    }
	    return $array;
	}
}
