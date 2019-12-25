<?php
if (isset($_COOKIE['user'])) {
    header('Location: http://gamedevcommunity/news.php ');
}

$mysql = mysqli_connect("localhost", "root", "", "gamedc");

$login = filter_var(trim(htmlspecialchars($_POST['login'])), FILTER_SANITIZE_STRING);
$pass = filter_var(trim(htmlspecialchars($_POST['pass'])), FILTER_SANITIZE_STRING);

$errors = array();

if (isset($_POST['do_login'])){

    if (!empty($login) && !empty($pass)) {

        $query = "SELECT * FROM `users` WHERE `user_login` = '$login'";
        $data = mysqli_query($mysql, $query);
    
        if (mysqli_num_rows($data) != 0) {
    
            $pass = md5($pass . "3jk4n23fJ");
            $query = "SELECT * FROM `users` WHERE `user_pass` = '$pass'";
            $data = mysqli_query($mysql, $query);
    
            if (mysqli_num_rows($data) != 0) {

                $result = $mysql->query("SELECT * FROM `users` WHERE `user_login` = '$login' AND `user_pass` = '$pass'");
            
                $user = $result->fetch_assoc();

                setcookie('user', $user['user_id'], time() + 3600 * 30, "/");
                setcookie('user_login', $user['user_login'], time() + 3600 * 30, "/");
                setcookie('first_name', $user['first_name'], time() + 3600 * 30, "/");
                setcookie('last_name', $user['last_name'], time() + 3600 * 30, "/");
                $mysql->close();
                header('Location: http://gamedevcommunity/news.php ');
            } else {
                $errors = 'Неверный пароль';
            }
        } else {
            $errors = "Такой пользователь не найден!";
        }
    } else {
        $errors = 'Заполните все поля';
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
                <form action="sign_in.php" method="POST">
                    <p>Авторизация</p>
                    <input type="text" placeholder="Введите логин или почту" name="login" value="<?php echo $login; ?>">
                    <input type="password" placeholder="Введите пароль" name="pass">

                    <?php if ($errors) {
                        echo '<p style="position: relative; font-size: 14px; text-align: center; width: 100%; padding:0; margin: 0;
                        margin-bottom: -32px; color: rgb(255, 64, 64);">' . $errors . '</p>';
                    } ?>

                    <button type="submit" name="do_login"><img src="img/btn_signin.svg" alt=""></button>

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