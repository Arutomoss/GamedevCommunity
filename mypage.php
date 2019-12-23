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
    <title>Моя страница</title>
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
                        $row = mysqli_fetch_assoc($result);

                        $user_id = $_GET['user_id'];
                        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'"));

                        $follower = $_COOKIE['user'];
                        $isFollow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `follower_id` FROM `subscriptions` WHERE (user_id = '$user_id') AND (`follower_id` = '$follower')"));

                        $my_events = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(event_id) as amount FROM events WHERE user_id = '$user_id'"));

                        $photo_id = $user['photo_id'];
                        $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$photo_id'"));

                        $amount_active_jams = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(`event_id`) as amount FROM `event_members` WHERE `user_id` = '$user_id'"));

                        $conn->close();
                        ?>
                        <img src="<?php echo $photo['link_photo']; ?>" alt="" height="65px" class="rounded-circle">
                    </div>
                    <div class="user-name-panel">
                        <?php
                        echo $user['first_name'] . ' ' . $user['last_name'];
                        ?>
                        <p><?php echo $user['short_description']; ?></p>
                    </div>
                </div>
                <div class="info row pd-lr-35">
                    <p>Подписчики: <?php echo count($isFollow); ?></p>
                    <p>Активные мероприятия: <?php echo $amount_active_jams['amount']; ?></p>
                    <p>Мои мероприятия: <?php echo $my_events['amount']; ?></p>
                </div>
                <?php
                if ($_COOKIE['user'] == $user['user_id']) {
                    echo '<div class="settings row pd-lr-35">
                    <a href="settings.php">
                        Настройки
                        <img src="img/settings.svg" alt="">
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
                    // $isFollow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `follower_id` FROM `subscriptions` WHERE (user_id = '$user_id') AND (`follower_id` = '$follower')"));

                    if ($_COOKIE['user'] != $user_id) {
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
                $jams = getUserJams(1, $user_id);

                if (count($jams) > 0) {
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
                } else {
                    echo '<a href="#" class="jam row" style="cursor: default;">
                        <div class="content-source">
                            <img src="" class="img-fluid" alt="">
                        </div>
                        <div class="jam-title row">
                            <p style="margin-left: 225px; margin-top: 130px">Нет мероприятий</p>
                        </div>
                    </a>';
                }

                ?>

                <!-- <div class="content">
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
                </div> -->
                <?php
                require 'php/connect.php';
                $posts = getPosts(30);

                for ($i = 0; $i < count($posts); $i++) {
                    $user_id = $posts[$i]['user_id'];
                    if ($user_id == $_COOKIE['user']) {
                        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'"));
                        $user_photo_id = $user['photo_id'];
                        $user_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$user_photo_id'"));

                        $photo_id = $posts[$i]['photo_id'];
                        $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$photo_id'"));
                        echo '<div class="content">
                    <div class="content-icon">
                        <img src="' . $user_photo['link_photo'] . '" alt="" height="50px">
                    </div>
                    <div class="wrap_jam">
                        <div class="content-headder">
                            <div class="content-headder-title">
                                <p>' . $user['first_name'] . ' ' . $user['last_name'] . '</p>
                                <p class="title-info">@' . $user['user_login'] . ' • ' . $posts[$i]['date_create'] . ' мин</p>
                            </div>
                            <div class="content-discription">
                                <p>' . $posts[$i]['post_text'] . '</p>
                            </div>
                        </div>';
                        if ($photo_id) {
                            echo '<div class="content-source_n">
                                    <img src="' . $photo['link_photo'] . '" class="img-fluid" alt="">
                                </div>';
                        }
                        echo '<div class="content-bottom-panel">
                            <div class="content-bottom-panel-comments">
                                <img src="img/comments.svg" alt="">
                                <p>0</p>
                            </div>
                            <div class="content-bottom-panel-reposts">
                                <img src="img/reposts.svg" alt="">
                                <p>' . $posts[$i]['amount_reposts'] . '</p>
                            </div>
                            <div class="content-bottom-panel-likes">
                                <a href="">
                                    <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.5 15L8.2 14.7475C1.75 9.44444 0 7.57576 0 4.54545C0 2.0202 2 0 4.5 0C6.55 0 7.7 1.16162 8.5 2.07071C9.3 1.16162 10.45 0 12.5 0C15 0 17 2.0202 17 4.54545C17 7.57576 15.25 9.44444 8.8 14.7475L8.5 15ZM4.5 1.0101C2.55 1.0101 1 2.57576 1 4.54545C1 7.12121 2.6 8.83838 8.5 13.6869C14.4 8.83838 16 7.12121 16 4.54545C16 2.57576 14.45 1.0101 12.5 1.0101C10.75 1.0101 9.8 2.07071 9.05 2.92929L8.5 3.58586L7.95 2.92929C7.2 2.07071 6.25 1.0101 4.5 1.0101Z" fill="#C1C1C1"/>
                                    </svg>
                                </a>
                                <p>' . $posts[$i]['amount_likes'] . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
                    }
                }

                $conn->close();
                ?>
            </div>
        </div>

    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>