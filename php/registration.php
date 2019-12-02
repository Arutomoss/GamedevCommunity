<?php

    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
    $pass_accept = filter_var(trim($_POST['pass_accept']), FILTER_SANITIZE_STRING);

    $errors = array();

    if (mb_strlen($login) < 3 || mb_strlen($login) > 25){
        $errors = 'Длина логина должна быть больше 3 и меньше 25 символов!';
        echo $errors;
        exit();
    }
    else if (mb_strlen($pass) < 6 || mb_strlen($pass) > 30){
        $errors = 'Длина пароля должна быть больше 6 и меньше 30 символов!';
        echo $errors;
        exit();
    }
    if (preg_match("#^[aA-zZ0-9\-_]+$#",$login) && (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail))){
        $pass = md5($pass."3jk4n23fJ");

        $mysql = new mysqli("localhost", "root", "", "gamedc");
        $mysql->query("INSERT INTO `users` (`user_login`, `user_pass`, `user_mail`) 
            VALUES ('$login', '$pass', '$mail')");
    
        $mysql->close();
    
        header('Location: ../sign_in.html');
    }
    else{
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

?>