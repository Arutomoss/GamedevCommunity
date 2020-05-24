<?php

if ($_POST['event_id'] != ""){
    $event_id = $_POST['event_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");
    
    $result = mysqli_query($mysql, "SELECT * FROM `games` WHERE `games`.`event_id` = '$event_id'");
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
