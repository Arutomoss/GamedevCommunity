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
    <title>Проголосовать</title>
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
                            <a href="" id="back">
                                <svg width="30" height="16" viewBox="0 0 30 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1L2 8M2 8L9 15M2 8H29.5" stroke="#999999" stroke-width="2" />
                                </svg>
                            </a>
                            <h2 style="padding-top: 10px;" id="jam-title"></h2>
                            <a href="/jam.php?event_id=" class="back" id="back-to-jam">Вернуться на страницу Jam-a</a>
                        </div>
                        <h3 id="game-title"></h3>
                        <p class="sub-header" id="description"></p>

                        <p class="sup-header">Скачать</p>
                        <a href="/games/" id="download-game">
                            <div class="btn btn-danger" style="margin-bottom: 25px">Download game</div>
                        </a>

                        <p class="sub-header" id="who-can-vote-in-jam" hidden>sdfsdf</p>
                        <p class="sup-header" hidden>Проголосовать</p>
                        <div id="reviewStars-input" hidden>
                            <input id="star-4" type="radio" name="reviewStars" value="5" />
                            <label title="gorgeous" for="star-4"></label>

                            <input id="star-3" type="radio" name="reviewStars" value="4" />
                            <label title="good" for="star-3"></label>

                            <input id="star-2" type="radio" name="reviewStars" value="3" />
                            <label title="regular" for="star-2"></label>

                            <input id="star-1" type="radio" name="reviewStars" value="2" />
                            <label title="poor" for="star-1"></label>

                            <input id="star-0" type="radio" name="reviewStars" value="1" />
                            <label title="bad" for="star-0"></label>
                        </div>
                        <div class="btn btn-danger" style="margin-top: 35px; width: 100%;" id="rate-game" hidden>Оставить свой голос</div>
                    </div>
                    <div class="col pr-0">
                        <div class="cover" id="game-img"></div>
                        <a class="sub-header link" href="/php/games/game.php?game_id=<? echo $game_id; ?>" id="game-page">Перейти на страницу игры</a>
                        <p class="dark-text">Игра загружена <a href="" id="user-id"></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/jquery-3.4.1.min.js"></script>

    <script>
        function getEventId() {
            var game_id_ = window.location.search.replace('?game_id=', '');
            game_id_ = game_id_.split('?');
            var game_id = game_id_[0];
            var event_id = game_id_[1].substr(9);
            return event_id;
        }

        function getGameId() {
            var game_id_ = window.location.search.replace('?game_id=', '');
            game_id_ = game_id_.split('?');
            var game_id = game_id_[0];
            return game_id;
        }

        $(document).ready(function() {
            var game_id_ = window.location.search.replace('?game_id=', '');
            game_id_ = game_id_.split('?');

            var game_id = game_id_[0];
            var event_id = game_id_[1].substr(9);
            var user_id = getCookie('user');

            $.ajax({
                type: "POST",
                url: "/php/games/get_game.php",
                data: {
                    game_id: game_id
                },
                success: function(result) {
                    if (result) {
                        var game = JSON.parse(result);
                        var user = getUser(game[0]['user_id']);
                        var event = getEvent(event_id);

                        document.getElementById('jam-title').innerText = event;
                        document.getElementById('game-title').innerText = game[0]['game_name'];
                        document.getElementById('description').innerHTML = game[0]['game_description'];
                        document.getElementById('download-game').href += game[0]['game_file_name'];
                        document.getElementById('game-img').style.backgroundImage = 'url(' + getPhoto(game[0]['photo_id']) + ')';
                        document.getElementById('user-id').textContent = user['first_name'] + ' ' + user['last_name'];
                        document.getElementById('user-id').href = '/../../mypage.php?user_id=' + game[0]['user_id'];
                        document.getElementById('game-page').href = '/php/games/game.php?game_id=' + game[0]['game_id'];
                        document.getElementById('back-to-jam').href = '/jam.php?event_id=' + getEventId();
                        document.getElementById('back').href = '/php/jams/jams_games.php?event_id=' + getEventId();
                    } else
                        alert('Ошибка');
                },
                error: function() {
                    alert('Ошибка!');
                }
            });

            $.ajax({
                type: "POST",
                url: "/php/jams/wich_rate_type.php",
                data: {
                    event_id: event_id,
                    user_id: user_id,
                    game_id: game_id
                },
                success: function(result) {
                    alert(result);
                    switch (result) {
                        case 'who_in_jam': {
                            showItems();
                            break;
                        }
                        case 'who_upload_game': {
                            showItems();
                            break;
                        }
                        case 'who_not_in_jam': {
                            $("#who-can-vote-in-jam").attr("hidden", false);
                            $("#who-can-vote-in-jam").text('Голосовать могут только те, кто участвует в Jam-е');
                            break;
                        }
                        case 'who_not_upload_game': {
                            $("#who-can-vote-in-jam").attr("hidden", false);
                            $("#who-can-vote-in-jam").text('Голосовать могут только те, кто загрузил игру');
                            break;
                        }
                    }
                }
            });
        });

        function showItems() {
            $('.sup-header').attr("hidden", false);
            $('#reviewStars-input').attr("hidden", false);
            $('#rate-game').attr("hidden", false);
        }

        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function getPhoto(photo_id) {
            var link;

            $.ajax({
                type: "POST",
                async: false,
                url: "/php/news/get_photo.php",
                data: {
                    id: photo_id
                },
                success: function(result) {
                    link = result;
                }
            });

            return link;
        }

        function getUser(user_id) {
            var user;

            $.ajax({
                type: "POST",
                async: false,
                url: "/php/news/get_user.php",
                data: {
                    user_id: user_id
                },
                success: function(result) {
                    user = JSON.parse(result);
                }
            });

            return user;
        }

        function getEvent(event_id) {
            var event;

            $.ajax({
                type: "POST",
                async: false,
                url: "/php/jams/get_jam.php",
                data: {
                    event_id: event_id
                },
                success: function(result) {
                    event = result;
                }
            });

            return event;
        }

        $(document).ready(function() {
            $("#rate-game").click(function() {
                var game_id_ = window.location.search.replace('?game_id=', '');
                game_id_ = game_id_.split('?');
                var game_id = game_id_[0];
                var event_id = game_id_[1].substr(9);
                var data = new FormData();

                data.append('game_id', game_id);
                data.append('event_id', event_id);
                data.append('user_id', <?php echo $_COOKIE['user']; ?>);
                data.append('mark', getCheckedRadioValue('reviewStars'));
                data.append('is_rated', isRated(event_id, game_id, <?php echo $_COOKIE['user']; ?>));

                $.ajax({
                    type: "POST",
                    url: "/php/games/rate_game.php",
                    dataType: "html",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(result) {
                        alert(result);
                    },
                    error: function() {
                        alert('Ошибка!');
                    }
                });
            });
        });

        function isRated(event_id, game_id, user_id) {
            var count;

            $.ajax({
                type: "POST",
                async: false,
                url: "/php/games/is_rated.php",
                data: {
                    event_id: event_id,
                    game_id: game_id,
                    user_id: user_id,
                },
                success: function(result) {
                    count = result;
                },
                error: function() {
                    alert('Ошибка!');
                }
            });

            return count;
        }

        function checkType(node) {
            alert(node.value);
        }

        function getCheckedRadioValue(name) {
            var elements = document.getElementsByName(name);

            for (var i = 0, len = elements.length; i < len; ++i)
                if (elements[i].checked) return elements[i].value;
        }
    </script>

</body>

</html>