<?php

if (isset($_POST['id']) && ($_POST['id'] != '')) {

    $cur_photo_id = $_POST['id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $cur_photo = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$cur_photo_id'")) or die("ERROR: " . mysqli_error($conn));

    echo strval($cur_photo['link_photo']);
}