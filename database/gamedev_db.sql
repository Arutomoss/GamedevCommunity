#drop database gamedc;
create database gamedc;
use gamedc;

create table users(
user_id int auto_increment primary key,
user_login varchar(30),
user_pass varchar(80),
user_mail varchar(30),
user_chat_id int
);

create table events(
event_id int auto_increment primary key,
user_id int,
	foreign key (user_id) references users (user_id) on delete cascade on update cascade,
event_name varchar(30),
event_info varchar(1000),
event_date_start datetime,
event_date_end datetime
);

create table events_photo(
photo_id int auto_increment primary key,
event_id int,
	foreign key (event_id) references events (event_id) on delete cascade on update cascade,
link_photo varchar(200)
);

create table messages(
message_id int auto_increment primary key,
user_id int,
	foreign key (user_id) references users (user_id) on delete cascade on update cascade,
message_text varchar(1000)
);

create table chat(
chat_id int auto_increment primary key,
user_id int,
	foreign key (user_id) references users (user_id) on delete cascade on update cascade,
message_id int,
	foreign key (message_id) references messages (message_id) on delete cascade on update cascade
);

select * from events;

-- create table messages(
-- user_id int,
-- message_text varchar(1000)
-- );