<?php

if (isset($_POST['user_id']) && ($_POST['user_id'] != '')
 && isset($_POST['post_id']) && ($_POST['post_id'] != '')
 && isset($_POST['comment_text']) && ($_POST['comment_text'] != '')) {

    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $comment_text = nl2br(filter_var(trim($_POST['comment_text']), FILTER_SANITIZE_STRING));

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    $result = mysqli_query($mysql, "INSERT INTO `comments`(`post_id`, `user_id`, `comment_text`) VALUE('$post_id', '$user_id', '$comment_text') ");

    if ($result){
        exit('success');
    }
    else exit('fail');

    $mysql->close();
}

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }

    return $array;
}
