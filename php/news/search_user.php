<?php

if (isset($_POST['search']) && ($_POST['search'] != '')) {
    $search_text = $_POST['search'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `users` WHERE (`first_name` LIKE '%$search_text%') 
            OR (`last_name` LIKE '%$search_text%') 
            OR (`user_login` LIKE '%$search_text%') LIMIT 5");
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
