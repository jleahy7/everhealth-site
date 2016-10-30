DROP DATABASE IF EXISTS everhealth;
CREATE DATABASE IF NOT EXISTS everhealth;

USE everhealth;

drop table if exists deatil;
create table if not exists detail(
	detail_ID int not null auto_increment,
    vendor varchar(50),
    sku varchar(30),
    equipment_name varchar(30),
    description varchar(240),
    price dec,
    quantity int,
    total double,
    primary key (detail_ID)
);

drop table if exists invoices;
create table if not exists invoices(
	invoice_ID int not null auto_increment,
    detail_ID int not null,
    invoice_date date,
    bill_to varchar(50),
    billing_address varchar(50) not null,
    billing_city varchar(30) not null,
    billing_state char(2) not null,
    billing_zip int, 
    ship_to varchar(50),
    ship_to_address varchar(50) not null,
    ship_to_city varchar(30) not null,
    ship_to_state char(2) not null,
    ship_to_zip int not null,
    primary key (invoice_ID),
    foreign key (detail_ID) references detail(detail_ID)
);

drop table if exists location;
CREATE TABLE if not exists location (
    location_ID INT NOT NULL AUTO_INCREMENT,
    location_type varchar(30) not null,
    address varchar(50) not null,
    city varchar(30) not null,
    state char(2) not null,
    zip int not null,    
    PRIMARY KEY (location_ID)
);

drop table if exists payment;
CREATE TABLE if not exists payment(
	payment_ID int not null auto_increment,
    location_ID int,
    payment_type varchar(20) not null, 
    card_number char(16),
    expiration_date date,
    cvv char(3),
    card_holder varchar(35),
    primary key(payment_ID),
    foreign key(location_ID) references location(location_ID)
);

drop table if exists membership;
CREATE TABLE if not exists membership (
    membership_ID INT NOT NULL AUTO_INCREMENT,
    payment_ID int not null,
    plan enum('bronze', 'silver', 'gold'),
    rate dec not null,
	primary key (membership_ID),
    foreign key (payment_ID) references payment(payment_ID)
);

drop table if exists inventory;
create table if not exists inventory(
	iventory_ID int not null auto_increment,
    location_ID int not null,
    invoice_ID int not null,
    item_name varchar(30) not null,
    model_no varchar(30),
    date_of_purchase date,
    item_condition enum('new', 'excellent', 'very good', 'good', 'fair', 'bad', 'needs-replaced'),
    note varchar(240),
    primary key (iventory_ID),
    foreign key (location_ID) references location(location_ID),
    foreign key (invoice_ID) references invoices(invoice_ID)
);

drop table if exists employees;
CREATE TABLE if not exists employees (
    employee_ID INT NOT NULL AUTO_INCREMENT,
    location_ID int	not null,
    title varchar(30) not null,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    birth_date date not null,
    gender ENUM ('M','F') not null,    
    hire_date date not null,
    social_security char(11) not null,
    PRIMARY KEY (employee_ID),
    FOREIGN KEY (location_ID) references location(location_ID)
);

drop table if exists customer;
CREATE TABLE if not exists customer (
    customer_ID INT NOT NULL AUTO_INCREMENT,
    location_ID int	not null,
    membership_ID int	not null,
    title varchar(30) not null,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    gender ENUM ('M','F') not null,    
    phone varchar(15) not null,
    email varchar(50) not null,
    PRIMARY KEY (customer_ID),
    FOREIGN KEY (location_ID) references location(location_ID),
    FOREIGN KEY (membership_ID) references membership(membership_ID)
);