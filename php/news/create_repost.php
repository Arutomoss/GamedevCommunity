<?php

if (
    isset($_POST['cur_user_id']) && ($_POST['cur_user_id'] != '')
    && isset($_POST['post_id']) && ($_POST['post_id'] != '')
) {

    $cur_user_id = $_POST['cur_user_id'];
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    if ($cur_user_id != $user_id) {
        $mysql = mysqli_connect("localhost", "root", "root", "gamedc");

        $is_repost = mysqli_query($mysql, "SELECT * FROM `reposts` WHERE `post_id` = '$post_id' AND `user_id` = '$cur_user_id'");

        if (empty(resultToArray($is_repost))) {
            $result = mysqli_query($mysql, "INSERT INTO `reposts`(`post_id`, `user_id`) VALUE('$post_id', '$cur_user_id')");

            if ($result) {
                $update_amount = mysqli_query($mysql, "UPDATE `posts` SET `amount_reposts` = `amount_reposts` + 1 WHERE `post_id` = '$post_id'");

                if ($update_amount) {
                    exit('success');
                }
            } else {
                exit('fail');
            }
        }
        else {
            $remove_like = mysqli_query($mysql, "DELETE FROM `reposts` WHERE `user_id` = '$cur_user_id' AND `post_id` = '$post_id'");
            
            if ($remove_like){
    
                $update_amount = mysqli_query($mysql, "UPDATE `posts` SET `amount_reposts` = `amount_reposts` - 1 WHERE `post_id` = '$post_id'");
                
                if ($update_amount){
                    exit('success-remove');
                }
            }
            else {
                exit('fail');
            }
        }

        $mysql->close();
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
