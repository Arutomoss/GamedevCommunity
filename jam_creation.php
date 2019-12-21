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
    <link rel="stylesheet" href="css/style-jam_creation.css">
    <title>Jams</title>
</head>

<body>
    <?php require 'blocks/headder.php'; ?>

    <form action="php/add_event.php" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="mr-3 settings-panel">
                    <div class="row padding-lr-30">
                        <p class="settings-header">Цвета</p>
                    </div>
                    <div class="col padding-lr-30" >
                        <div class="row justify-content-between" style="width: 290px;">
                            Цвет текста
                            <input type="text" class="rounded-25 border-0 input-color" placeholder="#FFFFFF" maxlength="7" id="color-picker">
                        </div>
                        <div class="row justify-content-between" style="width: 290px;">
                            Цвет фона
                            <input type="text" class="rounded-25 border-0 input-color" placeholder="#303030" maxlength="7">
                        </div>
                        <div class="row justify-content-between" style="width: 290px;">
                            Цвет ссылок
                            <input type="text" class="rounded-25 border-0 input-color" placeholder="#F0052F" maxlength="7">
                        </div>

                    </div>
                    <div class="row padding-lr-30">
                        <p class="settings-header">Дополнительно</p>
                    </div>
                    <div class="row justify-content-between padding-lr-30">
                        Шрифт названия
                        <select class="custom-select rounded-15 border-0 font-dropdown" id="inputGroupSelect01" style="width: 120px;">
                            <option selected>Montserrat</option>
                            <option value="1">Anonymous Pro</option>
                            <option value="2">Segoe UI</option>
                            <option value="3">Roboto</option>
                        </select>
                        Шрифт описания
                        <select class="custom-select rounded-15 border-0 font-dropdown" id="inputGroupSelect01" style="width: 120px;">
                            <option selected>Montserrat</option>
                            <option value="1">Arial</option>
                            <option value="2">Segoe UI</option>
                            <option value="3">Roboto</option>
                        </select>
                        Размер шрифта
                        <select class="custom-select rounded-15 border-0 font-dropdown" id="inputGroupSelect01" style="width: 120px;">
                            <option selected>Маленький</option>
                            <option value="1">Средний</option>
                            <option value="2">Большой</option>
                            <option value="3">Очень большой</option>
                        </select>
                    </div>
                    <div class="row padding-lr-30" ">
                        <p class=" settings-header">Добавить изображение</p>
                    </div>
                    <div class="row padding-lr-30" ">
                        <div class=" form-group">
                        <input type="file" class="form-control-file border-0" id="choose-photo" style="padding-left: 0px; background-color: #303030;" name="photo" accept="image/*,image/jpeg">
                    </div>
                    <button type="submit" class="btn btn-danger col rounded-10 btn-save">Сохранить</button>
                </div>
            </div>
            <div class="col-8 jam-place">
                <div class="col jam">
                    <div class="row jam-header justify-content-between">
                        <div class="form-group col" style="padding-left: 0px;">
                            <input type="text" class="form-control border-0 pd-lr-0 jam-name" id="jam-name" name="jam-name" placeholder="Введите название" maxlength="30" autocomplete="off">
                        </div>
                        <div class="name">
                            <?php
                            require 'php/connect.php';
                            $result = mysqli_query($conn, "SELECT photo.link_photo FROM photo INNER JOIN users on photo.photo_id = users.photo_id WHERE photo.photo_id = users.photo_id");
                            $row = mysqli_fetch_assoc($result);

                            echo $_COOKIE['first_name'] . ' ' . $_COOKIE['last_name'];
                            echo '<img src="' . $row['link_photo'] . '" alt="" height="40px" class="rounded-circle" style="margin-left: 10px;">';
                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <textarea class="form-control border-0 pd-lr-0 short-description" id="short-description" name="short-description" rows="1" placeholder="Введите краткое описание..." autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="inputDate" style="color: #E8E8E8;">Введите дату начала:</label>
                            <input type="date" class="form-control border-0 date-input" name="date_start">
                        </div>
                        <div class="col-4">
                            <label for="inputDate" style="color: #E8E8E8;">Введите дату окончания:</label>
                            <input type="date" class="form-control border-0 date-input" name="date_end">
                        </div>
                    </div>
                    <div class='preview-img'>
                        <img src="" alt="" id="img-source" style="width: 100%;">
                    </div>
                    <div class="row">
                        <div class="form-group col-12 jam-description">
                            <textarea class="form-control border-0 pd-lr-0 description" id="description" name="description" rows="5" placeholder="Введите описание..." autocomplete="off"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>


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