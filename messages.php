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
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-messages.css">
    <title>Messages</title>
</head>

<body onload="init();">
    <?php require 'blocks/headder.php'; ?>

    <script type="text/javascript">
        var observe;
        if (window.attachEvent) {
            observe = function(element, event, handler) {
                element.attachEvent('on' + event, handler);
            };
        } else {
            observe = function(element, event, handler) {
                element.addEventListener(event, handler, false);
            };
        }

        function init() {
            var text = document.getElementById('post_text');

            function resize() {
                text.style.height = 'auto';
                // text.style.position = 'absolute'
                text.style.height = text.scrollHeight + 'px';
            }
            /* 0-timeout to get the already changed text */
            function delayedResize() {
                window.setTimeout(resize, 0);
            }
            observe(text, 'change', resize);
            observe(text, 'cut', delayedResize);
            observe(text, 'paste', delayedResize);
            observe(text, 'drop', delayedResize);
            observe(text, 'keydown', delayedResize);

            text.focus();
            text.select();
            resize();
        }
    </script>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="chats col-3 mr-4">
                <div class="row">
                    <div class="col d-flex align-items-center p-0" style=" border-bottom: solid 1px #3D3D3D; height: 50px;">
                        <!-- <img src="img/search.svg" alt="" style=" margin-left: 5px;"> -->
                        <!-- <input type="text" id="search-input" name="search" oninput="searchUser()" placeholder="Поиск" class="col-10 search"> -->
                        <div class="search" id="search">
                            <div class="search-form">
                                <input type="text" class="search-input" id="search-input" name="search" oninput="searchUser()" placeholder="Искать здесь..." autocomplete="off">
                                <button class="search-btn" id="search-btn"><img src="img/search.svg" alt=""></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 stretch p-0" id="dialogs-wraper">
                        <!-- <div id="search-wraper">
                        </div> -->
                        <!-- <div class="user-chat selected">
                            <div class="user-chat-photo">
                                <div class="user-chat-img"></div>
                            </div>
                            <div class="user-chat-info">
                                <div class="user-chat-name">
                                    Artem Kosharnov
                                </div>
                                <div class="user-chat-description">
                                    some info
                                </div>
                            </div>
                        </div>
                        <div class="user-chat">
                            <div class="user-chat-photo">
                                <div class="user-chat-img"></div>
                            </div>
                            <div class="user-chat-info">
                                <div class="user-chat-name">
                                    Artem Kosharnov
                                </div>
                                <div class="user-chat-description">
                                    some info
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="col d-flex justify-content-end" style="height: 50px;">
                        <img src="img/settings.svg" alt="" class="">
                    </div> -->
                </div>
            </div>
            <div class="messages row col-7" style="padding: 0px; padding-bottom: 62px">
                <div id="messages-place" hidden>
                    <div class="col-12-fluid d-flex" style="height: 50px; padding-left: 17px; width: 100%">
                        <p class="dialog-user-name" id="user-title" name="receiver">
                            <!--Wendy Watson-->
                        </p>
                        <div class="receiver-id" id=""></div>
                    </div>
                    <!-- <div class="col-12 stretch" style="position: relative; background-color: #252525; margin:0px; height: 88.2%;">

                </div> -->
                    <!-- <div class="col bottom-dialog-panel"> -->
                    <!-- <input type="text" placeholder="Напишите сообщение" class="col-11 bottom-dialog-panel-input"> -->
                    <!-- <textarea rows="1" style="height:1em; color: #eeeeee;" id="post_text" name="post_text" placeholder="Напишите сообщение" maxlength="400"></textarea> -->
                    <!-- <div class="im_editable im-chat-input--text _im_text" tabindex="0" contenteditable="true" id="im_editable0" role="textbox" aria-multiline="true"></div> -->
                    <!-- <img src="img/send.svg" alt="" height="19px"> -->
                    <!-- </div> -->
                    <div class="messages-area" id="message_area">
                        <!-- <div class="message-wrap" id="2">
                            <div class="message">
                                <p class="message-text">Привет мазафака чучхелла Привет мазафака чучхелла Привет мазафака чучхелла Привет мазафака чучхелла Привет мазафака чучхелла</p>
                                <p class="message-time">12:00</p>
                            </div>
                        </div>
                        <div class="message-wrap current" id="1">
                            <div class="message current-user-wrap">
                                <p class="message-text">Привет мазафака чучхелла Привет мазафака чучхелла Привет мазафака чучхелла Привет мазафака чучхелла Привет мазафака чучхелла</p>
                                <p class="message-time">12:00</p>
                            </div>
                        </div> -->
                    </div>
                    <div class="whats_new">
                        <textarea rows="1" style="height:28px; color: #eeeeee;" id="post_text" name="post_text" placeholder="Что нового?" maxlength="1000"></textarea>
                        <div class='preview-img'>
                            <img src="" alt="" id="img-source" style="width: 100%;">
                        </div>

                        <button type="button" class="send-btn" id="send-message"><img src="img/send.svg" class="send" alt=""></button>
                    </div>
                </div>
                <div id="messages-place-before">Пожалуйста, выберите беседу или создайте новую</div>
            </div>
        </div>
    </div>

    <script src="ajax/messages_functions.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(function() {
            let params = new URLSearchParams(document.location.search.substring(1));
            let chat_id = params.get("chat_id");
            // alert(chat_id);

            if (chat_id == null) {
                showAllDialogs(getAllDialogs(getCookie('user')));
                $("#messages-place-before").attr('hidden', false);
                $("#messages-place").attr('hidden', true);
            } else {
                showAllDialogs(getAllDialogs(getCookie('user')));
                $("#messages-place-before").attr('hidden', true);
                $("#messages-place").attr('hidden', false);
            }

            $("#send-message").click(function() {
                // sendMessage();
                var receiver_id = document.getElementsByName('receiver')[0].id;
                var text = document.getElementById('post_text').value;

                // alert(name);
                $.ajax({
                    type: "POST",
                    async: false,
                    url: "../php/messages/send_message.php",
                    data: {
                        user_id: getCookie('user'),
                        receiver_id: receiver_id,
                        message_text: text,
                        chat_id: chat_id
                    },
                    success: function(result) {
                        // addMessage(JSON.parse(result));
                        alert(result);
                    }
                });
            });
        });
    </script>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>