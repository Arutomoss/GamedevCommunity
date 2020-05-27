<?php

if ($_POST['chat_id'] != ""){
    $chat_id = $_POST['chat_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");
    
    $result = mysqli_query($mysql, "SELECT * FROM `chats` WHERE `chat_id` = '$chat_id'");
    $mysql->close();
    
    $chats = resultToArray($result);

    if ($chats['user_id_1'] != $_COOKIE['user']){
        echo $chats[0]['user_id_2'];
    }
    
    // echo json_encode($chats);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
