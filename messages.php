<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style-messages.css">
    <title>Messages</title>
</head>

<body>
    <?php require 'blocks/headder.php'; ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="chats col-3 mr-3">
                <div class="row">
                    <div class="col d-flex align-items-center">
                        <img src="img/search.svg" alt="" style="margin-top: 19px; margin-left: 5px;">
                        <input type="text" style="border-radius: 25px; border: none; background-color: #303030; color: #7B7B7B; margin-top:18px; font-size: 17px;" placeholder="Поиск" class="col-10">
                    </div>
                </div>
            </div>
            <div class="messages row col-7 ml-1" style="padding: 0px;">
                <div class="col-12" style="height: 50px;">

                </div>
                <div class="col-12 stretch" style="background-color: #252525; margin:0px; height: 85%;">
                
                </div>
                <div class="col" style="height: 50px; padding-top: 18px;">
                    <input type="text" style="border-radius: 25px; border: none; background-color: #303030; color: #7B7B7B; font-size: 17px; margin-right: 15px;" placeholder="Напишите сообщение" class="col-11">
                    <img src="img/send.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</body>

</html>