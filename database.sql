create database categorys;

use categorys;

create table product(
    id int AUTO_INCREMENT PRIMARY KEY,
    description varchar(255),
    image varchar(255),
    price double
);

insert into product(description,image,price)values
('Smartfon Samsung Galaxy S24 Ultra','1.png',2234),
('Smartfon Samsung Galaxy S24 Ultra','2.png',2234),
('Smartfon Samsung Galaxy S24 Ultra','3.png',2234),
('Smartfon Samsung Galaxy S24 Ultra','4.png',2234);