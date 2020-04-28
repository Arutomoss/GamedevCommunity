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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-messages.css">
    <title>Messages</title>
</head>

<body>
    <?php require 'blocks/headder.php'; ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="chats col-3 mr-4">
                <div class="row">
                    <div class="col d-flex align-items-center" style=" border-bottom: solid 1px #3D3D3D; height: 50px;">
                        <img src="img/search.svg" alt="" style=" margin-left: 5px;">
                        <input type="text" style="border-radius: 25px; border: none; background-color: #303030; color: #E2E2E2;  font-size: 15px; font-family: Montserrat; padding-top:2px;" placeholder="Поиск" class="col-10">
                    </div>
                    <div class="col-12 stretch" style="background-color: #303030; margin:0px; height: 79.5vh;">

                    </div>
                    <div class="col d-flex justify-content-end" style="height: 50px;">
                        <img src="img/settings.svg" alt="" class="">
                    </div>
                </div>
            </div>
            <div class="messages row col-7" style="padding: 0px;">
                <div class="col-12-fluid d-flex" style="height: 50px; padding-left: 17px;">
                    <img src="img/logo_light.svg" alt="" class="align-self-center" height="35px">
                    <p style="font-weight: 700; color: white; font-size: 16px; padding-left: 15px; margin: 0px; align-self: center; font-family: Montserrat;">Wendy Watson</p>
                </div>
                <div class="col-12 stretch" style="position: relative; background-color: #252525; margin:0px; height: 88.2%;">

                </div>
                <div class="col" style="height: 50px; padding-top: 12px; padding-left: 25px;">
                    <input type="text" style="border-radius: 25px; border: none; background-color: #303030; color: #E2E2E2; font-size: 15px; margin-right: 15px; font-family: Montserrat;" placeholder="Напишите сообщение" class="col-11">
                    <!-- <div class="im_editable im-chat-input--text _im_text" tabindex="0" contenteditable="true" id="im_editable0" role="textbox" aria-multiline="true"></div> -->
                    <img src="img/send.svg" alt="" height="19px">
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>


<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->