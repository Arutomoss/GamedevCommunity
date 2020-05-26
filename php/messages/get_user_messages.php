<?php

if ($_POST['chat_id'] != ""){
    $chat_id = $_POST['chat_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");
    
    $result = mysqli_query($mysql, "SELECT * FROM `messages` WHERE `chat_id` = '$chat_id'");
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
