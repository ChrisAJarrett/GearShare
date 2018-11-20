/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  goobe
 * Created: Nov 14, 2018
 */

CREATE TABLE users (
    username varchar(30) NOT NULL,
    email varchar(50) NOT NULL,
    access_level varchar(20) DEFAULT 'user' NOT NULL,
    first_name varchar(20) NOT NULL,
    last_name varchar(20) NOT NULL,
    pw varchar(25) NOT NULL,
    user_ID int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(user_ID)
);


CREATE TABLE gear_category (
    category_ID int(2) NOT NULL AUTO_INCREMENT,
    name varchar(30) NOT NULL,
    size_matters int(1) NOT NULL DEFAULT '0',
    PRIMARY KEY(category_ID)
);

CREATE TABLE gear (
    item_name varchar(50) NOT NULL,
    post_date TIMESTAMP,
    photo LONGBLOB NOT NULL,
    description varchar(254),
    owner_ID int(11) NOT NULL,
    gear_ID int(11) NOT NULL AUTO_INCREMENT,
    category int(2) NOT NULL,
    gear_size varchar(15),
    available int(1) DEFAULT 1,
    PRIMARY KEY(gear_ID),
    CONSTRAINT  
    FOREIGN KEY(owner_ID) REFERENCES users(user_ID),
    FOREIGN KEY(category) REFERENCES gear_category(category_ID)
);