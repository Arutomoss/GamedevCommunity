<?php
if ($_COOKIE['user'] == '') {
    header('Location: http://gamedevcommunity/sign_in.php ');
}
$cur = $_GET['user_id'];
$mysql = mysqli_connect("localhost", "root", "root", "gamedc");
$isExists = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `users` WHERE `user_id` = '$cur'"));
if (count($isExists) == 0) {
    header('Location: http://gamedevcommunity/mypage.php?user_id=' . $_COOKIE['user'] . ' ');
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
                        require 'php/events.php';

                        $result = mysqli_query($conn, "SELECT photo.link_photo FROM photo INNER JOIN users on photo.photo_id = users.photo_id WHERE photo.photo_id = users.photo_id");
                        $row = mysqli_fetch_assoc($result);

                        $user_id = $_GET['user_id'];
                        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'"));

                        $follower = $_COOKIE['user'];
                        $isFollow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `follower_id` FROM `subscriptions` WHERE (user_id = '$user_id') AND (`follower_id` = '$follower')"));

                        $amount_followers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(`follower_id`) as amount FROM `subscriptions` WHERE `user_id` = '$user_id'"));

                        $my_events = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(event_id) as amount FROM events WHERE user_id = '$user_id'"));

                        $photo_id = $user['photo_id'];
                        $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$photo_id'"));

                        $amount_active_jams = getAmountActiveUserJams($user_id);
                        
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

            <div class="jams">

                <?php
                require 'php/connect.php';
                $jams = getActiveUserJams(20, $user_id);

                if (count($jams) > 0) {
                    for ($i = 0; $i < count($jams); $i++) {
                        $event_id = $jams[$i]['event_id'];
                        $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE event_id = '$event_id'"));
                        if ($i == 0) {
                            echo '<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">';
                        } else {
                            echo '
                                    <div class="carousel-item ">';
                        }
                        echo '
                        <a href="jam.php?event_id=' . $jams[$i]['event_id'] . '" class="jam row">
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
                        </a>
                    </div>';
                    }
                    echo '</div>

                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>';
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

                <?php
                require 'php/connect.php';
                $posts = getUserPosts(30, $_GET['user_id']);

                for ($i = 0; $i < count($posts); $i++) {
                    $user_id = $posts[$i]['user_id'];

                    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'"));
                    $user_photo_id = $user['photo_id'];
                    $user_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$user_photo_id'"));

                    $month = substr($posts[$i]['date_create'], 5, 2);
                    $photo_id = $posts[$i]['photo_id'];
                    $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$photo_id'"));
                    echo '<div class="content">
                    <div class="content-icon">
                        <a href="mypage.php?user_id=' . $user_id . '">
                            <img src="' . $user_photo['link_photo'] . '" alt="" height="50px">
                        </a>
                    </div>
                    <div class="wrap_jam">
                        <div class="content-headder">
                            <div class="content-headder-title">
                            <a href="mypage.php?user_id=' . $user_id . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</a>
                                <p class="title-info">@' . $user['user_login'] . ' • ' . substr($posts[$i]['date_create'], 8, 2) . ' ' . getMonth($month) . '</p>
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