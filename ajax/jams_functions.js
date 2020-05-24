function getValue(id) {
    return document.getElementById(id).value;
}

function getPhoto(photo_id) {
    var link;

    $.ajax({
        type: "POST",
        async: false,
        url: "/php/news/get_photo.php",
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
        url: "/php/news/get_user.php",
        data: { user_id: user_id },
        success: function (result) {
            user = JSON.parse(result);
        }
    });

    return user;
}

function showAllGames(all_games) {
    if (all_games != "") {
        var main = document.getElementById('jam-games-place');
        var jam_title = document.getElementById('jam-title');
        jam_title.innerText = ''

        for (var i = 0; i < all_games.length; i++) {

            var user = getUser(all_games[i]['user_id']);

            var game = document.createElement('div');
            game.className = 'col game';
            {
                var game_photo_link = document.createElement('a');
                game_photo_link.href = '/php/jams/vote_for_game.php?game_id=' + all_games[i]['game_id'] + '?event_id=' + all_games[i]['event_id'];
                {
                    var cover_image = document.createElement('div');
                    cover_image.className = 'rounded-10 game-cover';
                    cover_image.setAttribute("style", "background-image: url(" + getPhoto(all_games[i]['photo_id']) + ")");
                }

                game_photo_link.appendChild(cover_image);

                var title = document.createElement('p');
                title.className = 'title';
                title.textContent = all_games[i]['game_name'];

                var description = document.createElement('p');
                description.className = 'description';
                description.textContent = all_games[i]['game_short_description'];

                var last = document.createElement('div');
                last.className = 'user-name row justify-content-between';

                var user_name_link = document.createElement('a');
                user_name_link.href = 'mypage.php?user_id=' + all_games[i]['user_id'];
                user_name_link.textContent = user['first_name'] + ' ' + user['last_name'];
                user_name_link.className = 'user-link';
                {
                    var genre = document.createElement('p');
                    genre.textContent = all_games[i]['game_genre'];
                }
                last.appendChild(user_name_link);
                last.appendChild(genre);
            }
            game.appendChild(game_photo_link);
            game.appendChild(title);
            game.appendChild(description);
            game.appendChild(last);

            main.appendChild(game);
        }
    }
}