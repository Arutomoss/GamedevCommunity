<?php
// header('Location: http://gamedevcommunity/user.php');

if (isset($_POST)) {
    if (
        isset($_POST['name']) && isset($_POST['game_url']) && isset($_POST['shrt_description']) && isset($_POST['status'])
        && isset($_POST['description']) && isset($_POST['genre']) && isset($_POST['instruction']) && isset($_FILES['game_file'])
        && isset($_FILES['cover'])
    ) {
        $errors = array();

        $user_id             = $_COOKIE['user'];
        $game_name           = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $game_url            = filter_var(trim($_POST['game_url']), FILTER_SANITIZE_STRING);
        $short_description   = filter_var(trim($_POST['shrt_description']), FILTER_SANITIZE_STRING);
        $game_status         = filter_var(trim($_POST['status']), FILTER_SANITIZE_STRING);
        $file_name           = filter_var(trim($_FILES['game_file']['name']), FILTER_SANITIZE_STRING);
        $game_description    = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
        $game_genre          = filter_var(trim($_POST['genre']), FILTER_SANITIZE_STRING);
        $game_instruction    = filter_var(trim($_POST['instruction']), FILTER_SANITIZE_STRING);
        $cover_name          = filter_var(trim($_FILES['cover']['name']), FILTER_SANITIZE_STRING);
        $youtube_link        = filter_var(trim($_POST['video_link']), FILTER_SANITIZE_STRING);

        echo $game_name . '</br>';
        echo $game_url . '</br>';
        echo $short_description . '</br>';
        echo $game_status . '</br>';
        echo $file_name . '</br>';
        echo $game_description . '</br>';
        echo $game_genre . '</br>';
        echo $game_instruction . '</br>';
        echo $cover_name . '</br>';

        $file_name = $_FILES['game_file']['name'];
        $file_size = $_FILES['game_file']['size'];
        $file_tmp = $_FILES['game_file']['tmp_name'];
        $file_type = $_FILES['game_file']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['game-file']['name'])));

        $cover_name = $_FILES['cover']['name'];
        $cover_tmp = $_FILES['cover']['tmp_name'];

        $target_dir = '../../img/';
        $hash = md5($_COOKIE['user'] + rand());
        $name_photo = "{$_COOKIE['user_login']}_{$hash}.jpeg";

        $link_photo = $target_dir . $name_photo;

        if ($file_size > 1073741824) {
            $errors[] = 'Файл должен быть меньше 1Гб.';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../../games/" . $file_name);
            move_uploaded_file($cover_tmp, $link_photo);
            echo "Success";
        } else {
            print $errors;
        }

        $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

        if ($mysql) {
            mysqli_query($mysql, "INSERT INTO photo(link_photo) VALUE ('$link_photo')");

            $photo_id = mysqli_query($mysql, "SELECT photo_id FROM `photo` WHERE link_photo = '$link_photo'");

            if ($photo_id) {
                $row = mysqli_fetch_assoc($photo_id);
            }

            $ph_id = $row['photo_id'];
            echo $ph_id . '</br>';
            echo $user_id . '</br>';

            $result = mysqli_query($mysql, "INSERT INTO `games`(user_id, game_name, game_url, game_short_description, game_description, game_status, game_file_name, game_genre, game_instruction, photo_id) VALUE 
            ('$user_id', '$game_name', '$game_url','$short_description', '$game_description', '$game_status', '$file_name', '$game_genre', '$game_instruction', '$ph_id')");
        } else
            die('Ошибка подключения к серверу баз данных.');

        $mysql->close();
    }
}
