<?php

namespace app;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use DomDocument;
use app\Models\Page;
use app\Models\Settings;

class Helpers
{
    private static $converter = [
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

        'А' => 'A', 'Б' => 'B', 'В' => 'V',
        'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'Y', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
        'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
    ];

    public static function random_password($count)
    {
        if(empty($count)) $count = 16;

        $out = '';
        $arr = array();
        for($i=97; $i<123; $i++) $arr[] = chr($i);
        for($i=65; $i<91; $i++) $arr[] = chr($i);
        for($i=0; $i<10; $i++) $arr[] = $i;
        shuffle($arr);
        for($i=0; $i<$count; $i++)
        {
            $out .= $arr[mt_rand(0, sizeof($arr)-1)];
        }
        return $out;
    }

    public static function dump($content)
    {
        echo '<pre>';
        print_r($content);
        echo '</pre>';
    }

    public static function response($content)
    {
        return print_r($content);
    }

    public static function clearPhone($phone)
    {
        return preg_replace('/[^0-9\+]/', '', $phone);
    }

    public static function rus2translit($string)
    {
        return strtr($string, self::$converter);
    }

    public static function str2url($str)
    {
        // переводим в транслит
        $str = self::rus2translit($str);

        // в нижний регистр
        $str = strtolower($str);

        // удаляем теги
        $str = strip_tags($str);

        // заменям все ненужное нам на -
        $str = preg_replace('~[^-a-z0-9_]+~', '-', $str);
        // $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);

        // удаляем начальные и конечные '-'
        $str = trim($str, "-");

        return $str;
    }

    public static function priceSpace($price)
    {
        $p = explode('.',$price);

        $price = strrev(implode(' ',str_split(strrev($p[0]),3)));
        if(!empty($p[1])) $price .= '.'.$p[1];

        return $price;
    }

    public static function declOfNum($count, $array)
    {
        $cases = [2, 0, 1, 1, 1, 2];
        return $array[($count % 100 > 4 && $count % 100 < 20) ? 2 : $cases[min($count % 10, 5)]];
    }

    public static function jwt_request($url, $token, $post)
    {
        // header('Content-Type: application/json'); // Specify the type of data
        $ch = curl_init($url); // Initialise cURL
        $post = json_encode($post); // Encode the data array into a JSON string
        $authorization = "Authorization: Bearer " . $token; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', $authorization]); // Inject the token into the header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($ch); // Execute the cURL statement
        curl_close($ch); // Close the cURL connection
        return json_decode($result); // Return the received data
    }

    public static function CBR_XML_Daily_Ru() {
        $json_daily_file = __DIR__.'/daily.json';
        if (!is_file($json_daily_file) || filemtime($json_daily_file) < time() - 3600) {
            if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
                file_put_contents($json_daily_file, $json_daily);
            }
        }

