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
                    <input type="file" class="form-control-file border-0" id="choose-photo" name="photo" accept="image/*,image/jpeg">
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
</body>

</html>