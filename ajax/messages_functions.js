//  VARIABLES

var searchPanel = 'search';
var searchInput = 'search-input';
var searchBtn = 'search-btn';

// END - VARIABLES


// FUNCTIONS

function getValue(id) {
    return document.getElementById(id).value;
}

function appendSearchResult(data) {
    var dialogs_wraper = document.getElementById('dialogs-wraper');
    dialogs_wraper

    var wraper = document.createElement('div');
    wraper.id = 'search-wraper';
    // var wraper = $("#search-wraper");
    // wraper.id = 'search-wraper';
    // alert(q.id);
    dialogs_wraper.textContent = "";

    if (data != "") {
        for (var i = 0; i < data.length; i++) {
            var item = document.createElement('div');
            item.className = 'actual-panel-item user-chat';
            item.setAttribute("onclick", "startChat(" + data[i]['user_id'] + ")");

            var link = document.createElement('a');
            // link.href = 'mypage.php?user_id=' + data[i]['user_id'];
            link.href = '#';

            var img = document.createElement('img');
            img.src = getPhoto(data[i]['photo_id']);

            link.appendChild(img);
            item.appendChild(link);

            var actual_panel = document.createElement('div');
            actual_panel.className = 'actual-panel-item-jam';

            var text = document.createElement('p');

            var user_name = document.createElement('a');
            // user_name.href = 'mypage.php?user_id=' + data[i]['user_id'];
            user_name.href = '#';
            user_name.textContent = data[i]['first_name'] + ' ' + data[i]['last_name'];

            text.appendChild(user_name);
            actual_panel.appendChild(text);

            var short_description = document.createElement('div');
            short_description.className = 'actual-panel-item-discription';

            var description = document.createElement('p');
            description.textContent = data[i]['short_description'];

            short_description.appendChild(description);

            var full_description = document.createElement('div');
            full_description.appendChild(actual_panel);
            full_description.appendChild(short_description);

            item.appendChild(full_description);

            wraper.appendChild(item);
            dialogs_wraper.appendChild(wraper);
        }
    }
    else {
        dialogs_wraper.textContent = "";
        showAllDialogs(getAllDialogs(getCookie('user')));
    }
}

function startChat(user_id) {
    $.ajax({
        type: "POST",
        async: false,
        url: "../php/messages/start_chat.php",
        data: { user_id: user_id },
        success: function (result) {
            // alert(result);
            switch (result) {
                case '0': {
                    alert('Чат уже создан');
                    // openChat();
                    showAllDialogs(getAllDialogs(getCookie('user')));
                    break;
                }
                case '1': {
                    alert('Чат успешно содан!');
                    // openChat();
                    break;
                }
                case '2': {
                    alert('Ошибка, что-то пошло не так');
                    break;
                }
            }
        }
    });

    // var wraper = document.getElementById('search-wraper');
    // wraper.textContent = "";
}

function showAllDialogs(data) {
    var wraper = document.getElementById('dialogs-wraper');
    wraper.textContent = "";

    var chats_id = getAllChatsID(getCookie('user'));

    if (data != "") {
        for (var i = 0; i < data.length; i++) {
            var item = document.createElement('div');
            item.className = 'actual-panel-item user-chat';
            item.id = chats_id[i]['chat_id'];
            item.setAttribute("onclick", "openDialog(" + data[i]['user_id'] + ", " + chats_id[i]['chat_id'] + ")");

            var link = document.createElement('a');
            // link.href = 'mypage.php?user_id=' + data[i]['user_id'];
            link.href = '#';

            var img = document.createElement('img');
            img.src = getPhoto(data[i]['photo_id']);

            link.appendChild(img);
            item.appendChild(link);

            var actual_panel = document.createElement('div');
            actual_panel.className = 'actual-panel-item-jam';

            var text = document.createElement('p');

            var user_name = document.createElement('a');
            // user_name.href = 'mypage.php?user_id=' + data[i]['user_id'];
            user_name.href = '#';
            user_name.textContent = data[i]['first_name'] + ' ' + data[i]['last_name'];

            text.appendChild(user_name);
            actual_panel.appendChild(text);

            var short_description = document.createElement('div');
            short_description.className = 'actual-panel-item-discription';

            var description = document.createElement('p');
            description.textContent = data[i]['short_description'];

            short_description.appendChild(description);

            var full_description = document.createElement('div');
            full_description.appendChild(actual_panel);
            full_description.appendChild(short_description);

            item.appendChild(full_description);

            wraper.appendChild(item);
        }
    }
    else
        wraper.textContent = "";
}

