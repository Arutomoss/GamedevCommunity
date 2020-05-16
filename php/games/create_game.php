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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro:400,400i,700,700i&display=swap&subset=cyrillic,greek,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style-create_game.css">
    <link rel="stylesheet" href="/css/style-header.css">
    <title>Создание игры</title>
</head>

<header class="d-flex flex-column justify-content-center">
    <div class="h_container">
        <nav class="nav">
            <a href="/news.php">
                Новости
                <div style="width: 100%; text-align: center; display: flex; justify-content: center">
                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="white" />
                    </svg>
                </div>
            </a>
            <a href="/messages.php">
                Сообщения
                <div style="width: 100%; text-align: center; display: flex; justify-content: center">
                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="white" />
                    </svg>
                </div>
            </a>
            <a href="/games.php">
                Игры
                <div style="width: 100%; text-align: center; display: flex; justify-content: center">
                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="white" />
                    </svg>
                </div>
            </a>
            <a href="/jams.php">
                Jams
                <div style="width: 100%; text-align: center; display: flex; justify-content: center">
                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="white" />
                    </svg>
                </div>
            </a>
        </nav>
        <div class="user-h">
            <a href="/mypage.php?user_id=<?php echo $_COOKIE['user'] ?>" class="user">
                <div class="user-name" style="color: #EEEEEE;">
                    <?php
                    echo '<img src="/img/down_arrow.svg" alt="" style="padding-right: 6px;">' . $_COOKIE['first_name'] . ' ' . $_COOKIE['last_name'];
                    ?>
                </div>
                <div class="user-photo">
                    <?php
                    require '../../php/connect.php';

                    $user_id = $_COOKIE['user'];
                    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'"));

                    $photo_id = $user['photo_id'];

                    $result = mysqli_query($conn, "SELECT photo.link_photo FROM photo INNER JOIN users on photo.photo_id = users.photo_id WHERE photo.photo_id = '$photo_id'");
                    $row = mysqli_fetch_assoc($result);
                    $conn->close();
                    ?>
                    <img src="<?php echo $row['link_photo']; ?>" alt="" height="35px" class="rounded-circle">
                </div>
            </a>
        </div>

    </div>

