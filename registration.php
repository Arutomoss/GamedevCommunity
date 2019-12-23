<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="css/style-registration.css">
    <title>Registration</title>
</head>

<body>
    <div class="bg-circles">
        <div class="logo">
            <img src="img/GDC_LOGO.svg" height="45px" alt="">
        </div>

        <div class="container">
            <div class="registration-form">
                <form action="php/registration.php" method="POST">
                    <p>Регистрация</p>
                    <input type="text" placeholder="Ваше имя" name="first_name" autocomplete="no">
                    <input type="text" placeholder="Ваша фамилия" name="last_name" autocomplete="no">
                    <input type="text" placeholder="Придумайте логин" name="login" autocomplete="no">
                    <input type="mail" placeholder="Введите почту" name="mail">
                    <input type="password" placeholder="Введите пароль" name="pass" autocomplete="no">
                    <input type="password" placeholder="Подтвердите пароль" name="pass_accept" autocomplete="no">

                    <button type="submit" name="do_signup"><img src="img/btn_regR.svg" alt=""></button>

                    <div class="sign-in">Уже есть аккаунт? <a href="sign_in.php">Войти</a></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>