<?php

require '../connect.php';

$event_id = $_POST['event_id'];
$user_id = $_COOKIE['user'];
$isJoin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `user_id` FROM `event_members` WHERE (`user_id` = '$user_id') AND (`event_id` = '$event_id')"));

$conn->close();

echo json_encode(count($isJoin));