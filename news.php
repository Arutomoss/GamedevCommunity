<?php
if ($_COOKIE['user'] == '') {
    header('Location: http://gamedevcommunity/sign_in.php ');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,400i,500,500i,700,900&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-news.css">
    <title>Новости</title>
</head>

<body onload="init();">
    <?php
    require 'blocks/headder.php';
    ?>

    <?php
    require 'php/connect.php';

    $user_id = $_COOKIE['user'];
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'"));

    $photo_id = $user['photo_id'];
    $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$photo_id'"));

    $conn->close();
    ?>

    <script type="text/javascript">
        var observe;
        if (window.attachEvent) {
            observe = function(element, event, handler) {
                element.attachEvent('on' + event, handler);
            };
        } else {
            observe = function(element, event, handler) {
                element.addEventListener(event, handler, false);
            };
        }

        function init() {
            var text = document.getElementById('post_text');

            function resize() {
                text.style.height = 'auto';
                text.style.height = text.scrollHeight + 'px';
            }
            /* 0-timeout to get the already changed text */
            function delayedResize() {
                window.setTimeout(resize, 0);
            }
            observe(text, 'change', resize);
            observe(text, 'cut', delayedResize);
            observe(text, 'paste', delayedResize);
            observe(text, 'drop', delayedResize);
            observe(text, 'keydown', delayedResize);

            text.focus();
            text.select();
            resize();
        }
    </script>

    <div class="m_container">
        <div class="main">
            <form action="php/add_post.php" method="POST" enctype="multipart/form-data">
                <div class="whats_new">
                    <div class="mini-icon">
                        <img src="<?php echo $photo['link_photo']; ?>" alt="">
                    </div>
                    <a href="">
                        <input type="file" class="border-0 form-control-file" id="choose-photo" style="display: none;" name="photo" accept="image/*,image/jpeg">
                        <div><label for="choose-photo"><img src="img/img_icon.svg" class="img-icon" alt=""></label></div>
                    </a>
                    <svg width="2" height="28" viewBox="0 0 2 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L1 27" stroke="#4A4A4A" stroke-linecap="round" />
                    </svg>

                    <!-- <input type="text" placeholder="Что нового?" style="color: #eeeeee;"> -->
                    <div>
                        <textarea rows="1" style="height:1em; color: #eeeeee;" id="post_text" name="post_text" placeholder="Что нового?" maxlength="400"></textarea>
                        <div class='preview-img'>
                            <img src="" alt="" id="img-source" style="width: 100%;">
                        </div>
                    </div>

                    <button type="submit"><img src="img/send.svg" class="send" alt=""></button>

                </div>
            </form>

            <?php
            require 'php/events.php';
            require 'php/connect.php';
            $posts = getPosts(30);

            for ($i = 0; $i < count($posts); $i++) {
                $user_id = $posts[$i]['user_id'];
                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'"));
                $user_photo_id = $user['photo_id'];
                $user_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$user_photo_id'"));

                $photo_id = $posts[$i]['photo_id'];
                $photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$photo_id'"));
                echo '<div class="content">
                    <div class="content-icon">
                        <img src="' . $user_photo['link_photo'] . '" alt="" height="50px">
                    </div>
                    <div class="wrap">
                        <div class="content-headder">
                            <div class="content-headder-title">
                                <p>' . $user['first_name'] . ' ' . $user['last_name'] . '</p>
                                <p class="title-info">@' . $user['user_login'] . ' • ' . $posts[$i]['date_create'] . ' мин</p>
                            </div>
                            <div class="content-discription">
                                <p>' . $posts[$i]['post_text'] . '</p>
                            </div>
                        </div>';
                        if ($photo_id){
                            echo '<div class="content-source">
                                    <img src="' . $photo['link_photo'] . '" class="img-fluid" alt="">
                                </div>';
                        }
                        echo '<div class="content-bottom-panel">
                            <div class="content-bottom-panel-comments">
                                <img src="img/comments.svg" alt="">
                                <p>0</p>
                            </div>
                            <div class="content-bottom-panel-reposts">
                                <img src="img/reposts.svg" alt="">
                                <p>' . $posts[$i]['amount_reposts'] . '</p>
                            </div>
                            <div class="content-bottom-panel-likes">
                                <img src="img/likes.svg" alt="">
                                <p>' . $posts[$i]['amount_likes'] . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            $conn->close();
            ?>

        </div>

        <div class="actual">
            <div class="actual-panel">
                <div class="actual-panel-title">
                    <p>Рекомендации</p>
                </div>
                <div class="actual-panel-content">
                    <?php
                    require 'php/connect.php';

                    $users = getUsers(4);
                    $user_id = $_COOKIE['user'];

                    for ($i = 0; $i < count($users); $i++) {
                        $cur_user_id = $users[$i]['user_id'];

                        if ($cur_user_id != $user_id) {
                            $cur_photo_id = $users[$i]['photo_id'];
                            $cur_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `link_photo` FROM `photo` WHERE `photo_id` = '$cur_photo_id'")) or die("ERROR: " . mysqli_error($conn));
                            echo '<div class="actual-panel-item">
                                    <a href="mypage.php?user_id=' . $cur_user_id . '">
                                        <img src="' . $cur_photo['link_photo'] . '" alt="">
                                    </a>
                                        <div>
                                            <div class="actual-panel-item-jam">
                                                <p><a href="mypage.php?user_id=' . $cur_user_id . '">' . $users[$i]['first_name'] . ' ' . $users[$i]['last_name'] . '</a></p>
                                            </div>
                                            <div class="actual-panel-item-discription">
                                                <p>' . $users[$i]['short_description'] . '</p>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }

                    $conn->close();
                    ?>
                    <!-- <div class="actual-panel-item">
                        <img src="img/logo_light.svg" alt="">
                        <div>
                            <div class="actual-panel-item-jam">
                                <p>August JAM</p>
                            </div>
                            <div class="actual-panel-item-discription">
                                <p>Краткое описание мероприятия</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-source').attr('src', e.target.result);
                    $('.preview-img').css('display', 'inherit');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#choose-photo").change(function() {
            readURL(this);
        });
    </script>



    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>