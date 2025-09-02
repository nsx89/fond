<?php

namespace app;

class Db
{
    protected $dbh;

    public function __construct()
    {
        $config = (include ROOT . '/db.php');
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'].';charset=UTF8';

        $this->dbh = new \PDO(
            $dsn,
            $config['user'],
            $config['password'],
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
        );

        $this->dbh->exec("set names utf8mb4");
    }

    public function query($sql, $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);

        if (empty($class)) {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function execute($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }

    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }

    public function changeDB($db)
    {
        $config = (include ROOT . '/db.php');
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $db.';charset=UTF8';

        $this->dbh = new \PDO(
            $dsn,
            $config['user'],
            $config['password'],
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
        );
    }
}

?>
