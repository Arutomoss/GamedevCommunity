<?php

if (($_POST['event_id'] != "") && ($_POST['game_id'] != "") && ($_POST['user_id'] != "") && ($_POST['mark'] != "")) {
    $event_id = $_POST['event_id'];
    $game_id = $_POST['game_id'];
    $user_id = $_POST['user_id'];
    $mark = $_POST['mark'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $is_rated = $_POST['is_rated'];

    if ($is_rated == 0) {
        $result = mysqli_query($mysql, "INSERT INTO `rating`(event_id, game_id, user_id, mark) VALUE('$event_id', '$game_id', '$user_id', '$mark')");
        $mysql->close();

        echo 'Ваш голос засчитан!';
    }
    else {
        $result = mysqli_query($mysql, "UPDATE `rating` SET `event_id` = '$event_id', `game_id` = '$game_id', `user_id` = '$user_id', `mark` = '$mark' WHERE (event_id = '$event_id') and (game_id = '$game_id') and (user_id = '$user_id')");
        $mysql->close();

        echo 'Ваш голос изменен!';
    }
}
