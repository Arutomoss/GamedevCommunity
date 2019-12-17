<link rel="stylesheet" href="css/style-header.css">

<header class="d-flex flex-column justify-content-center">
    <div class="h_container">
        <!-- <div class="logo"></div> -->
        <nav>
            <a href="../news.php">
                Новости
                <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="2" cy="2" r="2" fill="white" />
                </svg>
            </a>
            <a href="../messages.php">Сообщения</a>
            <a href="../jams.php">Мероприятия</a>
        </nav>
        <div class="user">
            <div class="user-name">
                <?php 
                echo $_COOKIE['first_name'] . ' ' . $_COOKIE['last_name'];
                ?>
            </div>
            <div class="user-photo">
                <?php 
                require 'php/connect.php';
                $result = mysqli_query($conn, "SELECT photo.link_photo FROM photo INNER JOIN users on photo.photo_id = users.photo_id WHERE photo.photo_id = users.photo_id");
                $row = mysqli_fetch_assoc($result);
                $conn->close();
                ?>
                <img src="<?php echo $row['link_photo']; ?>" alt="" height="35px" class="rounded-circle">
            </div>
        </div>
    </div>
</header>