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
    <!-- <link rel="stylesheet" href="/css/style-create_game.css"> -->
    <link rel="stylesheet" href="/css/style-game.css">
    <link rel="stylesheet" href="/css/style-header.css">
    <title>Crete Game</title>
</head>

<?php
    $conn = mysqli_connect("localhost", "root", "root", "gamedc");

    $game_id = $_GET['game_id'];
    $result = mysqli_query($conn, "SELECT * FROM `games` WHERE game_id = '$game_id'");
    $game = mysqli_fetch_assoc($result);

    // $user_id = $game['user_id'];
    // $user_res = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'");
    // $user = mysqli_fetch_assoc($user_res);

    $photo_id = $game['photo_id'];
    $photo_res = mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE photo_id = '$photo_id'");
    $photo = mysqli_fetch_assoc($photo_res);

    // $user_photo_id = $user['photo_id'];
    // $user_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$user_photo_id'"));

    // $joined_user_id = $_COOKIE['user'];
    // $isJoin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `user_id` FROM `event_members` WHERE (`user_id` = '$joined_user_id') AND (`event_id` = '$event_id')"));

    // $follower = $_COOKIE['user'];

    // $amount_members = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(`user_id`) as amount FROM `event_members` WHERE `event_id` = '$event_id'"));

    $conn->close();
?>

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
            <a href="/jams.php">
                Мероприятия
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
            <div class="col-11 game-place">
                <div class="row game-header justify-content-between">
                    <img src="<?php echo $photo['link_photo']; ?>" alt="" class="main-img" width="100%">
                </div>
                <div class="col game">
                    <form action="save_file.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-7 plr-0">
                                <h2><?php echo $game['game_name']; ?></h2>
                                <p class="short-description"><?php echo $game['game_short_description']; ?></p>
                                <p class="description"><?php echo $game['game_description']; ?></p>

                                <div>
                                    <button class="download">Скачать игру</button>
                                    <p><?php echo $game['game_file_name'].' '; echo $game['game_size'].' Mb'; ?></p>
                                </div>

                            </div>

                            <div class="col plr-0">
                                <iframe width="407" height="228" src="<?php echo ' https://www.youtube.com/embed/'.$game['youtube_link']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <video tabindex="-1" class="video-stream html5-main-video" controlslist="nodownload" src="https://www.youtube.com/watch?v=GK26CGvjbkY"></video>
                                <!-- <img src="/img/1.jpg" alt="" width="400px" class="screenshot">
                                <img src="/img/1.jpg" alt="" width="400px" class="screenshot">
                                <img src="/img/1.jpg" alt="" width="400px" class="screenshot"> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>