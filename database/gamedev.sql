drop database gamedc;
create database gamedc;
use gamedc;

create table Users
(
user_id int auto_increment primary key,
user_login varchar(30) not null,
user_password varchar(20) not null,
user_mail varchar(30)
);

#ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password'