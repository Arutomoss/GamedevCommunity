<?php

function getJams($limit)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `events` ORDER BY `event_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}

function getUserJams($limit, $user_id)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `events` WHERE `user_id` = '$user_id' ORDER BY `event_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false){
        $array[] = $row;
    }

    return $array;
}

function getPhotos($limit)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `photo` ORDER BY `photo_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}