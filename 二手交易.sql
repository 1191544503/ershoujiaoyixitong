 create table usermin(
	username char(20) not null,
	password char(100) not null,
	email char(100) not null,
	administrator int(11),
	isactivation int(11)
);

create table store(
  id int AUTO_INCREMENT PRIMARY key NOT NULL,
	username char(100) not null,
	goodsname char(100) not null,
	introduce char(100),
	price char(30) not null,
	phone char(100) not null,
	image char(100),
	create_time date
);

create table notice(
	username char(30) not null,
	noticetext char(100)
);

create table shopcart(
  username char(20) not null,
  id int not null,
  isdelete int
);
create table goodsorder(
	id int AUTO_INCREMENT PRIMARY key NOT NULL,
	goodsid int,
	seller char(100),
	buyers char(100),
	orderstate int
);
