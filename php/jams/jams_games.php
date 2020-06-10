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
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style-jams_games.css">
    <title>Игры</title>
</head>

<body>
    <?php
    require 'C:/OpenServer/domains/GamedevCommunity/blocks/headder.php';
    ?>

    <div class="container col-11">
        <div class="row games-place justify-content-center">
            <div class="col-8 games">
                <div class="header">
                    <a href="/jam.php?event_id=<?php echo $_GET['event_id']; ?>">
                        <svg width="30" height="16" viewBox="0 0 30 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 1L2 8M2 8L9 15M2 8H29.5" stroke="#999999" stroke-width="2" />
                        </svg>
                    </a>
                    <h2 id="jam-title"></h2>
                </div>
                <div class="text">Загруженные игры</div>
                <div class="row jam-games pd-lr-15" id="jam-games-place">
                    <!-- <div class="col game">
                        <a href="">
                            <div class="rounded-10 game-cover"></div>
                        </a>
                        <p class="title">Title</p>
                        <p class="description">short description</p>
                        <div class="user-name row justify-content-between">user name<p>platformer</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script src="/ajax/jams_functions.js"></script>
    <script src="/js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "/php/jams/get_jams_games.php",
                data: { event_id: <?php echo $_GET['event_id']; ?> },
                success: function(result) {
                    if (result)
                        showAllGames(JSON.parse(result));
                    else
                        showAllGames("");
                },
                error: function() {
                    alert('Ошибка!');
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "/php/jams/get_jam.php",
                data: { event_id: <?php echo $_GET['event_id']; ?> },
                success: function(result) {
                    // alert(result);
                    document.getElementById('jam-title').innerText = result;
                },
                error: function() {
                    alert('Ошибка!');
                }
            });
        });
    </script>

</body>

</html>