<?php

$mysql = mysqli_connect("localhost", "root", "", "gamedc");

if (isset($_POST['do_signup'])) {
    $first_name = filter_var(trim(htmlspecialchars($_POST['first_name'])), FILTER_SANITIZE_STRING);
    $last_name = filter_var(trim(htmlspecialchars($_POST['last_name'])), FILTER_SANITIZE_STRING);
    $login = filter_var(trim(htmlspecialchars($_POST['login'])), FILTER_SANITIZE_STRING);
    $mail = filter_var(trim(htmlspecialchars($_POST['mail'])), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim(htmlspecialchars($_POST['pass'])), FILTER_SANITIZE_STRING);
    $pass_accept = filter_var(trim(htmlspecialchars($_POST['pass_accept'])), FILTER_SANITIZE_STRING);

    $errors = array();

    if (!empty($first_name) && !empty($last_name) && !empty($login) && !empty($mail) && !empty($pass) && !empty($pass_accept) && ($pass = $pass_accept)) {
        if (preg_match("/^[а-яА-Яa-zA-Z]+$/u", $first_name))
        {
            if (preg_match("/^[а-яА-Яa-zA-Z]+$/u", $last_name))
            {
                if (mb_strlen($login) > 3 || mb_strlen($login) < 25)
                {
                    if (mb_strlen($pass) > 6 || mb_strlen($pass) < 30)
                    {
                        if (preg_match("#^[aA-zZ0-9\-_]+$#", $login))
                        {
                            if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail))
                            {
                                $query = "SELECT * FROM `users` WHERE `user_login` = '$login'";
                                $data = mysqli_query($mysql, $query);
                                if (mysqli_num_rows($data) == 0)
                                {
                                    $query = "SELECT * FROM `users` WHERE `user_mail` = '$mail'";
                                    $data = mysqli_query($mysql, $query);
                                    if (mysqli_num_rows($data) == 0)
                                    {
                                        $pass = md5($pass . "3jk4n23fJ");

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
                                        $errors = 'Почта уже занята';
                                    }
                                } else {
                                    $errors = 'Логин уже существует';
                                }
                            } else {
                                $errors = 'Неверный формат ввода почты';
                            }
                        } else {
                            $errors = 'Логин может состоять только из латинских символов, цифр либо знака \'_\'';
                        }
                    } else {
                        $errors = 'Длина пароля должна быть больше 6 и меньше 30 символов';
                    }
                } else {
                    $errors = 'Длина логина должна быть больше 3 и меньше 25 символов';
                }
            } else {
                $errors = 'Фамилия может содержать только буквы';
            }
        } else {
            $errors = 'Имя может содержать только буквы';   
        }  
    } else {
        $errors = 'Не все поля заполнены';
    }
}
?>

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
                <form action="registration.php" method="POST">
                    <p>Регистрация</p>
                    <input type="text" placeholder="Ваше имя" name="first_name" autocomplete="no" value="<?php echo $first_name;?>">
                    <input type="text" placeholder="Ваша фамилия" name="last_name" autocomplete="no" value="<?php echo $last_name;?>">
                    <input type="text" placeholder="Придумайте логин" name="login" autocomplete="no" value="<?php echo $login;?>">
                    <input type="mail" placeholder="Введите почту" name="mail" value="<?php echo $mail;?>">
                    <input type="password" placeholder="Введите пароль" name="pass" autocomplete="no" value="<?php echo $pass;?>">
                    <input type="password" placeholder="Подтвердите пароль" name="pass_accept" autocomplete="no" value="<?php echo $pass_accept;?>">

                    <?php if ($errors) {
                        echo '<p style="position: relative; font-size: 14px; text-align: center; width: 100%; padding:0; margin: 0;
                        margin-bottom: -32px; color: rgb(255, 64, 64);">' . $errors . '</p>';
                    } ?>

                    <button type="submit" name="do_signup"><img src="img/btn_regR.svg" alt=""></button>

                    <div class="sign-in">Уже есть аккаунт? <a href="sign_in.php">Войти</a></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>