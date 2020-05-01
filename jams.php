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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-jams.css">
    <title>Jams</title>
</head>

<body>
    <?php require 'blocks/headder.php'; ?>

    <div class="container col-12">
        <div class="wrap row justify-content-md-center">
            <div class="jams-panel mr-3">
                <div class="row pd-lr-35">
                    <p class="panel-header">Мероприятия</p>
                </div>
                <div class="jams-panel-links row pd-lr-35">
                    <a href="jams.php?select=all" class="all">Все мероприятия
                        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2" cy="2" r="2" fill="white" />
                        </svg></a>
                    <a href="jams.php?select=my" class="my">Мои мероприятия
                        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2" cy="2" r="2" fill="white" />
                        </svg>
                    </a>
                    <a href="jams.php?select=active" class="active">Активные мероприятия
                        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2" cy="2" r="2" fill="white" />
                        </svg>
                    </a>
                </div>
                <div class="row btn-create">
                    <a class="btn btn-success rounded-10 pd-lr-30" role="button" href="jam_creation.php">Создать мероприятие</a>
                </div>
            </div>
            <div class="jam-place">
                <?php
                require 'php/events.php';
                require 'php/connect.php';

                if ($_GET['select'] == 'all') {
                }

                switch ($_GET['select']) {
                    case 'all':
                        $jams = getJams(50);
                        break;
                    case 'my':
                        $jams = getUserJams(50, $_COOKIE['user']);
                        break;
                    case 'active':
                        $jams = getActiveJams(50);
                        break;
                    default:
                        $jams = getActiveJams(50);
                }

                if (count($jams) > 0) {
                    for ($i = 0; $i < count($jams); $i++) {
                        $event_id = $jams[$i]['event_id'];
                        $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` INNER JOIN `events` on `events`.`photo_id` = `photo`.`photo_id` WHERE `events`.`event_id` = '$event_id'"));
                        echo '<a href="jam.php?event_id=' . $jams[$i]['event_id'] . '" class="jam row ml-1">
                    <div class="content-source">
                      <!--  <p style="visibility: hidden;" id="event_id">' . $jams[$i]['event_id'] . '</p> -->
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
                    echo '<div class="jam_select row">
                        <div class="jam-title_select row">
                            <p>У вас нет мероприятий</p>
                        </div>
                    </div>';
                }



                $conn->close();
                ?>


            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>