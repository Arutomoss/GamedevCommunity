<?php

require '/events.php';
require '/connect.php';

if (isset($_POST['search']) && ($_POST['search'] != '')) {
    $users = searchUsers($_POST['search']);
    $user_id = $_COOKIE['user'];

    echo $users;

    // for ($i = 0; $i < count($users); $i++) {
    //     $cur_user_id = $users[$i]['user_id'];

    //     if ($cur_user_id != $user_id) {
    //         $cur_photo_id = $users[$i]['photo_id'];
    //         $cur_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$cur_photo_id'")) or die("ERROR: " . mysqli_error($conn));
    //         echo '<div class="search-result">
    //                 <a href="mypage.php?user_id=' . $cur_user_id . '">
    //                     <img src="' . $cur_photo['link_photo'] . '" alt="">
    //                 </a>
    //             <div>
    //             <div class="actual-panel-item-jam">
    //                 <p><a href="mypage.php?user_id=' . $cur_user_id . '">' . $users[$i]['first_name'] . ' ' . $users[$i]['last_name'] . '</a></p>
    //             </div>
    //             <div class="actual-panel-item-discription">
    //                 <p>' . $users[$i]['short_description'] . '</p>
    //             </div>
    //         </div>
    //     </div>';
    //     }
    // }

    $conn->close();
}
