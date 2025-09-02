<?php

namespace app\Controllers;

use app\Controller;
use app\Helpers;
use app\Models\Settings;
use app\Models\Page;
use app\Models\Users;
use app\Models\Forms;
use app\Models\Forms_type;
use app\View;

class UserAjax extends Controller
{
    protected $errors = [];
    protected $send = true;

    protected function handle(...$params) {
        if (!empty($_POST)) {
            $action = trim($_POST['action']);
            call_user_func_array([$this, $action], []);
        }
        else if (!empty($_GET)) {
            $action = array_shift($_GET);
            call_user_func_array([$this, $action], []);
        } else {
            $view = new View();
            return $view->show('errors/404.php');
        }
    }

    protected static function response($html) {
        echo $html;
    }

    protected static function responseJson($array) {
        if (empty($array)) return;
        print_r(json_encode($array));
    }

    //Авторизация (для Админки в том числе!)
    protected function userLogin() {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = Users::checkUserData($login, $password);

        if (!empty($user)) {
            Users::auth($user);
        }
        else echo "Неверный логин или пароль!";
    }

    /*public function formsAdd() {
        $type = (int)$_POST['type'];
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $text = trim($_POST['text']);
        $url = 'https://'.$_SERVER['SERVER_NAME'].trim($_POST['url']);

        if (empty($type)) return;
        switch ($type) {
            case '1':
                if ($phone == '' || $email == '') return;
                break;
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) return self::response('Введите корректный email');

        $obj = new Forms();
        $obj->type = $type;
        $obj->name = $name;
        $obj->phone = $phone;
        $obj->email = $email;
        $obj->text = $text;
        $obj->date = time();
        $obj->url = $url;
        $obj->ip = Helpers::get_user_ip();
        $save = $obj->save();

        $forms_type = Forms_type::findById($type);
        $forms_type_name = $forms_type->name;

        $subject = "Новая заявка «{$forms_type_name}»";
        $message = "<strong>Новая заявка «{$forms_type_name}»</strong> от посетителя ".$_SERVER['SERVER_NAME']."<br><br>
        <strong>Со страницы:</strong> ".$url."<br />
        <strong>Имя:</strong> ".$name."<br />
        <strong>Телефон:</strong> ".$phone."<br />
        <strong>E-mail:</strong> ".$email."<br />
        <strong>Комментарий:</strong> ".nl2br($text)."<br />";

        $settings = Settings::findById(1);
        $to = $settings->email_send;

        Helpers::mail($to, $subject, $message);

        if (empty($save)) return self::response('Произошла ошибка. Попробуйте позже еще раз');

        return self::response(1);
    }*/
}
