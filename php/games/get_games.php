<?php

$mysql = mysqli_connect("localhost", "root", "root", "gamedc");

$result = mysqli_query($mysql, "SELECT * FROM `games` ORDER BY `game_id` DESC");
$mysql->close();

$all_games = resultToArray($result);

echo json_encode($all_games);


function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
