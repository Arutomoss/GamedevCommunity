<?php

if ($_POST['user_id'] != "") {
    $user_id = $_POST['user_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $all_chats_sql = mysqli_query($mysql, "SELECT * FROM `chats` WHERE (`chats`.`user_id_1` = '$user_id') OR (`chats`.`user_id_2` = '$user_id')");

    $all_chats = resultToArray($all_chats_sql);

    $mysql->close();

    echo json_encode($all_chats);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