function openDialog(user_id, chat_id) {
    if (user_id != "") {

        window.location.href = 'messages.php?chat_id=' + chat_id;

        // let params = new URLSearchParams(document.location.search.substring(1));
        // let id_of_chat = params.get("chat_id");

        // alert(id_of_chat);

        // if (id_of_chat == null) {
        //     window.location.href = 'messages.php?chat_id=' + chat_id;
        // }
        // else if (id_of_chat != chat_id){
        //     // window.location.href = 'messages.php?chat_id=' + chat_id;
        //     var user = getUser(user_id);
        //     $("#messages-place-before").attr('hidden', true);
        //     $("#messages-place").attr('hidden', false);

        //     var dialog_item = document.getElementById(chat_id);
        //     dialog_item.className = "actual-panel-item user-chat selected";

        //     var user_title = document.getElementById('user-title');
        //     user_title.innerText = user['first_name'] + ' ' + user['last_name'];

        //     loadMessages(chat_id);
        // }
        // else {
        //     var user = getUser(user_id);
        //     $("#messages-place-before").attr('hidden', true);
        //     $("#messages-place").attr('hidden', false);

        //     var dialog_item = document.getElementById(chat_id);
        //     dialog_item.className = "actual-panel-item user-chat selected";

        //     var user_title = document.getElementById('user-title');
        //     user_title.innerText = user['first_name'] + ' ' + user['last_name'];

        //     loadMessages(chat_id);
        //     // $('.receiver-id').id = user['user_id'];
        // }
    }
}

function addMessage(message) {
    var message_area = document.getElementById('message_area');

    var message_wrap = document.createElement('div');
    message_wrap.className = 'message-wrap current';
    message_wrap.id = message['user_id_1'];
    {
        var message_ = document.createElement('div');
        message_.className = 'message current-user-wrap';
        {
            var text = document.createElement('p');
            text.innerText = message['message_text'];
            text.className = 'message-text';

            var time = document.createElement('p');
            time.innerText = '12:34';
            time.className = 'message-time';
        }
        message_.appendChild(text);
        message_.appendChild(time);
    }
    message_wrap.appendChild(message_);

    message_area.appendChild(message_wrap);
}

function loadMessages(user_id, chat_id) {
    var all_messages = getUserMessages(chat_id);

    var user = getUser(user_id);
    var dialog_item = document.getElementById(chat_id);
    dialog_item.className = "actual-panel-item user-chat selected";

    var user_title = document.getElementById('user-title');
    user_title.innerText = user['first_name'] + ' ' + user['last_name'];

    if (all_messages != "") {
        var message_area = document.getElementById('message_area');
        message_area.innerHTML = "";

        for (var i = 0; i < all_messages.length; i++) {
            var message_wrap = document.createElement('div');

            if (all_messages[i]['user_id_1'] == getCookie('user')) {
                message_wrap.className = 'message-wrap current';
                // message_wrap.id = all_messages[i]['user_id_1'];

                var message_ = document.createElement('div');
                message_.className = 'message current-user-wrap';
            }
            else {
                message_wrap.className = 'message-wrap';
                // message_wrap.id = all_messages[i]['user_id_2'];

                var message_ = document.createElement('div');
                message_.className = 'message';
            }

            var text = document.createElement('p');
            text.innerText = all_messages[i]['message_text'];
            text.className = 'message-text';

            message_.appendChild(text);

            message_wrap.appendChild(message_);

            message_area.appendChild(message_wrap);
        }
    }
}

function getUserMessages(chat_id) {
    var messages;

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/messages/get_user_messages.php",
        data: { chat_id: chat_id },
        success: function (result) {
            messages = JSON.parse(result);
        }
    });

    return messages;
}

function getPhoto(photo_id) {
    var link;

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/news/get_photo.php",
        data: { id: photo_id },
        success: function (result) {
            link = result;
        }
    });

    return link;
}

function getUser(user_id) {
    var user;

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/news/get_user.php",
        data: { user_id: user_id },
        success: function (result) {
            user = JSON.parse(result);
        }
    });

    return user;
}

function getUserIdFromChatId(chat_id) {
    var user_id;

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/messages/get_user_from_chat_id.php",
        data: { chat_id: chat_id },
        success: function (result) {
            user_id = result;
        }
    });

    return user_id;
}

function getAllDialogs(user_id) {
    var messages;

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/messages/get_all_dialogs.php",
        data: { user_id: user_id },
        success: function (result) {
            // alert(result);
            messages = JSON.parse(result);
        }
    });

    return messages;
}

function getAllChatsID(user_id) {
    var chats;

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/messages/get_all_chats_id.php",
        data: { user_id: user_id },
        success: function (result) {
            // alert(result + ' - chats id');
            chats = JSON.parse(result);
        }
    });

    return chats;
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

// END - FUNCTIONS


// AJAX

function searchUser() {
    $.ajax({
        type: "POST",
        url: "../php/news/search_user.php",
        data: { search: getValue(searchInput) },
        success: function (result) {
            if (result)
                appendSearchResult(JSON.parse(result));
            else
                appendSearchResult("");
        },
        error: function () {
            alert('Ошибка!');
        }
    });
}

// END - AJAX