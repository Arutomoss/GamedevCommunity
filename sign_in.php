<!DOCTYPE html>
<html lang="en">

<!-- <?php
        require "db.php";
        ?> -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="css/style-sign_in.css">
    <title>Sign In</title>
</head>

<body>
    <div class="bg-circles">
        <div class="logo">
            <img src="img/GDC_LOGO.svg" height="45px" alt="">
        </div>

        <div class="container">
            <div class="registration-form">
                <form action="php/authorization.php" method="POST">
                    <p>Авторизация</p>
                    <input type="text" placeholder="Введите логин или почту" name="login">
                    <input type="password" placeholder="Введите пароль" name="pass">

                    <button type="submit" name="do_signup"><img src="img/btn_signin.svg" alt=""></button>

                    <div class="sign-in">Забыли пароль?
                        <a href="sign_in.php">Восстановить пароль</a>
                    </div>

                    <a href="registration.php" class="registration">Зарегистрироваться</a>

                </form>
            </div>
        </div>
    </div>

    <!-- <script src="js/main.js"></script> -->
</body>

</html>