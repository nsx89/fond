<?php

namespace app;

use app\Models\Gallery;
use app\Models\Files;

class FileUpload
{
    // Массив с названиями ошибок
    private static $errorMessages = [
        UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
        UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
        UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
        UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
        UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
    ];

    // Зададим неизвестную ошибку
    private static $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
    private static $maxFileSize = 100;

    private static function changeStructure($inputName)
    {
        // Изменим структуру $_FILES
        foreach ($_FILES[$inputName] as $key => $value) {
            foreach ($value as $k => $v) {
                $_FILES[$inputName][$k][$key] = $v;
            }
            // Удалим старые ключи
            unset($_FILES[$inputName][$key]);
        }
    }

    public static function uploadImage($inputName, $class, $field, $id, $width, $height, $path, $f = 1, $flag = false)
    {
        if(empty($path)) $path = '/public/src/upload/';

        $dir = $_SERVER['DOCUMENT_ROOT'].$path;
	    if(!is_dir($dir)) mkdir($dir, 0755, true);

        if(empty($f)) $f = 0;

        if ($flag) {
            $filePath = $_FILES[$inputName]['tmp_name'][$id];
            $fileName = $_FILES[$inputName]['name'][$id];
            $errorCode = $_FILES[$inputName]['error'][$id];
        }
        else {
            $filePath = $_FILES[$inputName]['tmp_name'];
            $fileName = $_FILES[$inputName]['name'];
            $errorCode = $_FILES[$inputName]['error'];
        }

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

            // Выведем название ошибки
            // die($outputMessage);
            return;
        }

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string)finfo_file($fi, $filePath);

        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

        $e = explode('.',$fileName);
        $extension = array_pop($e);

        // Сократим .jpeg до .jpg
        $format = '.'.str_replace('jpeg', 'jpg', $extension);

        // Зададим ограничения для картинок
        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать '.self::$maxFileSize.' Мбайт.');

        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = uniqid();

        $serverPath = ROOT . $path . $name . $format;

        // Переместим картинку с новым именем и расширением в папку
        if (!move_uploaded_file($filePath, $serverPath)) {
            die('При записи изображения на диск произошла ошибка.');
        }

        $nwidth1 = $width;
        $nheight1 = $height;

        $imageinfo = getimagesize($serverPath);

        $width = $imageinfo[0];
        $height = $imageinfo[1];

        if (!empty($width) && !empty($height))
        {
            if($f == 1)
            {
                $nwidth = $nheight = 0;
                if($height >= $nheight1)
                {
                    $nheight = $nheight1;
                    $nwidth = ($nheight/$height)*$width;

                    if ($nwidth > $nwidth1)
                    {
                        $nwidth = $nwidth1;
                        $nheight = ($nwidth/$width)*$height;
                    }
                }
                else if ($width >= $nwidth1)
                {
                    $nwidth = $nwidth1;
                    $nheight = ($nwidth/$width)*$height;

                    if($nheight > $nheight1)
                    {
                        $nheight = $nheight1;
                        $nwidth = ($nheight/$height)*$width;
                    }
                }

                if($nwidth <> 0) exec("convert -resize ".round($nwidth)."x".round($nheight)." -quality 100 ".$serverPath." ".$serverPath."");
            }
            else
            {
                $nheight = $nheight1;
                $nwidth = ($nheight/$height)*$width;

                if ($nwidth < $nwidth1)
                {
                    $nwidth = $nwidth1;
                    $nheight = ($nwidth/$width)*$height;
                }
				else if ($nheight < $nheight1)
				{
					$nheight = $nheight1;
					$nwidth = ($nheight/$height)*$width;
				}

                exec("convert -resize ".round($nwidth)."x".round($nheight)." -quality 100 ".$serverPath." ".$serverPath."");
                exec("convert -gravity Center -crop ".$nwidth1."x".$nheight1."+0+0 +repage -quality 100 ".$serverPath." ".$serverPath."");
            }
        }
        else if (!empty($width))  {
            $nwidth = $nwidth1;
            $nheight = ($nwidth/$width)*$height;

            if($nwidth <> 0) exec("convert -resize ".round($nwidth)."x".round($nheight)." -quality 100 ".$serverPath." ".$serverPath."");
        }

        self::addToDb($id, $class, $field, $path, $name, $format);
    }

    public static function uploadFile($inputName, $class, $field, $id, $path, $f_name = '')
    {
        if(empty($path)) $path = '/public/src/upload/';

        $dir = $_SERVER['DOCUMENT_ROOT'].$path;
	    if(!is_dir($dir)) mkdir($dir, 0755, true);

        $fileName = $_FILES[$inputName]['name'];
        $filePath = $_FILES[$inputName]['tmp_name'];
        $errorCode = $_FILES[$inputName]['error'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

            // Выведем название ошибки
            // die($outputMessage);
            return;
        }

        // Результат функции запишем в переменную
        $image = getimagesize($filePath);

        // Зададим ограничения для картинок
        $limitBytes = 1024 * 1024 * self::$maxFileSize;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер файла не должен превышать '.self::$maxFileSize.' Мбайт.');

        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = uniqid();

        if(!empty($f_name)) $name = $f_name;

        // Сгенерируем расширение файла на основе типа картинки
        $e = explode('.',$fileName);
        $extension = array_pop($e);

        // Сократим .jpeg до .jpg
        $format = '.'.str_replace('jpeg', 'jpg', $extension);

        $serverPath = ROOT . $path . $name . $format;

        // Переместим картинку с новым именем и расширением в папку
        if (!move_uploaded_file($filePath, $serverPath)) {
            die('При записи файла на диск произошла ошибка.');
        }

        self::addToDb($id, $class, $field, $path, $name, $format);
    }

    protected static function addToDb($id, $class, $field, $path, $file,$ext)
    {
        $object = $class::findById($id);

        if (!empty($object->$field)) {
            unlink(ROOT.$object->$field);
        }
        $object->$field = $path.$file.$ext;

        $object->save();
    }

    public static function deleteImageFile($obj)
    {
        if (empty($obj)) return;

        if(!empty($_POST['image_preview_del'])) {
             foreach($_POST['image_preview_del'] AS $field) {

                 if (empty($field)) continue;
                 if (empty($obj->$field)) continue;

                 @unlink(ROOT.$obj->$field);

                 $obj->$field = null;
             }
         }

         return $obj;
    }

    public static function uploadGallery($inputName, $type, $id, $nwidth1, $nheight1, $path, $nwidth2 = null, $nheight2 = null, $f = 0)
    {
        if(empty($path)) $path = '/public/src/upload/';

        $dir = $_SERVER['DOCUMENT_ROOT'].$path;
	    if(!is_dir($dir)) mkdir($dir, 0755, true);

        if(empty($nwidth2)) $nwidth2 = 0;
        if(empty($nheight2)) $nheight2 = 0;

        if(!empty($_FILES[$inputName])) {
            $num = count($_FILES[$inputName]['tmp_name']);
            for($i=0;$i<$num;$i++)
            {
                $filePath = $_FILES[$inputName]['tmp_name'][$i];
                $fileName = $_FILES[$inputName]['name'][$i];
                $errorCode = $_FILES[$inputName]['error'][$i];

                // Проверим на ошибки
                if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

                    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                    $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

                    // Выведем название ошибки
                    // die($outputMessage);
                    return;
                }

                // Создадим ресурс FileInfo
                $fi = finfo_open(FILEINFO_MIME_TYPE);

                // Получим MIME-тип
                $mime = (string)finfo_file($fi, $filePath);

                // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
                if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

                // Результат функции запишем в переменную
                $image = getimagesize($filePath);

                // Зададим ограничения для картинок
                $limitBytes = 1024 * 1024 * self::$maxFileSize;

                // Проверим нужные параметры
                if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать '.self::$maxFileSize.' Мбайт.');

                // Сгенерируем новое имя файла на основе MD5-хеша
                $name = uniqid();

                // Сгенерируем расширение файла на основе типа картинки
                $extension = image_type_to_extension($image[2]);

                $e = explode('.',$fileName);
                $extension = array_pop($e);

                // Сократим .jpeg до .jpg
                $format = '.'.str_replace('jpeg', 'jpg', $extension);

                $serverPath = ROOT . rtrim($path, '/') . '/' . $name . $format;
                $serverPathBig = ROOT . rtrim($path, '/') . '/' . $name .'_big'. $format;
                $serverPathSmall = ROOT . rtrim($path, '/') . '/' . $name .'_small'. $format;

                $big = $name .'_big'. $format;
                $small = $name .'_small'. $format;

                // Переместим картинку с новым именем и расширением в папку
                if (!move_uploaded_file($filePath, $serverPath)) {
                    die('При записи изображения на диск произошла ошибка.');
                }

                $imageinfo = getimagesize($serverPath);
                $width = $imageinfo[0];
                $height = $imageinfo[1];

                //крупное фото
                if (!empty($nwidth1) && !empty($nheight1)) {
                    copy($serverPath, $serverPathBig);

                    if ($f == 1) {
                        if($height >= $nheight1) {
                            $nheight = $nheight1;
                            $nwidth = ($nheight/$height)*$width;

                            if ($nwidth > $nwidth1)
                            {
                                $nwidth = $nwidth1;
                                $nheight = ($nwidth/$width)*$height;
                            }
                        }
                        else if ($width >= $nwidth1) {
                            $nwidth = $nwidth1;
                            $nheight = ($nwidth/$width)*$height;

                            if($nheight > $nheight1)
                            {
                                $nheight = $nheight1;
                                $nwidth = ($nheight/$height)*$width;
                            }
                        }
                        if ($nwidth < 0) exec("convert -resize ".round($nwidth)."x".round($nheight)." -quality 100 ".$serverPathBig." ".$serverPathBig."");
                    }
                    else {
                        $nheight = $nheight1;
                        $nwidth = ($nheight/$height)*$width;

                        if ($nwidth < $nwidth1)
                        {
                            $nwidth = $nwidth1;
                            $nheight = ($nwidth/$width)*$height;
                        }
                       else if ($nheight < $nheight1)
                       {
                           $nheight = $nheight1;
                           $nwidth = ($nheight/$height)*$width;
                       }

                        exec("convert -resize ".round($nwidth)."x".round($nheight)." -quality 100 ".$serverPathBig." ".$serverPathBig."");
                        exec("convert -gravity Center -crop ".$nwidth1."x".$nheight1."+0+0 +repage -quality 100 ".$serverPathBig." ".$serverPathBig."");
                    }
                }

                //мелкое фото
                if (!empty($nwidth2) && !empty($nheight2)) {
                    copy($serverPath, $serverPathSmall);

                    if ($f == 1) {
                        if($height >= $nheight2) {
                            $nheight = $nheight2;
                            $nwidth = ($nheight/$height)*$width;

                            if ($nwidth > $nwidth2)
                            {
                                $nwidth = $nwidth2;
                                $nheight = ($nwidth/$width)*$height;
                            }
                        }
                        else if ($width >= $nwidth2) {
                            $nwidth = $nwidth2;
                            $nheight = ($nwidth/$width)*$height;

                            if($nheight > $nheight2)
                            {
                                $nheight = $nheight2;
                                $nwidth = ($nheight/$height)*$width;
                            }
                        }
                        if ($nwidth < 0) exec("convert -resize ".round($nwidth)."x".round($nheight)." -quality 100 ".$serverPathSmall." ".$serverPathSmall."");
                    }
                    else {
                        $nheight = $nheight2;
                        $nwidth = ($nheight/$height)*$width;

                        if ($nwidth < $nwidth2)
                        {
                            $nwidth = $nwidth2;
                            $nheight = ($nwidth/$width)*$height;
                        }
                       else if ($nheight < $nheight2)
                       {
                           $nheight = $nheight2;
                           $nwidth = ($nheight/$height)*$width;
                       }

                        exec("convert -resize ".round($nwidth)."x".round($nheight)." -quality 100 ".$serverPathSmall." ".$serverPathSmall."");
                        exec("convert -gravity Center -crop ".$nwidth2."x".$nheight2."+0+0 +repage -quality 100 ".$serverPathSmall." ".$serverPathSmall."");
                    }
                }

                self::addToGallery($id, $type, $path, $name.$format, $small, $big);
            }
        }
    }

    protected static function addToGallery($id, $type, $path, $file, $fileSmall, $fileBig)
    {
        $big = $small = '';
        if(!empty($fileBig)) $big = $path.$fileBig;
        if(!empty($fileSmall)) $small = $path.$fileSmall;

        $gallery = new Gallery();
        $gallery->type = $type;
        $gallery->ids = $id;
        $gallery->image = $big;
        $gallery->image_small = $small;
        $gallery->image_origin = $path.$file;
        $gallery->name = '1';
        $gallery->rate = '0';
        $gallery->save();
        var_dump($gallery);
    }

    public static function deleteGallery()
    {
        $gal_id = $_POST['gallery_id'];
        $gal_rate = $_POST['gallery_rate'];
        if (!empty($gal_id)) {
            foreach ($gal_id as $i => $val) {
                $item = Gallery::findById($val);
                $item->rate = (int) $gal_rate[$i];
                $item->save();
            }
        }
        if (isset($_POST['image_gallery_del'])) {
            foreach ($_POST['image_gallery_del'] as $gal) {
                if (!empty($gal))
                    Gallery::del($gal);
            }
        }
    }

    public static function deleteGalleryType($type, $ids)
    {
        if (empty($type) || empty($ids)) return;

        $items = Gallery::findGallery($type, $ids);
        foreach ($items as $item) {
            Gallery::del($item->id);
        }
    }

    public static function uploadFiles($inputName, $type, $id, $path)
    {
        if(empty($path)) $path = '/public/src/upload/';

        $dir = $_SERVER['DOCUMENT_ROOT'].$path;
	    if(!is_dir($dir)) mkdir($dir, 0755, true);

        $num = count($_FILES[$inputName]['tmp_name']);
        for($i=0;$i<$num;$i++)
        {
            $filePath = $_FILES[$inputName]['tmp_name'][$i];
            $fileName = $_FILES[$inputName]['name'][$i];
            $errorCode = $_FILES[$inputName]['error'][$i];

            // Проверим на ошибки
            if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

                // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                $outputMessage = isset(self::$errorMessages[$errorCode]) ? self::$errorMessages[$errorCode] : self::$unknownMessage;

                // Выведем название ошибки
                // die($outputMessage);
                return;
            }

             // Результат функции запишем в переменную
            $image = getimagesize($filePath);

             // Зададим ограничения для картинок
            $limitBytes = 1024 * 1024 * self::$maxFileSize;

            // Проверим нужные параметры
            if (filesize($filePath) > $limitBytes) die('Размер файла не должен превышать 20 Мбайт.');

            // Сгенерируем новое имя файла на основе MD5-хеша
            $name = uniqid();

            // Сгенерируем расширение файла на основе типа картинки
            $extension = image_type_to_extension($image[2]);

            $e = explode('.',$fileName);
            $extension = array_pop($e);

            // Сократим .jpeg до .jpg
            $format = '.'.str_replace('jpeg', 'jpg', $extension);

            $serverPath = ROOT . $path . $name . $format;

            // Переместим картинку с новым именем и расширением в папку
            if (!move_uploaded_file($filePath, $serverPath)) {
                die('При записи файла на диск произошла ошибка.');
            }

            self::addToFiles($id, $type, $path, $name, $format,$fileName);
        }
    }

    protected static function addToFiles($id, $type, $path, $file, $ext,$filename)
    {
        $files = new Files();
        $files->type = $type;
        $files->ids = $id;
        $files->file = $path.$file.$ext;
        $files->filename = $filename;
        $files->ext = trim($ext,'.');

        $files->save();
    }

}
