
CREATE DATABASE crudnodejsmysql;


use crudnodejsmysql;

CREATE TABLE customer (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(15)
);

SHOW TABLES;

describe customer;