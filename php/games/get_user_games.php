<?php

if (isset($_POST['user_id'])){
    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $user_id = $_POST['user_id'];
    // echo $user_id;

    $result = mysqli_query($mysql, "SELECT `game_name` FROM `games` WHERE `user_id` = '$user_id' ORDER BY `game_id` DESC");
    $mysql->close();
    
    $all_games = resultToArray($result);
    
    echo json_encode($all_games);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
