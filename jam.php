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
                            Подать заявку на участие можно с <b><?php echo substr($event['event_date_start'], 0, 10); ?></b> до <b><?php echo substr($event['event_date_end'], 0, 10); ?></b>
                        </div>
                        <div class="bottom-box row">
                            <div class="starts-after">Подача заявки до <b><?php echo substr($event['event_date_end'], 10, 15); ?></b> последнего дня</div>
                            <div id="btn-place">
                                <input type="button" name="join" id="join-to-jam" class="btn btn-success pd-lr-30" style="font-weight: 500" value="Присоединиться" hidden>
                                <input type="button" name="join" id="load-game" class="btn btn-danger pd-lr-30" style="font-weight: 500" value="Загрузить игру" hidden>
                                <p class="disconnect" hidden>Отменить участие</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="short-description col-12">
                            <p><?php echo $event['event_short_description']; ?></p>
                        </div>
                    </div>
                    <div class='preview-img'>
                        <img src="<?php echo $photo['link_photo'] ?>" alt="" id="img-source" style="width: 100%;">
                    </div>
                    <?php
                    // if (isset($_POST['join'])) {
                    //     require 'php/connect.php';
                    //     mysqli_query($conn, "INSERT INTO `event_members`(`event_id`, `user_id`) VALUE ('$event_id', '$follower')");
                    //     $conn->close();

                    //     echo "<script>(window.location.href='jam.php?event_id=$event_id')()</script>";
                    // } else if (isset($_POST['disconnect'])) {
                    //     require 'php/connect.php';
                    //     mysqli_query($conn, "DELETE FROM `event_members` WHERE (`event_id` = '$event_id') AND (`user_id` = '$follower')");
                    //     $conn->close();

                    //     echo "<script>(window.location.href='jam.php?event_id=$event_id')()</script>";
                    // }
                    ?>
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
        function addBtn() {
            $.ajax({
                type: "POST",
                url: "/php/jams/is_join.php",
                data: {
                    event_id: <?php echo $_GET['event_id']; ?>
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
        }

        $(document).ready(function() {
            $("#load-game").click(function() {
                window.location.href = 'http://gamedevcommunity/php/games/create_game.php?event_id=' + <?php echo $_GET['event_id']; ?>;
            });
        });

        $(document).ready(function() {
            $("#join-to-jam").click(function() {
                var data = new FormData();
                $("#join-to-jam").attr("hidden", true);
                $("#load-game").attr("hidden", false);
                $(".disconnect").attr("hidden", false);

                data.append('join', 'join');
                data.append('event_id', <?php echo $_GET['event_id']; ?>);

                $.ajax({
                    type: "POST",
                    url: "/php/jams/join_to_jam.php",
                    dataType: "html",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(result) {
                        if (result == 'joined'){
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
                var data = new FormData();

                $("#join-to-jam").attr("hidden", false);
                $("#load-game").attr("hidden", true);
                $(".disconnect").attr("hidden", true);

                data.append('join', 'disconnect');
                data.append('event_id', <?php echo $_GET['event_id']; ?>);

                $.ajax({
                    type: "POST",
                    url: "/php/jams/join_to_jam.php",
                    dataType: "html",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(result) {
                        if (result == 'diconnected'){
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
    </script>

    <script src="js/main.js"></script>
    <!-- <script src="js/popper.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>