<?php
// header('Location: http://gamedevcommunity/jams.php');
// echo json_encode($_POST);

if (
    !is_null($_FILES['cover']) && ($_POST['title'] != "") && ($_POST['shrt_description'] != "")
    && ($_POST['description'] != "") && ($_POST['info'] != "") && ($_POST['start_date'] != "")
    && ($_POST['end_date'] != "") && ($_POST['end_vote_date'] != "") && ($_POST['info'] != "")
) {
    if (date('Y-m-d\TH:i', strtotime('now')) > $_POST['start_date']) {
        exit('Дата и время начала мероприятия должны быть позже чем сегодня.');
    }
    if ($_POST['end_date'] < $_POST['start_date']) {
        exit('Дата и время окончания подачи заявок должны быть позже чем дата и время начала мероприятия.');
    }
    if ($_POST['end_vote_date'] < $_POST['end_date']) {
        exit('Дата и время окончания голосования должны быть позже чем дата и время окончания подачи заявок.');
    }

    // Перезапишем переменные для удобства
    $filePath  = $_FILES['cover']['tmp_name'];
    $errorCode = $_FILES['cover']['error'];

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

    if (!@copy($_FILES['cover']['tmp_name'], $link_photo))
        // echo 'Что-то пошло не так';
        // else
        // echo 'Загрузка удачна';

        $user_id = $_COOKIE['user'];
    $event_name          = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
    $event_s_description = filter_var(trim($_POST['shrt_description']), FILTER_SANITIZE_STRING);
    $event_description   = nl2br(filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING));
    $event_info          = nl2br(filter_var(trim($_POST['info']), FILTER_SANITIZE_STRING));
    $event_date_start    = filter_var(trim($_POST['start_date']), FILTER_SANITIZE_STRING);
    $event_date_end      = filter_var(trim($_POST['end_date']), FILTER_SANITIZE_STRING);
    $event_date_vote_end = filter_var(trim($_POST['end_vote_date']), FILTER_SANITIZE_STRING);
    $event_vote_type     = filter_var(trim($_POST['who_can_vote']), FILTER_SANITIZE_STRING);
    $is_vote             = filter_var(trim($_POST['vote']), FILTER_SANITIZE_STRING);

    // echo 'user_id = ' . $user_id . '<br>';
    // echo 'event_name = ' . $event_name . '<br>';
    // echo 'event_s_description = ' . $event_s_description . '<br>';
    // echo 'event_description = ' . $event_description . '<br>';
    // echo 'event_info = ' . $event_info . '<br>';
    // echo 'event_date_start = ' . $event_date_start . '<br>';
    // echo 'event_date_end = ' . $event_date_end . '<br>';
    // echo 'event_date_vote_end = ' . $event_date_vote_end . '<br>';
    // echo 'vote_type = ' . $event_vote_type . '<br>';
    // echo 'is_vote = ' . $is_vote . '<br>';
    // echo 'filePath = ' . $filePath . '<br>';

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    if ($mysql) {
        mysqli_query($mysql, "INSERT INTO photo(link_photo) VALUE ('$link_photo')");

        $photo_id = mysqli_query($mysql, "SELECT photo_id FROM `photo` WHERE link_photo = '$link_photo'");

        if ($photo_id) {
            $row = mysqli_fetch_assoc($photo_id);
        }

        $ph_id = $row['photo_id'];

        // if ($_POST['vote']) {
        $user_id = $_COOKIE['user'];
        if (mysqli_query($mysql, "INSERT INTO `events`(user_id, event_name, event_short_description, event_description, event_info, photo_id, event_date_start, event_date_end, event_date_end_vote, event_is_vote, event_vote_type) VALUE 
            ('$user_id', '$event_name', '$event_s_description', '$event_description', '$event_info', '$ph_id', '$event_date_start', '$event_date_end', '$event_date_vote_end', $is_vote, '$event_vote_type')")) {
            echo "Мероприятие успешно создано!";
        } else {
            echo $mysql->error;
        }
        // } else {
        //     $user_id = $_COOKIE['user'];
        //     if (mysqli_query($mysql, "INSERT INTO `events`(user_id, event_name, event_short_description, event_description, event_info, 
        //     photo_id, event_date_start, event_date_end, event_is_vote) VALUE 
        //     ('$user_id', '$event_name', '$event_s_description', '$event_description', '$event_info', '$ph_id', '$event_date_start', '$event_date_end', $is_vote)")) {
        //         echo "Мероприятие успешно создано!";
        //     } else {
        //         echo $mysql->error;
        //     }
        // }
    } else
        die('Ошибка подключения к серверу баз данных.');

    $mysql->close();
} else {
    $error = 'Не все поля заполнены!';
    echo ($error);
}
