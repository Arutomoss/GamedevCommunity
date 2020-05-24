<?php

if (isset($_POST['user_id']) && isset($_POST['event_id'])){
    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];
    $game_name = $_POST['game_name'];

    $result = mysqli_query($mysql, "SELECT * FROM `games` WHERE `user_id` = '$user_id' ORDER BY `game_id` DESC");

    $all_games = resultToArray($result);

    for ($i = 0; $i < count($all_games); $i++){
        if ($all_games[$i]['game_name'] == $game_name){
            if ($all_games[$i]['event_id'] == $event_id){
                echo 'Эта игра уже представлена в этом Jam-е';
            }
            else {
                mysqli_query($mysql, "UPDATE `games` SET `event_id` = '$event_id' WHERE `game_name` = '$game_name'");
                echo 'Игра успешно добавлена';
            }            
        }
    }

    $mysql->close();
    // echo json_encode($all_games);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
