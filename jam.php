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

<body>
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

    $joined_user_id = $_COOKIE['user'];
    $isJoin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `user_id` FROM `event_members` WHERE (`user_id` = '$joined_user_id') AND (`event_id` = '$event_id')"));

    $follower = $_COOKIE['user'];

    $amount_members = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(`user_id`) as amount FROM `event_members` WHERE `event_id` = '$event_id'"));

    $conn->close();
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 jam-place">
                <div class="col jam">
                    <div class="row jam-header justify-content-between">
                        <div class="form-group col" style="padding-left: 0px; margin-bottom: 10px">
                            <h2><?php echo $event['event_name']; ?></h2>
                        </div>
                        <div class="name">
                            <?php
                            echo '<a href="mypage.php?user_id=' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</a>';
                            echo '<img src="' . $user_photo['link_photo'] . '" alt="" height="40px" class="rounded-circle" style="margin-left: 10px;">';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="short-description col-12">
                            <p><?php echo $event['event_short_description']; ?></p>
                        </div>
                    </div>
                    <p style="color: #EEEEEE; font-family: Montserrat;">Количество участников: <?php echo $amount_members['amount']; ?></p>
                    <div class="dates row justify-content-center justify-content-between">
                        <div class="col-5 date">
                            <label for="inputDate">Дата начала: <?php echo substr($event['event_date_start'], 0, 10); ?></label>
                        </div>
                        <div class="col-5 date">
                            <label for="inputDate">Дата окончания: <?php echo substr($event['event_date_end'], 0, 10); ?></label>
                        </div>
                    </div>
                    <div class='preview-img'>
                        <img src="<?php echo $photo['link_photo'] ?>" alt="" id="img-source" style="width: 100%;">
                    </div>
                    <?php
                    if (isset($_POST['join'])) {
                        require 'php/connect.php';
                        mysqli_query($conn, "INSERT INTO `event_members`(`event_id`, `user_id`) VALUE ('$event_id', '$follower')");
                        $conn->close();

                        echo "<script>(window.location.href='jam.php?event_id=$event_id')()</script>";
                    } else if (isset($_POST['disconnect'])) {
                        require 'php/connect.php';
                        mysqli_query($conn, "DELETE FROM `event_members` WHERE (`event_id` = '$event_id') AND (`user_id` = '$follower')");
                        $conn->close();

                        echo "<script>(window.location.href='jam.php?event_id=$event_id')()</script>";
                    }
                    ?>
                    <form method="POST">
                        <?php
                        if (count($isJoin) == 0) {
                            echo '
                                <div class="row justify-content-center btn-submit">
                                    <input type="submit" name="join" class="btn btn-success pd-lr-30" value="Присоединиться">
                                </div>';
                        } else {
                            echo '
                                <div class="row justify-content-center btn-submit">
                                    <input type="submit" name="disconnect" class="btn btn-danger pd-lr-30" value="Отменить участие">
                                </div>';
                        }
                        ?>
                    </form>
                    <div class="row">
                        <div class="col-12 jam-description">
                            <p><?php echo $event['event_description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>