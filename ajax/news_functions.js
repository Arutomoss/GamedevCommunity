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
    } else
        wraper.textContent = "";
}

function getPhoto(photo_id) {
    var link;

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/news/get_photo.php",
        data: {
            id: photo_id
        },
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
        data: {
            user_id: user_id
        },
        success: function (result) {
            user = JSON.parse(result);
        }
    });

    return user;
}

function wichMonth(month) {
    switch (month) {
        case '01': {
            return 'Января';
            break;
        }
        case '02': {
            return 'Февраля';
            break;
        }
        case '03': {
            return 'Марта';
            break;
        }
        case '04': {
            return 'Апреля';
            break;
        }
        case '05': {
            return 'Мая';
            break;
        }
        case '06': {
            return 'Июня';
            break;
        }
        case '07': {
            return 'Июля';
            break;
        }
        case '08': {
            return 'Августа';
            break;
        }
        case '09': {
            return 'Сентября';
            break;
        }
        case '10': {
            return 'Октября';
            break;
        }
        case '11': {
            return 'Ноября';
            break;
        }
        case '12': {
            return 'Декабря';
            break;
        }
        default:
            return '';
    }
}

function showPosts(all_posts) {
    if (all_posts != "") {

        var current_user_id = getCookie('user');
        var main = document.getElementById('main');

        for (var i = 0; i < all_posts.length; i++) {

            var user = getUser(all_posts[i]['user_id']);

            var content = document.createElement('div');
            content.className = 'content'; {
                var content_icon = document.createElement('div');
                content_icon.className = 'content-icon'; {
                    var user_photo_link = document.createElement('a');
                    user_photo_link.href = 'mypage.php?user_id=' + all_posts[i]['user_id']; {
                        var user_photo = document.createElement('img');
                        user_photo.src = getPhoto(user['photo_id']);
                        user_photo.setAttribute("height", "50px");
                    }
                }

                user_photo_link.appendChild(user_photo);
                content_icon.appendChild(user_photo_link);

                var wrap = document.createElement('div');
                wrap.className = 'wrap';
                wrap.id = `wrap-id-${all_posts[i]['post_id']}`;
                {
                    var content_header = document.createElement('div');
                    content_header.className = 'content-headder'; {
                        var content_header_title = document.createElement('div');
                        content_header_title.className = 'content-headder-title'; {
                            var user_name_link = document.createElement('a');
                            user_name_link.href = 'mypage.php?user_id=' + all_posts[i]['user_id'];
                            user_name_link.textContent = user['first_name'] + ' ' + user['last_name'];

                            var title_info = document.createElement('p');
                            title_info.className = 'title-info';

                            let date = all_posts[i]['date_create'];
                            let month = wichMonth(date.substring(5, 7));

                            title_info.textContent = `@${user['user_login']} ${date.substring(8, 10)} ${month} в ${date.substring(11, 13)}:${date.substring(14, 16)}`;
                        }
                        content_header_title.appendChild(user_name_link);
                        content_header_title.appendChild(title_info);

                        var content_discription = document.createElement('div');
                        content_discription.className = 'content-discription'; {
                            var post_text = document.createElement('p');
                            post_text.textContent = all_posts[i]['post_text']
                        }
                        content_discription.appendChild(post_text);
                    }
                    content_header.appendChild(content_header_title);
                    content_header.appendChild(content_discription);

                    if (all_posts[i]['photo_id'] != null) {
                        var content_source = document.createElement('div');
                        content_source.className = 'content-source'; {
                            var content_source_img = document.createElement('img');
                            content_source_img.className = 'img-fluid';
                            content_source_img.src = getPhoto(all_posts[i]['photo_id']);

                        }
                        content_source.appendChild(content_source_img);
                    }

                    var content_bottom_panel = document.createElement('div');
                    content_bottom_panel.className = 'content-bottom-panel'; {
                        var content_bottom_panel_comments = document.createElement('div');
                        content_bottom_panel_comments.className = 'content-bottom-panel-comments';
                        content_bottom_panel_comments.setAttribute('onclick', `showCommentPanel(${all_posts[i]['post_id']})`);
                        {
                            var comment_img = document.createElement('img');
                            comment_img.src = 'img/comments.svg';

                            var amount_comments = document.createElement('div');
                            amount_comments.className = 'amount';
                            let count_comments = getPostComments(all_posts[i]['post_id'], 0);
                            amount_comments.innerText = count_comments.length;
                        }
                        content_bottom_panel_comments.appendChild(comment_img);
                        content_bottom_panel_comments.appendChild(amount_comments);

                        var content_bottom_panel_reposts = document.createElement('div');
                        content_bottom_panel_reposts.className = 'content-bottom-panel-reposts'; {
                            var reposts_img = document.createElement('img');
                            reposts_img.src = 'img/reposts.svg';

                            var amount_reposts = document.createElement('div');
                            amount_reposts.className = 'amount';
                            amount_reposts.innerText = '0';
                        }
                        content_bottom_panel_reposts.appendChild(reposts_img);
                        content_bottom_panel_reposts.appendChild(amount_reposts);

                        var content_bottom_panel_likes = document.createElement('div');
                        content_bottom_panel_likes.className = 'content-bottom-panel-likes'; {
                            var likes = document.createElement('a');
                            // likes.href = '#';
                            likes.innerHTML = '<svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.5 15L8.2 14.7475C1.75 9.44444 0 7.57576 0 4.54545C0 2.0202 2 0 4.5 0C6.55 0 7.7 1.16162 8.5 2.07071C9.3 1.16162 10.45 0 12.5 0C15 0 17 2.0202 17 4.54545C17 7.57576 15.25 9.44444 8.8 14.7475L8.5 15ZM4.5 1.0101C2.55 1.0101 1 2.57576 1 4.54545C1 7.12121 2.6 8.83838 8.5 13.6869C14.4 8.83838 16 7.12121 16 4.54545C16 2.57576 14.45 1.0101 12.5 1.0101C10.75 1.0101 9.8 2.07071 9.05 2.92929L8.5 3.58586L7.95 2.92929C7.2 2.07071 6.25 1.0101 4.5 1.0101Z" fill="#C1C1C1"/> </svg>';

                            likes.setAttribute('onclick', `setLike(${all_posts[i]['post_id']}, ${getCookie('user')})`);

                            var amount_likes = document.createElement('div');
                            amount_likes.className = 'amount';
                            amount_likes.innerText = all_posts[i]['amount_likes'];
                            amount_likes.id = `amount-${all_posts[i]['post_id']}`;
                        }
                        content_bottom_panel_likes.appendChild(likes);
                        content_bottom_panel_likes.appendChild(amount_likes);
                    }
                    content_bottom_panel.appendChild(content_bottom_panel_comments);
                    content_bottom_panel.appendChild(content_bottom_panel_reposts);
                    content_bottom_panel.appendChild(content_bottom_panel_likes);
                }
                wrap.appendChild(content_header);
                if (all_posts[i]['photo_id'] != null)
                    wrap.appendChild(content_source);
                wrap.appendChild(content_bottom_panel);

                var cur_user = getUser(getCookie('user'));

                var comment_panel = document.createElement('div');
                comment_panel.className = 'comment-panel';
                comment_panel.id = 'comment-panel-id-' + all_posts[i]['post_id'];
                comment_panel.setAttribute('hidden', 'true');
                {
                    var user_comment_img = document.createElement('img');
                    user_comment_img.className = 'comment-mini-icon';
                    user_comment_img.style.margin = '15px 0 15px 0';
                    user_comment_img.src = getPhoto(cur_user['photo_id']);

                    // var textarea_wrap = document.createElement('div');

                    var comment_input = document.createElement('textarea');
                    comment_input.id = 'text_area';
                    comment_input.name = 'post_text';
                    comment_input.className = `comment-text-id-${all_posts[i]['post_id']}`;
                    comment_input.setAttribute('onkeyup', "textarea_resize(event, 15, 2);")
                    comment_input.maxLength = "150";

                    var shit = document.createElement('div');
                    shit.id = 'text_area_div';

                    // textarea_wrap.appendChild(comment_input);

                    var comment_send_btn = document.createElement('button');
                    comment_send_btn.className = 'comment-send-btn';

                    comment_send_btn.setAttribute('onclick', `sendComment(${all_posts[i]['post_id']},${current_user_id})`);

                    var btn_img = document.createElement('img');
                    btn_img.src = 'img/send.svg';
                    btn_img.className = 'comment-send-img';

                    comment_send_btn.appendChild(btn_img);

                    comment_panel.appendChild(user_comment_img);
                    comment_panel.appendChild(comment_input);
                    comment_panel.appendChild(shit);
                    // comment_panel.appendChild(textarea_wrap);
                    comment_panel.appendChild(comment_send_btn);
                }

                var all_comments_panel = document.createElement('div');
                all_comments_panel.className = 'all-comments-panel';
                all_comments_panel.id = `all-comments-id-${all_posts[i]['post_id']}`;
                all_comments_panel.setAttribute('hidden', 'true');
                {
                    var comments = getPostComments(all_posts[i]['post_id'], 2);

                    if (comments != '') {
                        let comments_title = document.createElement('div');
                        comments_title.innerText = 'Показать все комментарии';
                        comments_title.className = 'comments-show-more';
                        comments_title.setAttribute('onclick', `showAllPostComments(${all_posts[i]['post_id']})`);

                        all_comments_panel.appendChild(comments_title);

                        for (let j = 0; j < comments.length; j++) {
                            let user_comment = document.createElement('div');
                            user_comment.className = 'user-comment';
                            {
                                // alert('coments id -' + comments[j]['user_id']);
                                let comment_user = getUser(comments[j]['user_id']);

                                let comment_photo = document.createElement('img');
                                comment_photo.className = 'comment-mini-icon';
                                comment_photo.style.margin = '5px 0 5px 0';
                                comment_photo.src = getPhoto(comment_user['photo_id']);

                                let comment_container = document.createElement('div');

                                let comment_user_name = document.createElement('p');
                                comment_user_name.className = 'comment-user-name';
                                comment_user_name.innerText = `${comment_user['first_name']} ${comment_user['last_name']}`;

                                let comment_text = document.createElement('p');
                                comment_text.innerText = comments[j]['comment_text'];

                                user_comment.appendChild(comment_photo);
                                comment_container.appendChild(comment_user_name);
                                comment_container.appendChild(comment_text);
                                user_comment.appendChild(comment_container);
                            }
                            all_comments_panel.appendChild(user_comment);
                        }
                        all_comments_panel.removeAttribute('hidden');
                    } wrap.appendChild(all_comments_panel);
                }
                wrap.appendChild(comment_panel);
            }
            content.appendChild(content_icon);
            content.appendChild(wrap);

            main.appendChild(content);
        }
    }
}

