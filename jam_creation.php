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

    <div class="container">
        <div class="row">
            <div class="mr-3 settings-panel">
                <div class="row" style="padding-left: 30px; padding-right: 30px;">
                    <p style=" margin-top: 30px; color: #E8E8E8; font-size: 16px; font-family: montserrat; border-bottom: 2px solid #404040; width: 100%; padding-bottom: 5px;">Цвета</p>
                </div>
                <div class="row justify-content-between" style="padding-left: 30px; padding-right: 30px; color: #E8E8E8">
                    Цвет текста
                    <input type="text" class="rounded-25 border-0" placeholder="#FFFFFF" style="margin-bottom: 12px; width: 100px;" maxlength="7">
                    Цвет фона
                    <input type="text" class="rounded-25 border-0" placeholder="#303030" style="margin-bottom: 12px; width: 100px;" maxlength="7">
                    Цвет ссылок
                    <input type="text" class="rounded-25 border-0" placeholder="#F0052F" style="margin-bottom: 12px; width: 100px;" maxlength="7">
                </div>
                <div class="row" style="padding-left: 30px; padding-right: 30px;">
                    <p style=" margin-top: 35px; color: #E8E8E8; font-size: 16px; font-family: montserrat; border-bottom: 2px solid #404040; width: 100%; padding-bottom: 5px;">Дополнительно</p>
                </div>
                <div class="row justify-content-between" style="padding-left: 30px; padding-right: 30px; color: #E8E8E8">
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
                <div class="row" style="padding-left: 30px; padding-right: 30px;">
                    <p style=" margin-top: 35px; color: #E8E8E8; font-size: 16px; font-family: montserrat; border-bottom: 2px solid #404040; width: 100%; padding-bottom: 5px;">Добавить изображение</p>
                </div>
                <div class="row" style="padding-left: 30px; padding-right: 30px;">
                    <!-- <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo">
                            <label class="custom-file-label rounded-25 border-0 chs-file" for="inputGroupFile01">Выберите файл</label>
                        </div>
                    </div> -->
                    <form>
                        <div class="form-group">
                            <!-- <label for="exampleFormControlFile1">Example file input</label> -->
                            <input type="file" class="form-control-file border-0" id="exampleFormControlFile1" style="padding-left: 0px; background-color: #303030;">
                        </div>
                    </form>
                </div>
                <div class="row" style="padding-left: 30px; padding-right: 30px; margin-top: 10px;">
                    <button type="button" class="btn btn-danger col rounded-25 btn-save">Сохранить</button>
                </div>
            </div>
            <div class="col-8 jam-place">
                <form action="">
                    <div class="col jam">
                        <div class="row jam-header justify-content-between">
                            <div class="form-group col" style="padding-left: 0px;">
                                <input type="text" class="form-control border-0" id="jam-name" placeholder="Введите название" style="background-color: #303030; padding-left: 0px; padding-right: 0px; color: #F1F1F1; font-size: 22px; font-weight: bold; font-family: montserrat;" maxlength="30">
                            </div>
                            <div class="name">
                                Julie Richards
                                <img src="img/logo_light.svg" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <textarea class="form-control border-0" id="short-description" rows="1" style="background-color: #303030; color: #F1F1F1; font-family: montserrat; font-size: 16px; padding-left: 0px; padding-right: 0px; margin-top: -18px;" placeholder="Введите краткое описание..."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 jam-description">
                                <textarea class="form-control border-0" id="description" rows="5" style="background-color: #303030; color: #F1F1F1; font-family: montserrat; font-size: 14px; padding-left: 0px; padding-right: 0px;" placeholder="Введите описание..."></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    </div>


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>


<!-- <div class="circle" style="height: 18px; width: 18px; margin-top: 3px; margin-left: 218px; border-radius: 50%; background-color: #E8E8E8; position: fixed;"></div> -->