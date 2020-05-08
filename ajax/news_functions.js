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
    var wraper = document.getElementById('search-wraper');
    wraper.textContent = "";

    if (data != "") {
        for (var i = 0; i < data.length; i++) {
            var item = document.createElement('div');
            item.className = 'actual-panel-item';

            var link = document.createElement('a');
            link.href = 'mypage.php?user_id=' + data[i]['user_id'];
            link.textContent = data[i]['name'];

            var img = document.createElement('img');
            img.src = getPhoto(data[i]['photo_id']);

            link.appendChild(img);
            item.appendChild(link);

            var actual_panel = document.createElement('div');
            actual_panel.className = 'actual-panel-item-jam';

            var text = document.createElement('p');

            var user_name = document.createElement('a');
            user_name.href = 'mypage.php?user_id=' + data[i]['user_id'];
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