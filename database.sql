create database categorys;

use categorys;

create table product(
    id int AUTO_INCREMENT PRIMARY KEY,
    description varchar(255),
    image varchar(255),
    price double
);

insert into product(description,image,price)values
('Motorola RAZR V3','1.jpg',2500),
('Samsung E250','2.webp',5000),
('Apple iPhone 6','3.png',7500),
('Nokia 1100','4.jpg',10000);