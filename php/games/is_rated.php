<?php

$mysql = mysqli_connect("localhost", "root", "root", "gamedc");

$event_id = $_POST['event_id'];
$user_id = $_COOKIE['user'];
$game_id = $_POST['game_id'];

$isJoin = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT `rating_id` FROM `rating` WHERE (`user_id` = '$user_id') AND (`event_id` = '$event_id') AND (`game_id` = '$game_id')"));

$mysql->close();

echo json_encode(count($isJoin));
