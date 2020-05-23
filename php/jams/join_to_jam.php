<?php

require '../connect.php';

$event_id = $_POST['event_id'];
$follower = $_COOKIE['user'];

if (isset($_POST['join'])) {
    if ($_POST['join'] == 'join') {
        mysqli_query($conn, "INSERT INTO `event_members`(`event_id`, `user_id`) VALUE ('$event_id', '$follower')");

        $conn->close();

        echo 'joined';
    } else if ($_POST['join'] == 'disconnect') {
        mysqli_query($conn, "DELETE FROM `event_members` WHERE (`event_id` = '$event_id') AND (`user_id` = '$follower')");

        $conn->close();

        echo 'diconnected';
    }
}
