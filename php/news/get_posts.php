<?php

if (isset($_POST['user_id']) && ($_POST['user_id'] != '')) {
    $user_id = $_POST['user_id'];
    $limit = 20;

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `posts` WHERE `user_id` = $user_id ORDER BY `post_id` DESC LIMIT $limit");
    $mysql->close();

    $user_post = resultToArray($result);

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `posts` INNER JOIN `subscriptions` on `posts`.`user_id` = `subscriptions`.`user_id` WHERE (`subscriptions`.`follower_id` = $user_id) ORDER BY `posts`.`post_id` DESC LIMIT $limit");

    $mysql->close();

    $following_post = resultToArray($result);

    for ($i = 0; $i < count($following_post); $i++) {
        unset($following_post[$i]['subscription_id']);
        unset($following_post[$i]['follower_id']);
    }

    $all_users = array_merge($following_post, $user_post);

    usort($all_users, function ($a, $b) {
        return ($b['post_id'] - $a['post_id']);
    });

    echo json_encode($all_users);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
