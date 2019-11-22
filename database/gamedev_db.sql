#drop database gamedc;
create database gamedc;
use gamedc;

create table users(
user_id int auto_increment primary key,
login varchar(30),
pass varchar(80),
mail varchar(30)
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

select * from users;

-- create table messages(
-- user_id int,
-- message_text varchar(1000)
-- );