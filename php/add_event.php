<?php

// Перезапишем переменные для удобства
$filePath  = $_FILES['photo']['tmp_name'];
$errorCode = $_FILES['photo']['error'];

// Проверим на ошибки
if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

    // Массив с названиями ошибок
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
        UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
    ];

    // Зададим неизвестную ошибку
    $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
    $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

    // Выведем название ошибки
    die($outputMessage);
}

// Создадим ресурс FileInfo
$fi = finfo_open(FILEINFO_MIME_TYPE);

// Получим MIME-тип
$mime = (string) finfo_file($fi, $filePath);

// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');


$target_dir = '../img/';
$hash = md5($_COOKIE['user'] + rand());
$name = $_FILES['photo']['name'];
$name_photo = "{$_COOKIE['user_login']}_{$hash}.jpeg";

$link_photo = $target_dir . $name_photo;

if (!@copy($_FILES['photo']['tmp_name'], $link_photo))
    echo 'Что-то пошло не так';
else
    echo 'Загрузка удачна';


$user_id             = $_COOKIE['user'];
$event_name          = filter_var(trim($_POST['jam-name']), FILTER_SANITIZE_STRING);
$event_s_description = filter_var(trim($_POST['short-description']), FILTER_SANITIZE_STRING);
$event_description   = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
$event_date_start    = filter_var(trim($_POST['date_start']), FILTER_SANITIZE_STRING);
$event_date_end      = filter_var(trim($_POST['date_end']), FILTER_SANITIZE_STRING);

echo 'user_id = ' . $user_id . '<br>';
echo 'event_name = ' . $event_name . '<br>';
echo 'event_s_description = ' . $event_s_description . '<br>';
echo 'event_description = ' . $event_description . '<br>';
echo 'event_date_start = ' . $event_date_start . '<br>';
echo 'event_date_end = ' . $event_date_end . '<br>';
echo 'filePath = ' . $filePath . '<br>';


$mysql = new mysqli("localhost", "root", "", "gamedc");

if ($mysql)
    echo 'Соединение установлено.';
else
    die('Ошибка подключения к серверу баз данных.');

$mysql->query("INSERT INTO `photo`(link_photo) VALUE ($link_photo)");

$photo_id = $mysql->query("SELECT photo_id FROM `photo` WHERE link_photo = $link_photo");

$mysql->query("INSERT INTO `events`(user_id, event_name, event_short_description, event_description, 
                photo_id, event_date_start, event_date_end) VALUE 
                ($user_id, $event_name, $event_s_description, $event_description, $photo_id, $event_date_start, $event_date_end)");

$mysql->query("UPDATE `photo` SET event_id = $event_id");

// $add_photo = 
// $add_event = 
// $update_photo = 

print_r('photo id = ' . $photo_id);
// print_r('Photo = ' . $update_photo);

$mysql->close();
// header('Location: http://gamedevcommunity/jams.php');
