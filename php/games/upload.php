<?php
// header('Location: http://gamedevcommunity/user.php');

if (isset($_POST)) {
    if (
        ($_POST['title'] != "") && ($_POST['shrt_description'] != "") && ($_POST['status'] != "") && ($_POST['description'] != "")
        && ($_POST['genre'] != "") && ($_POST['info'] != "") && (!is_null($_FILES['file'])) && (!is_null($_FILES['cover']))
    ) {
        // $errors = array();        

        $user_id             = $_COOKIE['user'];
        $game_name           = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
        // $game_url            = filter_var(trim($_POST['game_url']), FILTER_SANITIZE_STRING);
        $short_description   = filter_var(trim($_POST['shrt_description']), FILTER_SANITIZE_STRING);
        $game_status         = filter_var(trim($_POST['status']), FILTER_SANITIZE_STRING);
        $file_name           = filter_var(trim($_FILES['file']['name']), FILTER_SANITIZE_STRING);
        $game_description    = nl2br(filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING));
        $game_genre          = filter_var(trim($_POST['genre']), FILTER_SANITIZE_STRING);
        $game_instruction    = nl2br(filter_var(trim($_POST['info']), FILTER_SANITIZE_STRING));
        $cover_name          = filter_var(trim($_FILES['cover']['name']), FILTER_SANITIZE_STRING);
        $youtube_link        = filter_var(trim($_POST['youtube']), FILTER_SANITIZE_STRING);
        $event_id            = filter_var(trim($_POST['event_id']), FILTER_SANITIZE_STRING);

        // echo $game_name . '</br>';
        // echo $game_url . '</br>';
        // echo $short_description . '</br>';
        // echo $game_status . '</br>';
        // echo $file_name . '</br>';
        // echo $game_description . '</br>';
        // echo $game_genre . '</br>';
        // echo $game_instruction . '</br>';
        // echo $cover_name . '</br>';

        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['file']['name'])));

        $cover_name = $_FILES['cover']['name'];
        $cover_tmp = $_FILES['cover']['tmp_name'];

        $target_dir = '../../img/';
        $hash = md5($_COOKIE['user'] + rand());
        $name_photo = "{$_COOKIE['user_login']}_{$hash}.jpeg";

        $link_photo = $target_dir . $name_photo;

        if ($file_size > 1073741824) {
            $errors[] = 'Файл должен быть меньше 1Гб.';
        }

        $game_size = number_format($file_size / 1048576, 2) . ' Mb';

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../../games/" . $file_name);
            move_uploaded_file($cover_tmp, $link_photo);
            // echo "Success";
        } else {
            print $errors;
        }

        $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

        if ($mysql) {
            if ($youtube_link != "") {
                if ($event_id != "") {
                    mysqli_query($mysql, "INSERT INTO photo(link_photo) VALUE ('$link_photo')");

                    $photo_id = mysqli_query($mysql, "SELECT photo_id FROM `photo` WHERE link_photo = '$link_photo'");

                    if ($photo_id) {
                        $row = mysqli_fetch_assoc($photo_id);
                    }

                    $ph_id = $row['photo_id'];

                    $result = mysqli_query($mysql, "INSERT INTO `games`(user_id, game_name, game_short_description, game_description, game_status, game_file_name, game_genre, game_instruction, photo_id, youtube_link, game_size, event_id) VALUE 
                ('$user_id', '$game_name','$short_description', '$game_description', '$game_status', '$file_name', '$game_genre', '$game_instruction', '$ph_id','$youtube_link', '$game_size', '$event_id')");
                    echo "Мероприятие успешно создано!";
                } else {
                    mysqli_query($mysql, "INSERT INTO photo(link_photo) VALUE ('$link_photo')");

                    $photo_id = mysqli_query($mysql, "SELECT photo_id FROM `photo` WHERE link_photo = '$link_photo'");

                    if ($photo_id) {
                        $row = mysqli_fetch_assoc($photo_id);
                    }

                    $ph_id = $row['photo_id'];

                    $result = mysqli_query($mysql, "INSERT INTO `games`(user_id, game_name, game_short_description, game_description, game_status, game_file_name, game_genre, game_instruction, photo_id, youtube_link, game_size) VALUE 
            ('$user_id', '$game_name','$short_description', '$game_description', '$game_status', '$file_name', '$game_genre', '$game_instruction', '$ph_id','$youtube_link', '$game_size')");
                    echo "Мероприятие успешно создано!";
                }
            } else {
                if ($event_id != "") {
                    mysqli_query($mysql, "INSERT INTO photo(link_photo) VALUE ('$link_photo')");

                    $photo_id = mysqli_query($mysql, "SELECT photo_id FROM `photo` WHERE link_photo = '$link_photo'");

                    if ($photo_id) {
                        $row = mysqli_fetch_assoc($photo_id);
                    }

                    $ph_id = $row['photo_id'];

                    $result = mysqli_query($mysql, "INSERT INTO `games`(user_id, game_name, game_short_description, game_description, game_status, game_file_name, game_genre, game_instruction, photo_id, game_size, event_id) VALUE 
                ('$user_id', '$game_name', '$short_description', '$game_description', '$game_status', '$file_name', '$game_genre', '$game_instruction', '$ph_id', '$game_size', '$event_id')");
                    echo "Мероприятие успешно создано!";
                } else {
                    mysqli_query($mysql, "INSERT INTO photo(link_photo) VALUE ('$link_photo')");

                    $photo_id = mysqli_query($mysql, "SELECT photo_id FROM `photo` WHERE link_photo = '$link_photo'");

                    if ($photo_id) {
                        $row = mysqli_fetch_assoc($photo_id);
                    }

                    $ph_id = $row['photo_id'];

                    $result = mysqli_query($mysql, "INSERT INTO `games`(user_id, game_name, game_short_description, game_description, game_status, game_file_name, game_genre, game_instruction, photo_id, game_size) VALUE 
            ('$user_id', '$game_name', '$short_description', '$game_description', '$game_status', '$file_name', '$game_genre', '$game_instruction', '$ph_id', '$game_size')");
                    echo "Мероприятие успешно создано!";
                }
            }
        } else
            die('Ошибка подключения к серверу баз данных.');

        $mysql->close();
    } else {
        $error = 'Не все поля заполнены!';
        echo ($error);
    }
}
