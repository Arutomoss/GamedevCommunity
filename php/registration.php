<?php

$first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
$last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$pass_accept = filter_var(trim($_POST['pass_accept']), FILTER_SANITIZE_STRING);

$errors = array();

if (mb_strlen($login) < 3 || mb_strlen($login) > 25) {
    $errors = 'Длина логина должна быть больше 3 и меньше 25 символов!';
    echo $errors;
    exit();
} else if (mb_strlen($pass) < 6 || mb_strlen($pass) > 30) {
    $errors = 'Длина пароля должна быть больше 6 и меньше 30 символов!';
    echo $errors;
    exit();
}
if (preg_match("#^[aA-zZ0-9\-_]+$#", $login) && (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail))) {
    
    $pass = md5($pass . "3jk4n23fJ");

    $mysql = new mysqli("localhost", "root", "", "gamedc");
    $result = $mysql->query("INSERT INTO `users` (`first_name`, `last_name`, `user_login`, `user_pass`, `user_mail`) 
            VALUE ('$first_name', '$last_name', '$login', '$pass', '$mail')");

    $user = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT `user_id` FROM `users` WHERE (`user_login` = '$login') AND (`user_mail` = '$mail')"));
    $mysql->close();

    setcookie('user', $user['user_id'], time() + 3600 * 30, "/");
    setcookie('user_login', $login, time() + 3600 * 30, "/");
    setcookie('first_name', $first_name, time() + 3600 * 30, "/");
    setcookie('last_name', $last_name, time() + 3600 * 30, "/");  

    header('Location: ../sign_in.php');
} else {
    $errors = 'Неверно заполнены поля!';
    echo $errors;
    exit();
}
    










// if($_SERVER("REQUEST_METHOD") == 'POST'){
//     $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
//     $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
//     $mail = filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING);

//     require_once 'connect.php';

//     if($conn){
//         $check_user = "SELECT user_id FROM users WHERE login = '$login'";
//         $response = mysqli_query($conn, $check_user);

//         $resultCheck = mysqli_num_rows($response);
//         if (!$resultCheck){
//             $pass = password_hash($pass, PASSWORD_DEFAULT);
//             $insertUser = "INSERT INTO users (login, pass, mail) 
//                 values ($login, $pass, $mail)";
            
//             if (mysqli_query($conn, $insertUser)){
//                 echo("successfull registration!");
//                 mysqli_close($conn);
//             }
//             else{
//                 echo("fuck!");
//                 mysqli_close($conn);
//             }
//         }
//     }
//     else{
//         die("Connection failed: " . $conn->connect_error);
//     }
// }
