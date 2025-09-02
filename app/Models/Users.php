<?php

namespace app\Models;

use app\Db;
use app\Model;
use app\Helpers;
use app\Models\Settings;
use app\Models\Users_ip;

class Users extends Model
{
    public const TABLE = 'users';

    public $login;
    public $name;

    public static function checkUserData($login, $password)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . self::TABLE . ' WHERE login = :login';

        $user = $db->query(
            $sql,
            [':login' => $login],
            self::class
        );

        if ($user) {
            if (password_verify($password, $user[0]->password)) {
                return $user[0];
            }
        }

        return false;
    }

    public static function auth($user)
    {
        setcookie("user", $user->hash, time() + 7776000, "/", $_SERVER['SERVER_NAME'], "0");  //на 90 дней

        $_SESSION['user']['id'] = $user->id;
        $_SESSION['user']['hash'] = $user->hash;
        $_SESSION['user']['login'] = $user->login;
        $_SESSION['user']['class'] = $user->class;
    }

    public static function logout()
    {
        unset($_SESSION["user"]);
        setcookie("user", "", time() - 7776000, "/", $_SERVER['SERVER_NAME'], "0");
    }

    public static function getLogin()
    {
        return $_SESSION['user']['login'];
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function isAdmin()
    {
        if (Users::getUserClass() == 1) {
            return true;
        }
        return false;
    }

    //Разрешенные IP адреса
    public static function isPermittedIP()
    {
        $ip = Helpers::get_user_ip();
        if (empty($ip)) return false;

        $items = Users_ip::findAll();
        foreach ($items as $item) {
            if ($item->name == '*') return true;

            if ($ip == $item->name) return true;
        }

        return false;
    }

    public static function isUser()
    {
        if(!isset($_SESSION['user']))
        {
            if(isset($_COOKIE['user']))
            {
                $user = Users::findByHash($_COOKIE['user']);
                if(!empty($user)) {
                    $_SESSION['user']['id'] = $user->id;
                    $_SESSION['user']['hash'] = $user->hash;
                    $_SESSION['user']['login'] = $user->login;
                    $_SESSION['user']['class'] = $user->class;
                }
            }
        }

        return !self::isGuest();
    }

    public static function checkLogged($redirect = false)
    {
        $hash = $_COOKIE['user'];
        if (empty($hash)) return;

        $user = Users::findByHash($hash);
        if(empty($user)) {
            Users::logout();
            return;
        }

        if (!self::isAdmin() && $redirect) {
            header("Location: /admin");
            exit();
        }

        $user->date_visit = time();
        $user->save();

        return $user;
    }

    public static function edit($url, $seo = '')
    {
        if (self::isAdmin()) {
            return "<div class='edit'>
                <div>
                    <a href='/admin/{$url}' target='_blank'>Редактировать</a>
                    {$seo}
                </div>
            </div>";
        }

        return;
    }

    public static function selectClass()
    {
        $db = new Db();
        $sql = 'SELECT * FROM `'.self::TABLE.'_class` ORDER BY id ASC';

        return $db->query(
            $sql,
            [],
            self::class
        );
    }

    public static function getClass($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM `'.self::TABLE.'_class` WHERE id='.$id.' LIMIT 1';

        $data = $db->query(
            $sql,
            [],
            self::class
        );

        return $data[0];
    }

    public static function getUserClass()
    {
        if(isset($_SESSION['user'])) return $_SESSION['user']['class'];
        else return '';
    }

    //Автоматическое создание аккаунта
    public static function addAuto($order){

        $user_id = 0;

        if (empty($order)) return $user_id;

        $email = $order->email;
        $phone = $order->phone;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return $user_id;

        $user_find = Users::findWhere("WHERE `login` = '{$email}' OR `phone` = '{$phone}' LIMIT 1");
        if (!empty($user_find)) return $user_id;

        $password = Helpers::random_password(8);

        $user = new Users();
        $user->login = $email;
        $user->phone = $phone;
        $user->name = $order->name;
        $user->city = $order->city;
        $user->street = $order->street;
        $user->house = $order->house;
        $user->corp = $order->corp;
        $user->apartment = $order->apartment;
        $user->agree_news = $order->agree_news;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->hash = Helpers::hash();
        $user->class = 2;
        $user->date = time();
        $user->auto = 1;
        $user->save();

        $user_id = (int)$user->id;

        Users::auth($user);

        /* --- Письмо на почту с паролем временным --- */

        $subject = "Создание аккаунта на сайте ".$_SERVER['SERVER_NAME'];
        $message = "Здравствуйте! В процессе оформления заказа, для Вас был cоздан личный кабинет на сайте: ".$_SERVER['SERVER_NAME']."<br><br>
        Для входа на сайт используйте следующие доступы:<br />
        <strong>Email: </strong> {$email}<br>
        <strong>Пароль: </strong> {$password}<br>
        <hr>
        <div style='font-size: 11px; color: #a9a9a9;'>Если Вы не запрашивали создание личного кабинета после оформления заказа, просто проигнорируйте это письмо</div>";

        Helpers::mail($email, $subject, $message);

        /* --- // --- */

        return $user_id;
    }
}
