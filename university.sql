 create database if not exists university;
 use university;
  CREATE TABLE user (
  Id int primary key auto_increment ,
  UserName  varchar(20),
  email varchar(50),
  Pasword varchar(100),
  roles varchar(15), 
  photo varchar(50),
  phone bigint(100)
  );
    CREATE TABLE product (
  Id int primary key auto_increment ,
  productName  varchar(20),
  price  double,
  description  text,
  photo varchar(200),
  category varchar(50),
  userid int ,
  FOREIGN KEY (userid) REFERENCES  user (Id) 
  ON delete cascade on update cascade
  );