function showAllPostComments(post_id) {

    // let wrap = document.getElementById(`wrap-id-${post_id}`);

    let all_comments = document.getElementById(`all-comments-id-${post_id}`);
    all_comments.innerHTML = '';

    var comments = getPostComments(post_id, 0);

    if (comments != '') {
        let comments_title = document.createElement('div');
        comments_title.innerText = 'Показать все комментарии';
        comments_title.className = 'comments-show-more';
        comments_title.setAttribute('onclick', `showAllPostComments(${post_id})`);

        all_comments.appendChild(comments_title);

        for (let j = 0; j < comments.length; j++) {
            let user_comment = document.createElement('div');
            user_comment.className = 'user-comment';
            {
                // alert('coments id -' + comments[j]['user_id']);
                let comment_user = getUser(comments[j]['user_id']);

                let comment_photo = document.createElement('img');
                comment_photo.className = 'comment-mini-icon';
                comment_photo.style.margin = '5px 0 5px 0';
                comment_photo.src = getPhoto(comment_user['photo_id']);

                let comment_container = document.createElement('div');

                let comment_user_name = document.createElement('p');
                comment_user_name.className = 'comment-user-name';
                comment_user_name.innerText = `${comment_user['first_name']} ${comment_user['last_name']}`;

                let comment_text = document.createElement('p');
                comment_text.innerText = comments[j]['comment_text'];

                user_comment.appendChild(comment_photo);
                comment_container.appendChild(comment_user_name);
                comment_container.appendChild(comment_text);
                user_comment.appendChild(comment_container);
            }
            all_comments.appendChild(user_comment);
        }
        // wrap.appendChild(all_comments);
    }
}

