<?php
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

if ($login == '' || $pass == '') {
    echo 'Заполните все поля';
} else {
    $pass = md5($pass . "3jk4n23fJ");

    $mysql = new mysqli("localhost", "root", "", "gamedc");

    $result = $mysql->query("SELECT * FROM `users` 
        WHERE `user_login` = '$login' AND `user_pass` = '$pass'");

    $user = $result->fetch_assoc();
    if (count($user) == 0) {
        echo "Такой пользователь не найден!";
        exit();
    }

    setcookie('user', $user['user_id'], time() + 3600 * 30, "/");
    setcookie('user_login', $user['user_login'], time() + 3600 * 30, "/");
    $mysql->close();
    header('Location: ../news.php');
}
