<?php
if ($_COOKIE['user'] == '') {
    header('Location: http://gamedevcommunity/sign_in.php ');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,400i,500,500i,700,900&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-all_games.css">
    <title>Игры</title>
</head>

<body>
    <?php
    require 'blocks/headder.php';
    ?>

    <!-- <div class="container col-12" style="margin-bottom: 60px">
        <div class="wrap row justify-content-center">
            <div class="col-2">
                <div class="user-panel row">
                    <div class="row pd-lr-30 user-header">
                        <div class="user-name-panel">
                            <?php
                            echo $user['first_name'] . ' ' . $user['last_name'];
                            ?>
                            <p><?php echo $user['short_description']; ?></p>
                        </div>
                    </div>
                    <div class="info row pd-lr-35">
                        <p>Подписчики: <?php echo $amount_followers['amount']; ?></p>
                        <p>Активные мероприятия: <?php echo $amount_active_jams; ?></p>
                        <p>Созданные мероприятия: <?php echo $my_events['amount']; ?></p>
                    </div>
                    <?php
                    if ($_COOKIE['user'] == $user['user_id']) {
                        echo '<div class="settings row pd-lr-35">
                    <a href="settings.php">
                        Настройки
                        <img src="img/settings.svg" alt="">
                    </a>
                    </div>
                    <div class="row pd-lr-35" style="margin-bottom: 20px">
                        <a href="/php/games/create_game.php">
                            <button type="button" class="btn btn-danger m0" id="upload-game" style="font-weight: 500">Загрузить игру</button>
                        </a>                    
                    </div>';
                    }
                    ?>

                    <?php
                    if (isset($_POST['follow']) && (count($isFollow) == 0)) {
                        $follower = $_COOKIE['user'];

                        require 'php/connect.php';
                        mysqli_query($conn, "INSERT INTO `subscriptions`(user_id, follower_id) VALUE ('$user_id', '$follower')");
                        $conn->close();

                        echo "<script>(window.location.href='mypage.php?user_id=$user_id')()</script>";
                    } else if (isset($_POST['unfollow']) && (count($isFollow) != 0)) {
                        $follower = $_COOKIE['user'];

                        require 'php/connect.php';
                        mysqli_query($conn, "DELETE FROM `subscriptions` WHERE (`user_id` = '$user_id') AND (`follower_id` = '$follower')");
                        $conn->close();

                        echo "<script>(window.location.href='mypage.php?user_id=$user_id')()</script>";
                    }
                    ?>
                    <form method="POST">
                        <?php

                        if ($_COOKIE['user'] != $user_id) {
                            if (count($isFollow) == 0) {
                                echo '<input type="submit" name="follow" class="btn btn-success pd-lr-30" value="Follow" style="margin-left: 20px;">';
                            } else {
                                echo '<input type="submit" name="unfollow" class="btn btn-danger pd-lr-30" value="Unfollow" style="margin-left: 20px;">';
                            }
                        }
                        ?>
                    </form>

                </div>
            </div>
            <div class="games col-6">
                <div class="row">
                    <div class="game col">
                        <img src="/img/1.jpg" alt="" width="100%" class="rounded-10">
                        <p class="title">Title</p>
                        <p class="description">short description</p>
                        <div class="user-name">user name<p>platformer</p>
                        </div>
                    </div>
                    <div class="game col">
                        <img src="/img/1.jpg" alt="" width="100%" class="rounded-10">
                        <p class="title">Title</p>
                        <p class="description">short description</p>
                        <div class="user-name">user name<div>platformer</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> -->
    <div class="container col-11">
        <div class="wrap row justify-content-center">
            <div class="pr-0">
                <div class="user-panel ">
                    <div class="search paddings">
                        <p class="sub-header">Поиск</p>
                        <input type="text" class="input" placeholder="Введите название игры" id="search-input" name="search" oninput="searchGame()" autocomplete="off">
                    </div>

                    <div class="sort paddings">
                        <p class="sub-header">Сортировка</p>
                        <select name="sort_games" id="sort_games" class="input">
                            <option value="date_new">По дате, сперва новые</option>
                            <option value="date_old">По дате, сперва старые</option>
                            <!-- <option value="genre">По жанру</option> -->
                        </select>
                    </div>

                    <div class="genre paddings">
                        <p class="sub-header">Жанр</p>
                        <select name="genre" id="genre" class="input">
                            <option value="no_genre">Без жанра</option>
                            <option value="platformer">Платфромер</option>
                            <option value="action">Экшн</option>
                            <option value="shooter">Шутер</option>
                            <option value="adventure">Приключения</option>
                            <option value="role_play">Ролевая</option>
                            <option value="survival">Выживание</option>
                            <option value="simulation">Симулятор</option>
                            <option value="strategy">Стратегия</option>
                            <option value="fighting">Файтинг</option>
                            <option value="racing">Гонки</option>
                            <option value="education">Образовательная</option>
                            <option value="visual_novel">Визуальная новелла</option>
                            <option value="puzzle">Пазл</option>
                            <option value="rhythm">Ритм</option>
                            <option value="sport">Спорт</option>
                            <option value="card_game">Карточная игра</option>
                            <option value="other">Другой</option>
                        </select>
                    </div>

                    <div class="paddings" style="margin-bottom: 20px">
                        <a href="/php/games/create_game.php">
                            <button type="button" class="btn btn-success m0 w-100" id="upload-game" style="font-weight: 500">Загрузить игру</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-8 games">
                <div class="row" id="games">
                    <!-- <div class="game">
                        <a href="">
                            <div class="rounded-10 game-cover"></div>
                        </a>
                        <p class="title">Title</p>
                        <p class="description">short description</p>
                        <div class="user-name row justify-content-between">user name<p>platformer</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script src="ajax/games_functions.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "/php/games/get_games.php",
                success: function(result) {
                    if (result)
                        showAllGames(JSON.parse(result));
                    else
                        showAllGames("");
                },
                error: function() {
                    alert('Ошибка!');
                }
            });
        });
    </script>

</body>

</html>