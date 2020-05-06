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
    var content = document.getElementById(searchPanel);

    var item = document.createElement('div');
    item.className = 'search-result';

    var link = document.createElement('a');
    link.href = 'mypage.php?user_id=' + data[0]['user_id'];
    link.textContent = data[0]['name'];

    var img = document.createElement('img');
    img.src = data[0]['link_photo'];

    link.appendChild(img);
    item.appendChild(link);

    var actual_panel = document.createElement('div');
    actual_panel.className = 'actual-panel-item-jam';

    var text = document.createElement('p');

    var user_name = document.createElement('a');
    user_name.href = 'mypage.php?user_id=' + data[0]['user_id'];
    user_name.textContent = data[0]['first_name'] + ' ' + data[0]['last_name'];

    text.appendChild(user_name);
    actual_panel.appendChild(text);
    item.appendChild(actual_panel);

    var short_description = document.createElement('div');
    short_description.className = 'actual-panel-item-discription';

    var description = document.createElement('p');
    description.textContent = data[0]['short_description'];

    short_description.appendChild(description);
    item.appendChild(short_description);

    content.appendChild(item);
}

// END - FUNCTIONS

// AJAX

function searchUser(){
    $.ajax({
        type: "POST",
        url: "../php/search_user.php",
        data: { search: getValue(searchInput) },
        success: function (result) {
            appendSearchResult(JSON.parse(result));
        }
    });
}

// END - AJAX