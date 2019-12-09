<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style-registration.css">
    <title>Registration</title>
</head>

<!-- <?php
    // require "db.php";

    // $data = $_POST;

    // if ( isset($data['do_signup']) ){
    //     // REGISTRATION

    //     $errors = array();
    //     if ( trim($data['login']) == '' ){
    //         $errors[] = 'Введите логин!';
    //     }

    //     if ( trim($data['mail']) == '' ){
    //         $errors[] = 'Введите почту!';
    //     }

    //     if ( trim($data['pass']) == '' ){
    //         $errors[] = 'Введите пароль!';
    //     }

    //     if ( trim($data['pass_accept']) == '' ){
    //         $errors[] = 'Введите подтверждение пароля!';
    //     }

    //     if ( $data['pass_accept'] != $data['pass'] ){
    //         $errors[] = 'Пароли не совпадают!';
    //     }

    //     if ( empty($errors) ){
    //         // OK
    //         $user = R::dispense('users');
    //         $user->login = $data['login'];
    //         $user->pass = $data['pass'];
    //         $user->mail = $data['mail'];
    //         R::store($user);
    //         echo '<div style="color: yellowgreen;">Вы успешно зарегистрировались</div><hr>';
    //     }
    //     else{
    //         // ERROR
    //         echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    //     }
    // }
?> -->

<body>
    <div class="bg-circles">
        <div class="logo">
            <img src="img/GDC_LOGO.svg" height="45px" alt="">
        </div>

        <div class="container">
            <div class="registration-form">
                
                <form action="php/registration.php" method="POST">
                    <p>Регистрация</p>
                    <input type="text" placeholder="Придумайте логин" name="login">
                    <input type="mail" placeholder="Введите почту" name="mail">
                    <input type="password" placeholder="Введите пароль" name="pass">
                    <input type="password" placeholder="Подтвердите пароль" name="pass_accept">

                    <button type="submit" name="do_signup"><img src="img/btn_regR.svg" alt=""></button>

                    <div class="sign-in">Уже есть аккаунт? <a href="sign_in.php">Войти</a></div>
                </form>
<?php //require 'php/registration.php'; ?>
            </div>
        </div>
    </div>
</body>

  <!-- value="<?php //echo @$data['login']; ?>" -->
  <!-- value="<?php //echo @$data['mail']; ?>" -->
  <!-- value="<?php //echo @$data['pass']; ?>" -->
  <!-- value="<?php //echo @$data['pass_accept']; ?>" -->

</html>