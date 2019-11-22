<?php

if($_SERVER("REQUEST_METHOD") == 'POST'){
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $mail = filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING);

    require_once 'connect.php';

    if($conn){
        $check_user = "SELECT user_id FROM users WHERE login = '$login'";
        $response = mysqli_query($conn, $check_user);

        $resultCheck = mysqli_num_rows($response);
        if (!$resultCheck){
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $insertUser = "INSERT INTO users (login, pass, mail) 
                values ($login, $pass, $mail)";
            
            if (mysqli_query($conn, $insertUser)){
                echo("successfull registration!");
                mysqli_close($conn);
            }
            else{
                echo("fuck!");
                mysqli_close($conn);
            }
        }
    }
    else{
        die("Connection failed: " . $conn->connect_error);
    }
}

?>