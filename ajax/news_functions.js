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

function showPosts(all_posts) {
    if (all_posts != "") {

        var main = document.getElementById('main');

        for (var i = 0; i < all_posts.length; i++) {

            var user = getUser(all_posts[i]['user_id']);

            var content = document.createElement('div');
            content.className = 'content';
            {
                var content_icon = document.createElement('div');
                content_icon.className = 'content-icon';
                {
                    var user_photo_link = document.createElement('a');
                    user_photo_link.href = 'mypage.php?user_id=' + all_posts[i]['user_id'];
                    {
                        var user_photo = document.createElement('img');
                        user_photo.src = getPhoto(user['photo_id']);
                        user_photo.setAttribute("height", "50px");
                    }
                }

                user_photo_link.appendChild(user_photo);
                content_icon.appendChild(user_photo_link);

                var wrap = document.createElement('div');
                wrap.className = 'wrap';
                {
                    var content_header = document.createElement('div');
                    content_header.className = 'content-headder';
                    {
                        var content_header_title = document.createElement('div');
                        content_header_title.className = 'content-headder-title';
                        {
                            var user_name_link = document.createElement('a');
                            user_name_link.href = 'mypage.php?user_id=' + all_posts[i]['user_id'];
                            user_name_link.textContent = user['first_name'] + ' ' + user['last_name'];

                            var title_info = document.createElement('p');
                            title_info.className = 'title-info';
                            title_info.textContent = "@" + user['user_login'] + " " + all_posts[i]['date_create'];
                        }
                        content_header_title.appendChild(user_name_link);
                        content_header_title.appendChild(title_info);

                        var content_discription = document.createElement('div');
                        content_discription.className = 'content-discription';
                        {
                            var post_text = document.createElement('p');
                            post_text.textContent = all_posts[i]['post_text']
                        }
                        content_discription.appendChild(post_text);
                    }
                    content_header.appendChild(content_header_title);
                    content_header.appendChild(content_discription);

                    if (all_posts[i]['photo_id'] != null) 
                    {
                        var content_source = document.createElement('div');
                        content_source.className = 'content-source';
                        {
                            var content_source_img = document.createElement('img');
                            content_source_img.className = 'img-fluid';
                            content_source_img.src = getPhoto(all_posts[i]['photo_id']);

                        }
                        content_source.appendChild(content_source_img);
                    }

                    var content_bottom_panel = document.createElement('div');
                    content_bottom_panel.className = 'content-bottom-panel';
                    {
                        var content_bottom_panel_comments = document.createElement('div');
                        content_bottom_panel_comments.className = 'content-bottom-panel-comments';
                        {
                            var comment_img = document.createElement('img');
                            comment_img.src = 'img/comments.svg';
                        }
                        content_bottom_panel_comments.appendChild(comment_img);

                        var content_bottom_panel_reposts = document.createElement('div');
                        content_bottom_panel_reposts.className = 'content-bottom-panel-reposts';
                        {
                            var reposts_img = document.createElement('img');
                            reposts_img.src = 'img/reposts.svg';
                        }
                        content_bottom_panel_reposts.appendChild(reposts_img);

                        var content_bottom_panel_likes = document.createElement('div');
                        content_bottom_panel_likes.className = 'content-bottom-panel-likes';
                        {
                            var likes = document.createElement('a');
                            likes.href = '#';
                            likes.innerHTML = '<svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.5 15L8.2 14.7475C1.75 9.44444 0 7.57576 0 4.54545C0 2.0202 2 0 4.5 0C6.55 0 7.7 1.16162 8.5 2.07071C9.3 1.16162 10.45 0 12.5 0C15 0 17 2.0202 17 4.54545C17 7.57576 15.25 9.44444 8.8 14.7475L8.5 15ZM4.5 1.0101C2.55 1.0101 1 2.57576 1 4.54545C1 7.12121 2.6 8.83838 8.5 13.6869C14.4 8.83838 16 7.12121 16 4.54545C16 2.57576 14.45 1.0101 12.5 1.0101C10.75 1.0101 9.8 2.07071 9.05 2.92929L8.5 3.58586L7.95 2.92929C7.2 2.07071 6.25 1.0101 4.5 1.0101Z" fill="#C1C1C1"/> </svg>';
                        }
                        content_bottom_panel_likes.appendChild(likes);
                    }
                    content_bottom_panel.appendChild(content_bottom_panel_comments);
                    content_bottom_panel.appendChild(content_bottom_panel_reposts);
                    content_bottom_panel.appendChild(content_bottom_panel_likes);
                }
                wrap.appendChild(content_header);
                if (all_posts[i]['photo_id'] != null) 
                    wrap.appendChild(content_source);
                wrap.appendChild(content_bottom_panel);
            }
            content.appendChild(content_icon);
            content.appendChild(wrap);

            main.appendChild(content);
        }
    }
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