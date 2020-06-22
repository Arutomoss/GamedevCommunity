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
    <link rel="stylesheet" href="/css/style-create_jam.css">
    <link rel="stylesheet" href="/css/style-header.css">
    <title>Создание Мероприятия</title>
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
            <div class="col-9 jam-place">
                <div class="col jam">
                    <div class="row jam-header justify-content-between">
                        <div class="form-group col" style="padding-left: 0px; margin-bottom: 10px;">
                            <h2>Создать новый JAM</h2>
                        </div>
                    </div>
                    <div class="line"></div>
                    <form action="" method="post" id="form" onsubmit="return writeMeSubmit(this);" enctype="multipart/form-data">
                        <!-- save_file.php -->
                        <div class="row">
                            <div class="col plr-0">
                                <p class="sub-header">Название</p>
                                <input type="text" class="input" name="name" id="title" maxlength="45" autocomplete="off">

                                <p class="sub-header">Краткое описание</p>
                                <input type="text" name="shrt_description" class="input" id="shrt_description" placeholder="Опционально" autocomplete="off" maxlength="110">

                                <p class="sub-header">Тип Jam-a</p>
                                <p class="check"><input name="vote" type="radio" value="with_vote" id="vote" checked> С голосованием</p>
                                <p class="check" style="margin-bottom: 30px"><input name="vote" type="radio" value="no_vote" id="no-vote"> Без голосования</p>

                                <div id="who-can-vote">
                                    <p class="sub-header">Кто может голосовать</p>
                                    <p class="check"><input name="who_vote" type="radio" id="who_in_jam" value="who_in_jam" checked> Только участники этого Jam-а</p>
                                    <p class="check"><input name="who_vote" type="radio" id="who_upload_game" value="who_upload_game"> Только тот, кто загрузил игру</p>
                                    <p class="check" style="margin-bottom: 30px"><input name="who_vote" type="radio" id="all" value="all"> Все</p>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="inputDate">Введите дату:</label>
                                    <input type="date" class="form-control">
                                </div> -->

                                <p class="sub-header">Дата начала - С этого дня можно подавать игры.</p>
                                <input class="input" id="start-date" type="datetime-local">

                                <p class="sub-header">Дата окончания - Последний срок для подачи игр.</p>
                                <input class="input" id="end-date" type="datetime-local">

                                <div id="end-vote">
                                    <p class="sub-header">Дата окончания голосования.</p>
                                    <input class="input" id="end-vote-date" type="datetime-local">
                                </div>
                            </div>

                            <div class="col plr-0">
                                <div class="rect">
                                    <div class="fl_upld2">
                                        <label><input id="file_v" type="file" name="cover" accept="image/jpeg">Загрузить обложку</label>
                                        <div id="fl_nm2">Файл не выбран</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <p class="sub-header" style="margin-top: 10px">Описание</p>
                                <p class="text">Опишите ваш Jam, о чем он, его правила.</p>
                                <div class="form-group">
                                    <textarea name="description" class="form-control form-style" id="description" rows="3" maxlength="4000"></textarea>
                                </div>

                                <p class="sub-header" style="margin-top: 25px">Детали</p>
                                <p class="text">Отображается в диалоговом окне, когда участник добавляет свою игру.</p>
                                <div class="form-group">
                                    <textarea name="instruction" class="form-control form-style" id="info" rows="3" maxlength="1000"></textarea>
                                </div>

                                <button type="button" class="btn btn-danger btn-red" id="upload_game">Создать JAM и посмотреть страницу</button>
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
            $("#file_v").change(function() {
                var filename = $(this).val().replace(/.*\\/, "");
                $("#fl_nm2").html(filename);
            });
        });

        var input = document.getElementById('title'),
            value = input.value;

        input.addEventListener('input', onInput);

        function onInput(e) {
            var newValue = e.target.value;
            if (newValue.match(/[^a-zA-Zа-яА-Я0-9-\s()#№.,!:&]/g)) {
                input.value = value;
                return;
            }
            value = newValue;
        }

        $(document).ready(function() {
            $("#vote").change(function() {
                if ($("#vote").attr("checked") == 'checked') {
                    $("#who-can-vote").show();
                }
            })

            $("#no-vote").change(function() {
                if ($("#no-vote").attr("checked") != 'checked') {
                    $("#who-can-vote").hide();
                }
            });
        });

        $(document).ready(function() {
            $("#upload_game").click(function() {
                var fd = new FormData();
                fd.append('cover', $('#file_v')[0].files[0]);
                fd.append('title', document.getElementById('title').value);
                fd.append('shrt_description', document.getElementById('shrt_description').value);

                if (document.getElementById('vote').checked) {
                    fd.append('vote', true);
                } else if (document.getElementById('no-vote').checked) {
                    fd.append('vote', false);
                }

                if (document.getElementById('who_in_jam').checked) {
                    fd.append('who_can_vote', document.getElementById('who_in_jam').value);
                } else if (document.getElementById('who_upload_game').checked) {
                    fd.append('who_can_vote', document.getElementById('who_upload_game').value);
                } else if (document.getElementById('all').checked) {
                    fd.append('who_can_vote', document.getElementById('all').value);
                }
                
                fd.append('description', document.getElementById('description').value);
                fd.append('start_date', document.getElementById('start-date').value);
                fd.append('end_date', document.getElementById('end-date').value);
                fd.append('end_vote_date', document.getElementById('end-vote-date').value);
                fd.append('info', document.getElementById('info').value);

                $.ajax({
                    type: "POST",
                    url: "/php/add_event.php",
                    dataType: "html",
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(result) {
                        alert(result);
                        if (result == 'Мероприятие успешно создано!') {
                            window.location.href = 'http://gamedevcommunity/jams.php';
                        }
                    },
                    error: function() {
                        alert('Ошибка!');
                    }
                });
            });
        });
    </script>

    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>