<?php

if (isset($_POST['post_id']) && ($_POST['post_id'] != '')) {

    $post_id = $_POST['post_id'];
    $limit = $_POST['limit'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    if ($limit == '0') {
        $result = mysqli_query($mysql, "SELECT * FROM `comments` WHERE `post_id` = '$post_id' ORDER BY `comment_id` DESC ");

        echo json_encode(resultToArray($result));
    } else {
        $result = mysqli_query($mysql, "SELECT * FROM `comments` WHERE `post_id` = '$post_id' ORDER BY `comment_id` DESC LIMIT $limit");

        echo json_encode(resultToArray($result));
    }

    $mysql->close();
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
