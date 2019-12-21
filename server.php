<?php

$uploaddir = 'img/';

if (isset($_POST['photo'])) {
    $arr = [];
    $str  = str_random(8);
    if ($_POST['photo']) {
        $file = 'uploaded_photo_' . $str . '_min.png';
        $uploadfile = $uploaddir . $file;

        $img = str_replace('data:image/png;base64,', '', $_POST['photo']);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);

        $url = $uploadfile;
        file_put_contents($url, $fileData);

        $arr['status'] = 'success';
        $arr['path_mini'] = "http://gamedevcommunity/" . $uploadfile;
        $arr['file_mini'] = $file;

        //  Save in DB
        $conn = mysqli_connect("localhost", "root", "", "gamedc");

        $link_photo = $arr['path_mini'];
        mysqli_query($conn, "INSERT INTO `photo`(link_photo) VALUE ('$link_photo')");

        $photo_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `photo_id` FROM `photo` WHERE `link_photo` = '$link_photo'"));
        $ph_id = $photo_id['photo_id'];

        $user_id = $_COOKIE['user'];
        mysqli_query($conn, "UPDATE `users` SET `photo_id` = '$ph_id' WHERE `user_id` = '$user_id'");
        
        $short_description = $_POST['short_description'];
        mysqli_query($conn, "UPDATE `users` SET `short_description` = '$short_description' WHERE `user_id` = '$user_id'");
        
        $conn->close();
    }
} else {
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    $arr = array();
    //crop
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
        $arr['status'] = 'success';
        $arr['path_max'] = "http://gamedevcommunity/" . $uploadfile;
        $arr['file_max'] = $_FILES['file']['name'];
    } else {
        $arr['status'] = 'fail';
    }
}

function str_random($length)
{
    return substr(md5(microtime()), 0, $length);
}
header('Content-type: application/json');
echo json_encode($arr);
exit();