        return json_decode(file_get_contents($json_daily_file));
    }

    public static function percent($number, $percent)
    {
        $number_percent = $number / 100 * $percent;
        return round($number + $number_percent);
    }

    public static function dateText($date)
    {
        $n = date('n',$date);
        switch($n)
        {
            case '1': $n = 'января'; break;
            case '2': $n = 'февраля'; break;
            case '3': $n = 'марта'; break;
            case '4': $n = 'апреля'; break;
            case '5': $n = 'мая'; break;
            case '6': $n = 'июня'; break;
            case '7': $n = 'июля'; break;
            case '8': $n = 'августа'; break;
            case '9': $n = 'сентября'; break;
            case '10': $n = 'октября'; break;
            case '11': $n = 'ноября'; break;
            case '12': $n = 'декабря'; break;
        }

        $date = date('j', $date).' '.$n.' '.date('Y', $date);

        return $date;
    }

    public static function mail($to, $subject, $message, $files = [])
    {
        $from = 'robot@'.$_SERVER['SERVER_NAME'];

        if(empty($message)) $message = "<html><body></body></html>";

        $mail = new PHPMailer;

        $mail->CharSet = 'UTF-8';
        $mail->setFrom($from);
        $mail->isHTML(true);
        $mail->Subject = $subject;

        if (is_array($to)) {
            foreach ($to as $value) {
                $mail->AddAddress($value);
            }
        }
        else {
            $mail->AddAddress($to);
        }

        $mail->Body = $message;

        if(!empty($files))
        {
            foreach($files AS $file)
            {
                $mail->addAttachment(ROOT.$file->file, $file->filename.'.'.$file->ext);
            }
        }

        if (!$mail->send()) echo 'Ошибка: '.$mail->ErrorInfo;
    }

    public static function arr2str($arr,$level){
        $str = "array(<br>\n";
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $str.=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$level)."'".$key."' => " . Helpers::arr2str($val,$level+1) . ",<br>\n";
            }else {
                $str.=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$level)."'".$key."' => '<b>" . str_replace("'", "\'", $val) . "</b>',<br>\n";
            }
        }
        return $str . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$level).")";
    }

    public static function sitemap() {

        $xml = new DomDocument('1.0','utf-8');
        $root = $xml->appendChild($xml->createElement('urlset'));
        $root->appendChild($xml->createAttribute('xmlns'))->appendChild($xml->createTextNode('https://www.sitemaps.org/schemas/sitemap/0.9'));
        $root->appendChild($xml->createAttribute('xmlns:xsi'))->appendChild($xml->createTextNode('https://www.w3.org/2001/XMLSchema-instance'));
        $root->appendChild($xml->createAttribute('xsi:schemaLocation'))->appendChild($xml->createTextNode('https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'));

        $u = "https://".$_SERVER['SERVER_NAME'];

        $url = $root->appendChild($xml->createElement('url'));
        $loc = $url->appendChild($xml->createElement('loc'));
        $loc->appendChild($xml->createTextNode($u));

        $pages = Page::findWhere('WHERE `show`=1 AND name<>"" ORDER BY id ASC');
        if(!empty($pages)) {
            foreach($pages AS $item) {

                if($item->id != 1) {
                    $u = "https://".$_SERVER['SERVER_NAME'].Page::getUrl($item->id);

                    $url = $root->appendChild($xml->createElement('url'));
                    $loc = $url->appendChild($xml->createElement('loc'));
                    $loc->appendChild($xml->createTextNode($u));
                }
            }
        }

        $xml->formatOutput = true;
        $xml->save(ROOT.'/sitemap.xml');

        Helpers::turbo();
    }


    //IP адрес пользователя
    public static function get_user_ip()
    {
        $ip = false;
        $ipa = array();
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ipa[] = trim(strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ','));
        if (isset($_SERVER['HTTP_CLIENT_IP'])) $ipa[] = $_SERVER['HTTP_CLIENT_IP'];
        if (isset($_SERVER['REMOTE_ADDR'])) $ipa[] = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_REAL_IP'])) $ipa[] = $_SERVER['HTTP_X_REAL_IP'];

        //проверяем ip-адреса на валидность начиная с приоритетного.
        foreach ($ipa as $ips) {
            //  если ip валидный обрываем цикл, назначаем ip адрес и возвращаем его
            if (self::is_valid_ip($ips)) {
                $ip = $ips;
                break;
            }
        }
        return $ip;
    }

    //Валидность IP
    private static function is_valid_ip($ip = null)
    {
        if (preg_match("#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#", $ip)) return true;
        return false;
    }

    public static function priceFormat($price)
    {
        $price = number_format($price, 0, '', ' ');
        return $price;
    }

    public static function hash() {
		$hash = md5(uniqid(rand(), true));
		return $hash;
	}

    public static function blacklist($ext){
		$blacklist = array("php", "phtml", "php3", "php4", "js", "jsx", "exe", "sql", "bat", "cmd", "pif", "vbs", "jse", "ps1", "scr", "msi");
		if(in_array($ext, $blacklist)) {
			return 1;
		}
		return 0;
	}
}
