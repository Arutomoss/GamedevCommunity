<?php

if (isset($_POST['user_id']) && ($_POST['user_id'] != '')) {

    $user_id = $_POST['user_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $user = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `users` WHERE `user_id` = '$user_id'")) or die("ERROR: " . mysqli_error($conn));

    echo json_encode($user);
}