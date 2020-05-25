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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-jam.css">
    <title>Jams</title>
</head>

<body onload="addBtn()">
    <?php require 'blocks/headder.php'; ?>

    <?php
    require 'php/connect.php';
    $event_id = $_GET['event_id'];
    $result = mysqli_query($conn, "SELECT * FROM `events` WHERE event_id = '$event_id'");
    $event = mysqli_fetch_assoc($result);

    $user_id = $event['user_id'];
    $user_res = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'");
    $user = mysqli_fetch_assoc($user_res);

    $photo_res = mysqli_query($conn, "SELECT `link_photo` FROM `photo` INNER JOIN `events` on `events`.`photo_id` = `photo`.`photo_id` WHERE `events`.`event_id` = '$event_id'");
    $photo = mysqli_fetch_assoc($photo_res);

    $user_photo_id = $user['photo_id'];
    $user_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$user_photo_id'"));

    $follower = $_COOKIE['user'];

    $amount_members = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(`user_id`) as amount FROM `event_members` WHERE `event_id` = '$event_id'"));

    $conn->close();
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 jam-place">
                <div class="col jam">
                    <div class="row jam-header justify-content-between">
                        <div class="form-group col" style="padding-left: 0px; margin-bottom: 0px">
                            <h2><?php echo $event['event_name']; ?></h2>
                        </div>
                        <div class="name">
                            <?php
                            echo '<a href="mypage.php?user_id=' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</a>';
                            echo '<img src="' . $user_photo['link_photo'] . '" alt="" height="40px" class="rounded-circle" style="margin-left: 10px;">';
                            ?>
                        </div>
                    </div>
                    <div class="row jam-header justify-content-between">
                        <div class="form-group col" style="padding-left: 0px; margin-bottom: 10px">
                            <p class="middle-text" id="amount"><?php echo $amount_members['amount']; ?></p>
                            <p class="little-text">Участников</p>
                        </div>
                    </div>
                    <div class="date-box">
                        <div class="top-box">
                            Подать заявку на участие можно с <b><?php echo substr($event['event_date_start'], 0, 10); ?></b> до <b><?php echo substr($event['event_date_end_vote'], 0, 10); ?></b>
                        </div>
                        <div class="bottom-box row">
                            <div class="starts-after" hidden>Подача заявки до <b><?php echo substr($event['event_date_end_vote'], 10, 15); ?></b> последнего дня</div>
                            <div id="btn-place" hidden>
                                <a href="#" class="btn btn-danger" id="load-game" data-toggle="modal" data-target="#basicModal" style="font-weight: 500;" hidden>Загрузить игру</a>
                                <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Правила Jam-a </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <h3>Modal Body</h3> -->
                                                <p><?php echo $event['event_info']; ?></p>
                                                <p class="sup-header">Выбрать из уже загруженных игр</p>
                                                <select name="user_games" id="user-games" class="input">
                                                </select>

                                                <p class="sup-header">Загрузить новую игру</p>
                                                <input type="button" name="join" id="upload-game" class="btn btn-danger" style="margin-top:7px;" value="Загрузить игру">

                                                <p style="margin-top: 15px; margin-bottom: 0"><i>Вы можете выбрать одно из двух</i></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Отменить</button>
                                                <button type="button" class="btn btn-success" id="submit">Подтвердить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="join" id="join-to-jam" class="btn btn-success pd-lr-30" style="font-weight: 500" value="Присоединиться" hidden>
                                <!-- <input type="button" name="join" id="load-game" class="btn btn-danger pd-lr-30" style="font-weight: 500" value="Загрузить игру" hidden> -->
                                <p class="disconnect" hidden>Отменить участие</p>
                            </div>
                            <a href="jams.php" class="middle-link" id="another" hidden>Другие мероприятия</a>
                        </div>
                    </div>
                    <div style="width: 100;" class="row justify-content-center" id="rate-works" hidden>
                        <a href="/php/jams/jams_games.php?event_id=<?php echo $event['event_id'];?>" class="btn btn-success mb-4">Оценить работы других участников</a>
                    </div>
                    <div class="row">
                        <div class="short-description col-12">
                            <p><?php echo $event['event_short_description']; ?></p>
                        </div>
                    </div>
                    <div class='preview-img'>
                        <img src="<?php echo $photo['link_photo'] ?>" alt="" id="img-source" style="width: 100%;">
                    </div>
                    <div class="row">
                        <div class="col-12 jam-description">
                            <p><?php echo $event['event_description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(function() {
            var event_id = window.location.search.replace('?event_id=', '');
            
        });

        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        function addBtn() {
            var event_id = window.location.search.replace('?event_id=', '');
            $.ajax({
                type: "POST",
                url: "/php/jams/is_join.php",
                data: {
                    event_id: event_id
                },
                success: function(result) {
                    if (result == '0') {
                        $('#join-to-jam').removeAttr('hidden');
                    } else {
                        $('#load-game').removeAttr('hidden');
                        $('.disconnect').removeAttr('hidden');
                    }
                },
                error: function() {
                    alert('Ошибка!');
                }
            });

            $.ajax({
                type: "POST",
                url: "/php/jams/wich_date.php",
                data: {
                    event_id: event_id
                },
                success: function(result) {
                    // alert(result);
                    switch(result){
                        case '0':{
                            $('#btn-place').attr("hidden", true);
                            $('#rate-works').attr("hidden", true);
                            $('#another').attr("hidden", false);
                            $('.starts-after').attr("hidden", false);
                            break;
                        }
                        case '1':{
                            $('#btn-place').attr("hidden", false);
                            $('#rate-works').attr("hidden", true);
                            $('#another').attr("hidden", true);
                            $('.starts-after').attr("hidden", false);
                            break;
                        }
                        case '2':{
                            $('#btn-place').attr("hidden", true);
                            $('#rate-works').attr("hidden", false);
                            $('#another').attr("hidden", false);
                            $('.starts-after').attr("hidden", false);
                            break;
                        }
                        case '3':{
                            $('#btn-place').attr("hidden", true);
                            $('#rate-works').attr("hidden", true);
                            $('#another').attr("hidden", false);
                            $('#another').css('text-align', 'center');
                            $('#another').css('width', '100%');
                            $('#another').css('padding-left', '50px');
                            $('.starts-after').attr("hidden", true);
                            $('.top-box').innerText = 'Мероприятие завершено!';
                            break;
                        }
                    }
                }
            });
        }

        $(document).ready(function() {
            $("#upload-game").click(function() {
                var event_id = window.location.search.replace('?event_id=', '');
                window.location.href = 'http://gamedevcommunity/php/games/create_game.php?event_id=' + event_id;
            });
        });

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "/php/games/get_user_games.php",
                data: {
                    user_id: <?php echo $_COOKIE['user']; ?>
                },
                success: function(result) {
                    var user_games = JSON.parse(result);

                    var combobox = document.getElementById('user-games');

                    for (let i = 0; i < user_games.length; i++) {
                        var game = document.createElement('option');
                        game.value = user_games[i]['game_name'];
                        game.innerText = user_games[i]['game_name'];
                        combobox.appendChild(game)
                    }
                },
                error: function() {
                    alert('Ошибка!');
                }
            });

        });

        $(document).ready(function() {
            $("#join-to-jam").click(function() {
                var event_id = window.location.search.replace('?event_id=', '');
                var data = new FormData();

                $("#join-to-jam").attr("hidden", true);
                $("#load-game").attr("hidden", false);
                $(".disconnect").attr("hidden", false);

                data.append('join', 'join');
                data.append('event_id', event_id);

                $.ajax({
                    type: "POST",
                    url: "/php/jams/join_to_jam.php",
                    dataType: "html",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(result) {
                        if (result == 'joined') {
                            var amount = document.getElementById('amount');
                            amount.textContent = parseInt(amount.textContent, 10) + 1;
                        }
                    },
                    error: function() {
                        alert('Ошибка!');
                    }
                });
            });

            $(".disconnect").click(function() {
                $("#join-to-jam").attr("hidden", false);
                $("#load-game").attr("hidden", true);
                $(".disconnect").attr("hidden", true);

                var event_id = window.location.search.replace('?event_id=', '');
                var data = new FormData();

                data.append('join', 'disconnect');
                data.append('event_id', event_id);

                $.ajax({
                    type: "POST",
                    url: "/php/jams/join_to_jam.php",
                    dataType: "html",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(result) {
                        if (result == 'diconnected') {
                            var amount = document.getElementById('amount');
                            amount.textContent = parseInt(amount.textContent, 10) - 1;
                        }
                    },
                    error: function() {
                        alert('Ошибка!');
                    }
                });
            });
        });

        $(document).ready(function() {
            $("#submit").click(function() {
                var event_id = window.location.search.replace('?event_id=', '');
                var data = new FormData();

                data.append('game_name', $("#user-games").val());
                data.append('event_id', event_id);
                data.append('user_id', <?php echo $_COOKIE['user']; ?>);

                $.ajax({
                    type: "POST",
                    url: "/php/jams/submit_game.php",
                    dataType: "html",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(result) {
                        alert(result);
                        if (result == 'Игра успешно добавлена') {
                            var event_id = window.location.search.replace('?event_id=', '');
                            window.location.href = 'http://gamedevcommunity/php/jams/jams_games.php?event_id=' + event_id;
                        }
                    },
                    error: function() {
                        alert('Ошибка!');
                    }
                });
            });
        });
    </script>

    <!-- <script src="js/main.js"></script> -->
    <!-- <script src="js/popper.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>