function showCommentPanel(post_id) {
    var comment_panel = document.getElementById('comment-panel-id-' + post_id);
    comment_panel.removeAttribute('hidden');
}

// END - FUNCTIONS


// AJAX

function sendComment(post_id, user_id) {
    var comment_text_value = document.getElementsByClassName(`comment-text-id-${post_id}`)[0].value;
    document.getElementsByClassName(`comment-text-id-${post_id}`)[0].value = '';

    $.ajax({
        type: "POST",
        url: "../php/news/send_comment.php",
        data: {
            post_id: post_id,
            user_id: user_id,
            comment_text: comment_text_value
        },
        success: function (result) {
            if (result == 'success') {
                showAllPostComments(post_id);
            }
            else {
                alert('Что-то пошло не так');
            }
        },
        error: function () {
            alert('Ошибка!');
        }
    });
}

function getPostComments(post_id, limit) {
    var comments = '';

    $.ajax({
        type: "POST",
        async: false,
        url: "../php/news/get_post_comments.php",
        data: {
            post_id: post_id,
            limit: limit
        },
        success: function (result) {
            let res = JSON.parse(result);
            if (res.length != 0) {
                // alert('post id = ' + post_id + ' kso');
                comments = res;
            }
            else {
                // alert('govno');
                comments = '';
            }
        },
        error: function () {
            alert('Ошибка!');
        }
    });

    // alert('comm - '+comments);

    return comments;
}

function searchUser() {
    $.ajax({
        type: "POST",
        url: "../php/news/search_user.php",
        data: {
            search: getValue(searchInput)
        },
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

function setLike(post_id, user_id) {
    $.ajax({
        type: "POST",
        url: "../php/news/set_like.php",
        data: {
            post_id: post_id,
            user_id: user_id
        },
        success: function (result) {
            // alert(result);
            if (result == '1') {
                var amount_likes = document.getElementById(`amount-${post_id}`);
                amount_likes.innerText = Number(amount_likes.innerText) + 1;
            }
            if (result == '3') {
                var amount_likes = document.getElementById(`amount-${post_id}`);
                amount_likes.innerText = Number(amount_likes.innerText) - 1;
            }
        },
        error: function () {
            alert('Ошибка!');
        }
    });
}

// END - AJAX