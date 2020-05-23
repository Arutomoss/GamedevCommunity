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
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style-jams_games.css">
    <title>Игры</title>
</head>

<body>
    <?php
    require 'C:/OpenServer/OpenServer/domains/GamedevCommunity/blocks/headder.php';
    ?>

    <div class="container col-11">
        <div class="row games-place justify-content-center">
            <div class="col-7 games">
                <div class="row">
                    <div class="col-7 left-line">
                        <div class="header underline">
                            <a href="php/jams/jams_games.php?event_id=<?php echo $_GET['event_id']; ?>">
                                <svg width="30" height="16" viewBox="0 0 30 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1L2 8M2 8L9 15M2 8H29.5" stroke="#999999" stroke-width="2" />
                                </svg>
                            </a>
                            <h2>Title</h2>
                            <a href="/jam.php?event_id=<?php echo $_GET['event_id']; ?>" class="back">Вернуться на страницу Jam-a</a>
                        </div>
                        <h3>Game Tittle</h3>
                        <p class="sub-header">This is my short description, with additional text</p>

                        <p class="sup-header">Скачать</p>
                        <div class="btn btn-danger" style="margin-bottom: 25px">Download game</div>

                        <p class="sup-header">Проголосовать</p>
                        <div id="reviewStars-input">
                            <input id="star-4" type="radio" name="reviewStars" />
                            <label title="gorgeous" for="star-4"></label>

                            <input id="star-3" type="radio" name="reviewStars" />
                            <label title="good" for="star-3"></label>

                            <input id="star-2" type="radio" name="reviewStars" />
                            <label title="regular" for="star-2"></label>

                            <input id="star-1" type="radio" name="reviewStars" />
                            <label title="poor" for="star-1"></label>

                            <input id="star-0" type="radio" name="reviewStars" />
                            <label title="bad" for="star-0"></label>
                        </div>

                        <div class="btn btn-danger" style="margin-top: 35px; width: 100%;">Оставить свой голос</div>
                    </div>
                    <div class="col pr-0">
                        <img src="../../img/arutomu_d90fbc50ad84776f34f5de954a06df97.jpeg" alt="" class="cover">
                        <a class="sub-header link" href="/php/games/game.php?game_id=<? echo $game_id; ?>">Перейти на страницу игры</a>
                        <p class="dark-text">Игра загружена <a href="">Erick Crause</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/jquery-3.4.1.min.js"></script>

</body>

</html>