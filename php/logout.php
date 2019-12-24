<?php

if (isset($_GET['logout']) == 'true'){
    setcookie('user', null, -1, "/");
    setcookie('user_login', null, -1, "/");
    setcookie('first_name', null, -1, "/");
    setcookie('last_name', null, -1, "/"); 

    header('Location: ../sign_in.php');
}