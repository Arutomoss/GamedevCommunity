<?php

if ($_POST['event_id'] != ""){
    $event_id = $_POST['event_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");
    
    $result = mysqli_query($mysql, "SELECT * FROM `events` WHERE `event_id` = '$event_id'");
    $mysql->close();
    
    $event = resultToArray($result);
    
    echo ($event[0]['event_name']);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
