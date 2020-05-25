<?php

if (isset($_POST['search'])) {
    $search_text = $_POST['search'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `games` WHERE (`game_name` LIKE '%$search_text%')");
    $mysql->close();

    if ($result)
        echo json_encode(resultToArray($result));
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
