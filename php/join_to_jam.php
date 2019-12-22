<?php
require 'php/connect.php';

$user_photo_id = $user['photo_id'];
$user_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$user_photo_id'"));

$isFollow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT follower_id FROM subscriptions WHERE (user_id = '$user_id')"));

$conn->close();
