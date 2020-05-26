<?php

if ($_POST['user_id'] != ""){
    $user_id = $_POST['user_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");
    
    $result = mysqli_query($mysql, "SELECT * FROM `chats` INNER JOIN `users` on `chats`.`user_id_2` = `users`.`user_id` WHERE (`chats`.`user_id_1` = '$user_id') OR (`chats`.`user_id_2` = '$user_id')");
    $mysql->close();
    
    $chats = resultToArray($result);
    
    echo json_encode($chats);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
