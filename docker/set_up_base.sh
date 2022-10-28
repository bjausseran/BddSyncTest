#!/bin/bash

service mysql start
#mysql -u root -e "create database testdb"; 
GRANT ALL PRIVILEGES ON *.* TO root@localhost:3306 IDENTIFIED BY password;
#\q
mysql -u root -ppassword
CREATE SCHEMA MYSQL_DATABASE; CREATE TABLE MYSQL_DATABASE.captor (uid binary(16) NOT NULL, client_id binary(16) NOT NULL, name VARCHAR(255) NOT NULL, value_int INT, value_bool TINYINT, UNIQUE INDEX id_UNIQUE (uid ASC));
