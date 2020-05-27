<?php

if ($_POST['user_id'] != "") {
    $user_id = $_POST['user_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $all_chats_sql = mysqli_query($mysql, "SELECT * FROM `chats` WHERE (`chats`.`user_id_1` = '$user_id') OR (`chats`.`user_id_2` = '$user_id')");

    $all_chats = resultToArray($all_chats_sql);
    $chats = array();

    for ($i = 0; $i < count($all_chats); $i++) {
        // if ($user_id != $_COOKIE['user']) {
        //     $chat_id = $all_chats[$i]['chat_id'];
        //     $result = mysqli_query($mysql, "SELECT * FROM `users` INNER JOIN `chats` on `users`.`user_id` = `chats`.`user_id_1` WHERE (`chats`.`chat_id` = '$chat_id') AND ((`chats`.`user_id_1` = '$user_id') OR (`chats`.`user_id_2` = '$user_id'))");
        //     array_push($chats, resultToArray($result));
        // } else {
        $chat_id = $all_chats[$i]['chat_id'];

        $result = mysqli_query($mysql, "SELECT * FROM `users` WHERE (`user_id` = (SELECT user_id_1 FROM `chats` WHERE `chat_id` = '$chat_id') AND `user_id` != '$user_id') OR (`user_id` = (SELECT `user_id_2` FROM `chats` WHERE `chat_id` = '$chat_id') AND user_id != '$user_id')");
        
        while ($row = $result->fetch_object()){
            $chats[] = $row;
        }
    }

    $mysql->close();

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
