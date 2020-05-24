<?php

if ($_POST['game_id'] != "") {
    $game_id = $_POST['game_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `games` WHERE `game_id` = '$game_id'");
    $mysql->close();

    $game = resultToArray($result);

    echo json_encode($game);
}



function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
