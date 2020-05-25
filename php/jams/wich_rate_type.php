<?php

if ($_POST['event_id'] != "" && $_POST['user_id'] != "" && $_POST['game_id'] != "") {
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];
    $game_id = $_POST['game_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT `event_vote_type` FROM `events` WHERE `event_id` = '$event_id'");
    $mysql->close();

    $event = resultToArray($result);

    if ($event[0]['event_vote_type'] == 'who_in_jam') {
        $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

        $in_jam = mysqli_query($mysql, "SELECT `user_id` FROM `event_members` WHERE (`event_id` = '$event_id') AND (`user_id` = '$user_id')");

        $mysql->close();

        $in_jam_ = resultToArray($in_jam);

        if (count(($in_jam_)) == 1)
        {
            exit('who_in_jam');
        }
        else exit('who_not_in_jam');
    }
    else if ($event[0]['event_vote_type'] == 'who_upload_game') {
        $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

        $uploaded_game = mysqli_query($mysql, "SELECT `user_id` FROM `games` WHERE (`event_id` = '$event_id') AND (`user_id` = '$user_id') AND (`game_id` = '$game_id')");

        $uploaded_game_ = resultToArray($uploaded_game);

        $mysql->close();
        if (count(($uploaded_game_)) == 1)
        {
            exit('who_upload_game');
        }
        else exit('who_not_upload_game');
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
