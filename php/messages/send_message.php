<?php

if ($_POST['user_id'] != "" && $_POST['message_text'] != "" && $_POST['chat_id'] != ""){
    $user_id_1 = $_COOKIE['user'];
    $user_id_2 = $_POST['user_id'];
    $message_text = $_POST['message_text'];
    $chat_id = $_POST['chat_id'];

    // echo 'user_id 1 = '.$user_id_1;
    // echo 'user_id 2 = '.$user_id_2;
    // echo 'text = '.$message_text;
    // echo 'chat = '.$chat_id;

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");
    
    $result = mysqli_query($mysql, "INSERT INTO `messages`(`user_id_1`, `user_id_2`, `message_text`, `chat_id`) VALUE ('$user_id_1', '$user_id_2', '$message_text', '$chat_id')");
    $mysql->close();

    // $message = resultToArray($result);
    
    // echo json_encode($message);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
