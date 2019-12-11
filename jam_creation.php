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
                    <div style="color: #fff; font-family: montserrat; margin-left: 30px; margin-top: 20px; margin-bottom: 7px;">Название</div>
                    <div class="col">
                        <input type="text" placeholder="Введите название" class="rounded-25 border-0 ml-2" style="height: 25px; width: 235px;">
                    </div>
                </div>
            </div>
            <div class="col-8 jam-place">
                <div class="row jam">

                </div>
            </div>
        </div>

    </div>


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>