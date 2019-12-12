<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-jam_creation.css">
    <title>Jams</title>
</head>

<body>
    <?php require 'blocks/headder.php'; ?>

    <div class="container ">
        <div class="row">
            <div class="col-3 mr-3 settings-panel">
                <div class="row">
                    
                </div>
            </div>
            <div class="col-8 jam-place">
                <form action="">
                    <div class="col jam">
                        <div class="row jam-header justify-content-between">
                            <div class="form-group">
                                <input type="text" class="form-control border-0" id="exampleInputPassword1" placeholder="Введите название" style="background-color: #303030; padding-left: 0px; padding-right: 0px; color: #F1F1F1; font-size: 22px; font-weight: bold; font-family: montserrat;">
                            </div>
                            <div class="name">
                                Julie Richards
                                <img src="img/logo_light.svg" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 jam-description">
                                <textarea class="form-control border-0" id="exampleFormControlTextarea1" rows="5" style="background-color: #303030; color: #F1F1F1; font-family: montserrat; font-size: 14px; padding-left: 0px; padding-right: 0px;" placeholder="Введите описание..."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <textarea class="form-control border-0" id="exampleFormControlTextarea1" rows="1" style="background-color: #303030; color: #F1F1F1; font-family: montserrat; font-size: 14px; padding-left: 0px; padding-right: 0px;" placeholder="Введите краткое описание..."></textarea>
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