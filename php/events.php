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

function getActiveJams($limit)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `events` WHERE `event_date_end` > NOW() ORDER BY `event_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}

function getActiveUserJams($limit, $user_id)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `events` INNER JOIN `event_members` on `events`.`event_id` = `event_members`.`event_id` WHERE (`events`.`event_date_end` > NOW()) AND (`events`.`user_id` = '$user_id') AND (`event_members`.`user_id` = '$user_id') ORDER BY `events`.`event_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}

function getPosts($limit)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `posts` ORDER BY `post_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}

function getUserPosts($limit, $user_id)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `posts` WHERE `user_id` = $user_id ORDER BY `post_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}

function getFollowerPosts($limit, $user_id)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `posts` INNER JOIN `subscriptions` on `posts`.`user_id` = `subscriptions`.`user_id` WHERE (`subscriptions`.`follower_id` = '$user_id') OR (posts.user_id = '$user_id') GROUP BY `posts`.`post_id` ORDER BY `posts`.`post_id` DESC LIMIT $limit");

    $mysql->close();
    return resultToArray($result);
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
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

function getUsers($limit)
{
    $mysql = mysqli_connect("localhost", "root", "", "gamedc");

    $result = mysqli_query($mysql, "SELECT * FROM `users` ORDER BY `user_id` DESC LIMIT $limit");
    $mysql->close();
    return resultToArray($result);
}

function getMonth($month){
    switch($month){
        case '01':
            return 'янв.';
        break;
        case '02':
            return 'фев.';
        break;
        case '03':
            return 'марта';
        break;
        case '04':
            return 'апр.';
        break;
        case '05':
            return 'мая';
        break;
        case '06':
            return 'июн.';
        break;
        case '07':
            return 'июл.';
        break;
        case '08':
            return 'авг.';
        break;
        case '09':
            return 'сен.';
        break;
        case '10':
            return 'окт.';
        break;
        case '11':
            return 'ноя.';
        break;
        case '12':
            return 'дек.';
        break;
    }
}