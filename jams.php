<?php
if ($_COOKIE['user'] == '') {
    header('Location: http://gamedevcommunity/ ');
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
                <div class="row" style="padding-left: 35px; padding-right: 35px;">
                    <p class="panel-header">Мероприятия</p>
                </div>
                <div class="jams-panel-links row" style="padding-left: 35px; padding-right: 35px;">
                    <a href="#">Все мероприятия</a>
                    <a href="#">Мои мероприятия</a>
                    <a href="#">Активные мероприятия</a>
                </div>
                <div class="row" style="padding-left: 35px; padding-right: 35px; margin-bottom: 25px;">
                    <a class="btn btn-danger rounded-25 pd-w-35" role="button" href="jam_creation.php">Создать мероприятие</a>
                </div>
            </div>
            <div class="jam-place">
                <?php
                require 'php/events.php';
                $jams = getJams(10);
                $photos = getPhotos(10);

                for ($i = 0; $i < count($jams); $i++) {
                    echo '<div class="jam row ml-1" style="background-image: url(' . $photos[$i]['link_photo'] . ');">
                            <div class="jam-title row">
                                <p>' . $jams[$i]['event_name'] . '</p>
                            </div>
                            <div class="jam-description row align-self-end justify-content-between">
                                <div class="short-description align-self-center">
                                    <p>' . $jams[$i]['event_short_description'] . '</p>
                                </div>
                                <div class="row" style="margin-right: 30px;">
                                    <div class="jam-date-start date-style align-self-center">
                                        <p>' . $jams[$i]['event_date_start'] . '</p>
                                    </div>
                                    <div class="jam-date-end date-style align-self-center">
                                        <p>' . $jams[$i]['event_date_end'] . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->