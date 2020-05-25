<?php

if ($_POST['event_id'] != ""){
    $event_id = $_POST['event_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");
    
    $result = mysqli_query($mysql, "SELECT * FROM `events` WHERE `event_id` = '$event_id'");
    $mysql->close();
    
    $event = resultToArray($result);

    if ($event[0]['event_date_end_vote'] == null){
        exit('4');
    }
    if ($event[0]['event_date_start'] > date('Y-m-d\TH:i', strtotime('now')))
    {
        exit('0');
    }
    else if ($event[0]['event_date_start'] < date('Y-m-d\TH:i', strtotime('now')) &&
            $event[0]['event_date_end_vote'] > date('Y-m-d\TH:i', strtotime('now')))
    {
        exit('1');
    }
    else if ($event[0]['event_date_end_vote'] < date('Y-m-d\TH:i', strtotime('now')) &&
            $event[0]['event_date_end'] > date('Y-m-d\TH:i', strtotime('now')))
    {
        exit('2');
    }
    else if ($event[0]['event_date_end_vote'] < date('Y-m-d\TH:i', strtotime('now')))
    {
        exit('3');
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
