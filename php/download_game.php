<?php

if (isset($_POST['game_id'])) {

    $limit = 20;

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `games` ");
    $mysql->close();

    $all_games = resultToArray($result);

    file_force_download($all_games['game_file_name']);
}

function file_force_download($file)
{
    if (file_exists($file)) {
        header('X-SendFile: ' . realpath($file));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        exit;
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
