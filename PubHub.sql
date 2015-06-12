-- Hana Glasser and Abby Olivier
-- PubHub.sql

USE hglasser_db;


drop table if exists staff;
drop table if exists userpass;
drop table if exists students;
drop table if exists weekend;
drop table if exists closing;


create table staff (
       staffID integer auto_increment not null primary key, 
       staff_name varchar(50),
       username char(20),
       password char(20),
       manager_status boolean
       );
       
create table students (
	bnumber int primary key,
	studentname varchar(50),
	birth date 
);

create table weekend (
	wid int not null,
	early_friday boolean,
	late_friday boolean,
	early_saturday boolean,
	late_saturday boolean,
	last_update date,
    foreign key (wid) references staff (staffID)
);

create table closing (
	cid int not null,
	shiftdate date,
	start_money double,
	end_money double,
	chalkboard boolean,
	dishes boolean,
	safe boolean,
	sound_system boolean,
	co2 boolean,
	dishwasher boolean,
	surfaces boolean,
	furniture boolean,
	cooler double,
	pH double,
	sinks boolean,
	soda_dispenser boolean,
	bottles boolean,
	recycle boolean,
	locks boolean,
	lights boolean,
	foreign key (cid) references staff (staffID)
);
     
insert into staff(staffID,staff_name,username, password, manager_status) values
	(1,'Kaitlin','user1','hi',1),
	(2,'Olivia','user2','hi',1),
	(3,'Hana','user3','hi',1),
	(4,'Abi','user4','hi',0),
	(5,'Alice','user5','hi',1),
	(6,'Gesang','user6','hi',0),
	(7,'Eli','user7','hi',0),
	(8,'Ace','user8','hi',0),
	(9,'Lucy','user9','hi',1),
	(10,'Tya','user10','hi',0),
	(11,'Annie','user11','hi',0);


insert into weekend (wid,early_friday, late_friday, early_saturday, late_saturday, last_update) values
	(1,0,0,0,0,'2014-05-08'),
	(2,0,0,0,0,'2014-05-08'),
	(3,0,0,0,0,'2014-05-08'),
	(4,0,0,0,0,'2014-05-08'),
	(5,0,0,0,0,'2014-05-08'),
	(6,0,0,0,0,'2014-05-08'),
	(7,0,0,0,0,'2014-05-01'),
	(8,0,0,0,0,'2014-05-08'),
	(9,0,0,0,0,'2014-05-08'),
	(10,0,0,0,0,'2014-05-08'),
	(11,0,0,0,0,'2014-05-08');
	



	
	
	
	
