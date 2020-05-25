<?php

// echo $_POST['sort'];

if ($_POST['sort'] == 'date_new') {
    getNewestGames();
}
if ($_POST['sort'] == 'date_old') {
    getOldesttGames();
}
if ($_POST['genre'] == 'genre' && $_POST['sort'] != 'no_genre') {
    getSortedGamesByGenre($_POST['sort']);
}
if ($_POST['genre'] == 'genre' && $_POST['sort'] == 'no_genre') {
    getNewestGames();
}
// else getNewestGames();

function getNewestGames()
{
    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `games` ORDER BY `game_id` DESC");
    $mysql->close();

    $all_games = resultToArray($result);

    echo json_encode($all_games);
}

function getOldesttGames()
{
    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `games` ORDER BY `game_id`");
    $mysql->close();

    $all_games = resultToArray($result);

    echo json_encode($all_games);
}

function getSortedGamesByGenre($genre)
{
    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `games` WHERE `game_genre` = '$genre' ORDER BY `game_id` DESC");
    $mysql->close();

    $all_games = resultToArray($result);

    if (!empty($all_games)) {
        echo json_encode($all_games);
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
