<?php

if (isset($_POST['user_id']) && ($_POST['user_id'] != '')
 && isset($_POST['post_id']) && ($_POST['post_id'] != '')) {

    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];

    $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

    // echo $post_id;
    // echo ' - '.$user_id.' - ';

    $result = mysqli_query($mysql, "SELECT `like_id` FROM `likes` WHERE `user_id` = '$user_id' AND `post_id` = '$post_id'");
    
    if (empty(resultToArray($result))){
        $add_like = mysqli_query($mysql, "INSERT INTO `likes`(`post_id`, `user_id`) VALUE('$post_id', '$user_id')");

        if ($add_like){
            $update_amount = mysqli_query($mysql, "UPDATE `posts` SET `amount_likes` = `amount_likes` + 1 WHERE `post_id` = '$post_id'");
            
            if($update_amount){
                echo '1';
            }
        }
        else {
            echo '2';
        }
    }
    else {
        $remove_like = mysqli_query($mysql, "DELETE FROM `likes` WHERE `user_id` = '$user_id' AND `post_id` = '$post_id'");
        
        if ($remove_like){

            $update_amount = mysqli_query($mysql, "UPDATE `posts` SET `amount_likes` = `amount_likes` - 1 WHERE `post_id` = '$post_id'");
            
            if ($update_amount){
                echo '3';
            }
        }
        else {
            echo '4';
        }
    }

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
