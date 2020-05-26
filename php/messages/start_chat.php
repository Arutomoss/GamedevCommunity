<?php

if ($_POST['user_id'] != ""){

    $user_id_1 = $_COOKIE['user'];
    $user_id_2 = $_POST['user_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $check = mysqli_query($mysql, "SELECT * FROM `chats` WHERE ((`user_id_1` = '$user_id_1') AND (`user_id_2` = '$user_id_2')) OR ((`user_id_1` = '$user_id_2') AND (`user_id_2` = '$user_id_1'))");

    $is_in_chat = resultToArray($check);

    // echo $is_in_chat;
    // echo ('---'.empty($is_in_chat));

    if (empty($is_in_chat)){
        $result = mysqli_query($mysql, "INSERT INTO `chats`(`user_id_1`, `user_id_2`) VALUE ('$user_id_1', '$user_id_2')");
        $mysql->close();
        
        if($result){
            // echo 'Чат успешно содан!';
            echo '1';
        }
        else{
            // echo 'Ошибка';
            echo '2';
        }
    }
    else {
        // echo 'Чат уже создан';
        echo '0';
    }    
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