</header>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 jam-place">
                <div class="col jam">
                    <div class="row jam-header justify-content-between">
                        <div class="form-group col" style="padding-left: 0px; margin-bottom: 10px;">
                            <h2>Загрузить новую игру</h2>
                        </div>
                    </div>
                    <div class="line"></div>
                    <form action="save_file.php" method="post" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col plr-0">
                                <p class="sub-header">Название</p>
                                <input type="text" class="input" name="name">

                                <p class="sub-header">URL Игры</p>
                                <!-- <input type="text" class="input" placeholder="https://gamedevcommunity.com/games/"> -->
                                <!-- <label for="basic-url">Your vanity URL</label> -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text span" id="basic-addon3">gamedevcommunity.com/games/</span>
                                    </div>
                                    <input type="text" class="form-control input pl-2" id="basic-url" name="game_url" aria-describedby="basic-addon3">
                                </div>

                                <p class="sub-header">Краткое описание</p>
                                <input type="text" name="shrt_description" class="input" placeholder="Опционально">

                                <p class="sub-header">Статус</p>
                                <select name="status" id="" class="input">
                                    <option value="released">Выпущенна</option>
                                    <option value="in_development">В разработке</option>
                                    <option value="on_hold">Разработка приостановлена</option>
                                    <option value="canceled">Остановленна на неопределенный срок</option>
                                </select>

                                <p class="sub-header-big">Загрузка</p>
                                <!-- <input type="file" name="game_file" id="" class="mb-2 input-text"> -->
                                <div class="fl_upld">
                                    <label><input id="fl_inp" type="file" name="game_file" accept=".rar, .exe, .7z, .zip">Выберите файл</label>
                                    <div id="fl_nm">Файл не выбран</div>
                                </div>
                                <p class="text">Размер файла не должен привышать 1 Гб.</p>

                                <p class="sub-header-big" style="margin-top: 30px">Описание</p>
                                <p class="text">Описание вашей игровой страницы</p>
                                <div class="form-group">
                                    <textarea name="description" class="form-control form-style" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>

                                <p class="sub-header">Жанр</p>
                                <select name="genre" id="" class="input">
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

                                <p class="sub-header">***Ссылки в магазине</p>
                                <p class="text">Если ваша игра доступна в других магазинах мы добавим ссылку на нее.</p>
                                <div id="store-inputs">
                                    <div class="wrapper" id="steam" hidden="true">
                                        <p class="sub-header">Steam Store</p>
                                        <input type="text" name="steam_store" class="input" placeholder="https://store.steampowered.com/">
                                        <button type="button" class="exit-btn" onclick="showButton('steam', 'steam-btn')">
                                            <p>+</p>
                                        </button>
                                    </div>

                                    <div class="wrapper" id="apple" hidden="true">
                                        <p class="sub-header">Apple App Store</p>
                                        <input type="text" name="apple_store" class="input" placeholder="https://apps.apple.com/ru/genre/ios/id36">
                                        <button type="button" class="exit-btn" onclick="showButton('apple', 'apple-btn')">
                                            <p>+</p>
                                        </button>
                                    </div>

                                    <div class="wrapper" id="google" hidden="true">
                                        <p class="sub-header">Google Play</p>
                                        <input type="text" name="google_store" class="input" placeholder="https://play.google.com/store">
                                        <button type="button" class="exit-btn" onclick="showButton('google', 'google-btn')">
                                            <p>+</p>
                                        </button>
                                    </div>

                                    <div class="wrapper" id="epic" hidden="true">
                                        <p class="sub-header">Epic Games Store</p>
                                        <input type="text" name="epic_store" class="input" placeholder="https://www.epicgames.com/store/ru/">
                                        <button type="button" class="exit-btn" onclick="showButton('epic', 'epic-btn')">
                                            <p>+</p>
                                        </button>
                                    </div>

                                    <div class="wrapper" id="windows" hidden="true">
                                        <p class="sub-header">Windows Store</p>
                                        <input type="text" name="windows_store" class="input" placeholder="https://www.microsoft.com/ru-ru/store/apps/windows">
                                        <button type="button" class="exit-btn" onclick="showButton('windows', 'windows-btn')">
                                            <p>+</p>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-gray btn-store" id="steam-btn" onclick="hiddeElement('steam', 'steam-btn')">+ Steam Store</button>
                                <button type="button" class="btn btn-gray btn-store" id="apple-btn" onclick="hiddeElement('apple', 'apple-btn')">+ Apple App Store</button>
                                <button type="button" class="btn btn-gray btn-store" id="google-btn" onclick="hiddeElement('google', 'google-btn')">+ Google Play</button>
                                <button type="button" class="btn btn-gray btn-store" id="epic-btn" onclick="hiddeElement('epic', 'epic-btn')">+ Epic Games Store</button>
                                <button type="button" class="btn btn-gray btn-store" id="windows-btn" onclick="hiddeElement('windows', 'windows-btn')">+ Windows Store</button>

                                <p class="sub-header" style="margin-top: 30px">Инструкция по скачиванию и установке</p>
                                <p class="text">Этот текст будет показан кому-то, когда он загружает вашу игру через браузер. Включите любую информацию о том, как установить и запустить то, что они загружают.</p>
                                <div class="form-group">
                                    <textarea name="instruction" class="form-control form-style" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>

                                <button type="submit" class="btn btn-danger btn-red">Сохранить и посмотреть страницу</button>
                            </div>

                            <div class="col plr-0">
                                <div class="rect">
                                    <!-- <button type="button" class="btn btn-danger btn-red">Загрузить обложку</button> -->

                                    <div class="fl_upld2">
                                        <label><input id="fl_inp2" type="file" name="cover" accept="image/jpeg">Загрузить обложку</label>
                                        <div id="fl_nm2">Файл не выбран</div>
                                    </div>
                                </div>

                                <p class="sub-header" style="margin-top: 30px;">Видео геймплея или трейлер</p>

                                <p class="text">Добавьте ссылку с YouTube.</p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text span" id="basic-addon3">https://youtube.com/watch?v=</span>
                                    </div>
                                    <input type="text" class="form-control input pl-2" id="basic-url" name="game_url" aria-describedby="basic-addon3">
                                </div>

                                <p class="sub-header">***Скриншоты</p>
                                <p class="text">Скриншоты будут отображаться на вашей странице игры. Это опционально, но очень рекомендуется. Загрузите 3-5 для лучшего результата.</p>
                                <button type="button" class="btn btn-danger btn-red">Добавить скриншоты</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#fl_inp").change(function() {
                var filename = $(this).val().replace(/.*\\/, "");
                $("#fl_nm").html(filename);
            });
        });

        $(document).ready(function() {
            $("#fl_inp2").change(function() {
                var filename = $(this).val().replace(/.*\\/, "");
                $("#fl_nm2").html(filename);
            });
        });

        var file = document.getElementById('fl_inp');

        file.onchange = function(e) {
            var ext = this.value.match(/\.([^\.]+)$/)[1];
            switch (ext) {
                case 'zip':
                case 'rar':
                case '7z':
                case 'exe':
                    // alert('Allowed');
                    break;
                default:
                    alert('Ошибка! Выбран не верный формат файла, доступные форматы .rar, .7z, .exe, .zip');
                    this.value = '';
            }
        };
    </script>

    <script>
        function hiddeElement(name_id, btn_id) {
            var input = document.getElementById(name_id);
            input.hidden = false;

            var btn = document.getElementById(btn_id);
            btn.hidden = true;
        }

        function showButton(name_id, btn_id) {
            var input = document.getElementById(name_id);
            input.hidden = true;

            var btn = document.getElementById(btn_id);
            btn.hidden = false;
        }
    </script>

    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>