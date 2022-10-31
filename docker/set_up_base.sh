#!/bin/bash

service mysql start
mysql -uroot -e "CREATE SCHEMA AirLuxDB; CREATE TABLE AirLuxDB.captor (uid binary(16) NOT NULL, client_id binary(16) NOT NULL, name VARCHAR(255) NOT NULL, value_int INT, value_bool TINYINT, UNIQUE INDEX id_UNIQUE (uid ASC));"