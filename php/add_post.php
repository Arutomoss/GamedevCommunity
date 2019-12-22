<?php
header('Location: http://gamedevcommunity/news.php');
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
    echo $outputMessage;
}

if ($errorMessages != 'Файл не был загружен.') {
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
}

$user_id   = $_COOKIE['user'];
$post_text = $_POST['post_text'];


$mysql = mysqli_connect("localhost", "root", "", "gamedc");

if ($mysql) {
    if ($link_photo) {
        mysqli_query($mysql, "INSERT INTO `photo`(link_photo) VALUE ('$link_photo')");

        $photo_id = mysqli_query($mysql, "SELECT `photo_id` FROM `photo` WHERE `link_photo` = '$link_photo'");

        if ($photo_id) {
            $row = mysqli_fetch_assoc($photo_id);
        }

        $ph_id = $row['photo_id'];

        mysqli_query($mysql, "INSERT INTO `posts`(user_id, post_text, photo_id, amount_likes, amount_reposts) 
            VALUE ('$user_id', '$post_text', '$ph_id', 0, 0)");
        echo '1';
    } else {
        mysqli_query($mysql, "INSERT INTO `posts`(user_id, post_text, amount_likes, amount_reposts) 
        VALUE ('$user_id', '$post_text', 0, 0)");
        echo '2';
    }
} else
    die('Ошибка подключения к серверу баз данных.');

$mysql->close();
