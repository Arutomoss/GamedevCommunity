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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro:400,400i,700,700i&display=swap&subset=cyrillic,greek,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-jam.css">
    <link rel="stylesheet" href="css/style-settings.css">
    <link rel="stylesheet" href="css/croppie.css">
    <link rel="stylesheet" href="css/jquery.arcticmodal.css">
    <link rel="stylesheet" href="css/themes/dark.css">
    <title>Jams</title>
</head>

<body>
    <?php require 'blocks/headder.php'; ?>

    <?php
    require 'php/connect.php';

    $user_photo_id = $_COOKIE['user'];
    $user_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT photo.`link_photo` FROM `photo` INNER JOIN `users` on photo.photo_id = users.photo_id WHERE users.`user_id` = '$user_photo_id'"));
    $conn->close();
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 jam">
                <form action="">
                    <div class="row jam-header">
                        <div class="name">
                            <h4>Настройки</h4>
                            <p>Пользователь:
                                <?php
                                echo $_COOKIE['first_name'] . ' ' . $_COOKIE['last_name'];
                                ?></p>
                        </div>
                    </div>
                    <div class="change-image">
                        <h4>Изображение профиля</h4>
                        <div class="content-source">
                            <img src="<?php echo $user_photo['link_photo']; ?>" alt="" id="img-source">
                        </div>
                    </div>

                    <div class="perscab-photoedit-body">
                        <p><a href="#" class="add-photo">Change photo</a></p>
                        <input style="display:none;" id="c_input24" name="file" multiple="false" type="file">
                        <input style="display:none;" name="photo_c" multiple="false" type="hidden" value="">
                        <input style="display:none;" name="photo_i" value="" multiple="false" type="hidden">
                    </div>

                    <input type="submit" class="btn btn-success pd-lr-30" value="Сохранить">
                </form>

                <!-- <div class="perscab-photoedit-img">
                    <img src="#" alt="">
                </div> -->

                <div style="display:none">
                    <div class="profile-modal-photo box-modal">
                        <div class="box-modal_close arcticmodal-close"></div>
                        <div>
                            <img class="profile_photo_i" src="">
                        </div>
                        <div class="modal-footer center-wrap">
                            <button class="reg-btn reg-btn_empty reg-btn_empty-wht reg-btn_blk-hover js-main-image">Submit</button>
                        </div>
                    </div>
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
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#choose-photo").change(function() {
            readURL(this);
        });
    </script>

    <script src="js/main.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/croppie.min.js"></script>
    <script src="js/jquery.arcticmodal.js"></script>
    <script src="js/script.js"></script>
</body>

</html>