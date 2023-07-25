CREATE DATABASE codeconnect;

USE CodeConnect;
create table User(
uid int,
Name varchar(255),
Email varchar(55),
PhoneNumber int,
Address varchar(255),
password varchar(55),
github_link varchar(30),
date_of_birth date,
Primary key (uid)
);

select * from User;

create table connection(
connection_uid int,
uid int,
primary key (connection_uid),
foreign key (uid) references User(uid)
);

create table connection_sent(
from_uid int ,
to_uid int unique,
foreign key(from_uid) references User(uid)
);

create table Discussion(
discussion_id int primary key,
uid int,
code_post text,
description_post text,
foreign key(uid) references User(uid)
);

create table Geek(
discussion_id int ,
geeker_uid int,
foreign key(discussion_id) references Discussion(discussion_id)
);

create table Comments(
discussion_id int ,
uid int,
comment_content text,
foreign key(discussion_id) references Discussion(discussion_id),
foreign key(uid) references User(uid)
)
