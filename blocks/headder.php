<link rel="stylesheet" href="/css/style-header.css">

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
                    require 'php/connect.php';

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