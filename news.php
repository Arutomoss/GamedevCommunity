<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,400i,500,500i,700,900&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/style-news.css">
    <title>Новости</title>
</head>

<body>
    <?php
        // if ($_COOKIE['user'] == ''){
        //     // header('Location: sign_in.php');
        // }
        require 'blocks/headder.php';
    ?> 
   

    <div class="m_container">
        <div class="main">
            <div class="whats_new">
                <div class="mini-icon">
                    <img src="img/test.jpg" alt="">
                </div>

                <svg width="2" height="28" viewBox="0 0 2 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L1 27" stroke="#4A4A4A" stroke-linecap="round" />
                </svg>

                <input type="text" placeholder="Что нового?">
            </div>

            <div class="content">
                <div class="content-icon">
                    <img src="img/logo_light.svg" alt="" height="45px">
                </div>
                <div class="wrap">
                    <div class="content-headder">
                        <div class="content-headder-title">
                            <p>Insomnia Game News</p>
                            <!-- <div class="title-info">
                                <p>@IGN </p>
                                <p>• 20 мин</p>
                            </div> -->
                        </div>
                        <div class="content-discription">
                            <p>Sony говорит, что PS5 сможет использовать 8K графику ... но мы не ожидаем, что она сможет
                                достичь всего этого разрешения изначально. Вот как их консоль следующего поколения
                                сможет
                                реализовать все эти пиксели в 2020 году.</p>
                        </div>
                    </div>
                    <div class="content-source">
                        <img src="img/post_image_1.jpg" alt="">
                    </div>
                    <div class="content-bottom-panel">
                        <div class="content-bottom-panel-comments">
                            <img src="img/comments.svg" alt="">
                            <p>34</p>
                        </div>
                        <div class="content-bottom-panel-reposts">
                            <img src="img/reposts.svg" alt="">
                            <p>9</p>
                        </div>
                        <div class="content-bottom-panel-likes">
                            <img src="img/likes.svg" alt="">
                            <p>734</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="actual">
            <div class="actual-panel">
                <div class="actual-panel-title">
                    <p>Актуальное для вас</p>
                </div>
                <div class="actual-panel-content">
                    <div class="actual-panel-item">
                        <img src="img/logo_light.svg" alt="">
                        <div>
                            <div class="actual-panel-item-jam">
                                <p>August JAM</p>
                            </div>
                            <div class="actual-panel-item-discription">
                                <p>Краткое описание мероприятия</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>