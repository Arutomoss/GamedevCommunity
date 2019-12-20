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
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-mypage.css">
    <title>Новости</title>
</head>

<body>
    <?php
    require 'blocks/headder.php';
    ?>

    <div class="container col-12">
        <div class="wrap row justify-content-center">
            <div class="user-panel">
                <div class="row pd-lr-30 user-header">
                    <div class="user-photo-panel">
                        <?php
                        require 'php/connect.php';
                        $result = mysqli_query($conn, "SELECT photo.link_photo FROM photo INNER JOIN users on photo.photo_id = users.photo_id WHERE photo.photo_id = users.photo_id");
                        
                        $user_id = $_GET['user_id'];
                        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'"));
                        $row = mysqli_fetch_assoc($result);

                        $isFollow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT follower_id FROM subscriptions WHERE (user_id = '$user_id')"));

                        $my_events = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(event_id) as amount FROM events WHERE user_id = '$user_id'"));

                        $conn->close();
                        ?>
                        <img src="<?php echo $row['link_photo']; ?>" alt="" height="60px" class="rounded-circle">
                    </div>
                    <div class="user-name-panel">
                        <?php
                        echo $user['first_name'] . ' ' . $user['last_name'];
                        ?>
                        <p>Indie Game Developer</p>
                    </div>
                </div>
                <div class="info row pd-lr-35">
                    <p>Подписчики: <?php echo count($isFollow); ?></p>
                    <p>Активные мероприятия: </p>
                    <p>Мои мероприятия: <?php echo $my_events['amount']; ?></p>
                </div>
                <div class="settings row pd-lr-35">
                    <a href="settings.php">
                        Настройки
                        <img src="img/settings.svg" alt="">
                    </a>
                </div>
                <?php
                if (isset($_POST['follow']) && (count($isFollow) == 0)) {
                    $follower = $_COOKIE['user'];

                    require 'php/connect.php';
                    mysqli_query($conn, "INSERT INTO `subscriptions`(user_id, follower_id) VALUE ('$user_id', '$follower')");
                    $conn->close();
                }
                ?>
                <form method="POST">
                    <?php
                    if ($_COOKIE['user'] != $user['user_id']) {
                        if (count($isFollow) == 0) {
                            echo '<input type="submit" name="follow" class="btn btn-success pd-lr-30" value="Follow" style="margin-left: 20px;">';
                        } else {
                            echo '<input type="submit" name="unfollow" class="btn btn-danger pd-lr-30" value="Unfollow" style="margin-left: 20px;">';
                        }
                    }
                    ?>
                </form>
                <div class="row buttons pd-lr-30">
                    <!-- <a class="btn rounded-25 pd-lr-60 follow" role="button" href="#">Следить</a>
                    <a class="rounded-circle send_message" role="button" href="#">
                        <img src="img/send_message.svg" alt="">
                    </a> -->
                </div>
            </div>

            <div class="jams">
                <?php
                require 'php/events.php';
                require 'php/connect.php';
                $jams = getJams(1);

                for ($i = 0; $i < count($jams); $i++) {
                    $event_id = $jams[$i]['event_id'];
                    $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE event_id = '$event_id'"));
                    echo '<a href="jam.php?event_id=' . $jams[$i]['event_id'] . '" class="jam row">
                    <div class="content-source">
                        <img src="' . $photo['link_photo'] . '" class="img-fluid" alt="">
                    </div>
                    <div class="jam-title row">
                        <p>' . $jams[$i]['event_name'] . '</p>
                    </div>
                    <div class="jam-description row align-self-end justify-content-between">
                        <div class="short-description align-self-center">
                            <p>' . $jams[$i]['event_short_description'] . '</p>
                        </div>
                        <div class="row" style="margin-right: 30px;">
                            <div class="jam-date-start date-style align-self-center">
                                <p>' . substr($jams[$i]['event_date_start'], 5, 2) . '.' . substr($jams[$i]['event_date_start'], 8, 2) . '</p>
                            </div>
                            <div class="jam-date-end date-style align-self-center">
                                <p>' . substr($jams[$i]['event_date_end'], 5, 2) . '.' . substr($jams[$i]['event_date_end'], 8, 2) . '</p>
                            </div>
                        </div>
                    </div>
                </a>';
                }
                ?>

                <div class="content">
                    <div class="content-icon">
                        <img src="img/logo_light.svg" alt="" height="50px">
                    </div>
                    <div class="wrapp">
                        <div class="content-headder">
                            <div class="content-headder-title">
                                <p>Insomnia Game News</p>
                                <p class="title-info">@ign • 20 мин</p>
                            </div>
                            <div class="content-discription">
                                <p>Sony говорит, что PS5 сможет использовать 8K графику ... но мы не ожидаем, что она сможет
                                    достичь всего этого разрешения изначально. Вот как их консоль следующего поколения
                                    сможет
                                    реализовать все эти пиксели в 2020 году.</p>
                            </div>
                        </div>
                        <div class="content-source_n">
                            <img src="img/post_image_1.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="content-bottom-panel">
                            <div class="content-bottom-panel-comments">
                                <img src="img/comments.svg" alt="">
                                <p>34</p>
                            </div>
                            <div class="content-bottom-panel-reposts">
                                <img src="img/reposts.svg" alt="">
                                <p>9</p>
                            </div>
                            <div class="content-bottom-panel-likes">
                                <img src="img/likes.svg" alt="">
                                <p>734</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="content-icon">
                        <img src="img/logo_light.svg" alt="" height="50px">
                    </div>
                    <div class="wrapp">
                        <div class="content-headder">
                            <div class="content-headder-title">
                                <p>Brakeys</p>
                                <p class="title-info">@brakeys • 20 мин</p>
                            </div>
                            <div class="content-discription">
                                <p>Today we gonna learn to "HOW WRITE A GAME WITHOUT CODE".</p>
                            </div>
                        </div>
                        <div class="content-source_n">
                            <img src="img/post_image_1.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="content-bottom-panel">
                            <div class="content-bottom-panel-comments">
                                <img src="img/comments.svg" alt="">
                                <p>2k</p>
                            </div>
                            <div class="content-bottom-panel-reposts">
                                <img src="img/reposts.svg" alt="">
                                <p>523</p>
                            </div>
                            <div class="content-bottom-panel-likes">
                                <img src="img/likes.svg" alt="">
                                <p>5k</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>