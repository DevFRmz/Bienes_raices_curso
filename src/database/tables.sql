CREATE DATABASE IF NOT EXISTS bienesraices_app;

USE bienesraices_app;

CREATE TABLE vendedores(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45),
    apellido VARCHAR(45),
    telefono VARCHAR(10) UNIQUE
);

CREATE TABLE propiedades(
    id int(11) AUTO_INCREMENT PRIMARY KEY,
    vendedor_id INT(11) NOT NULL,
    titulo VARCHAR(45),
    precio DECIMAL(10, 2),
    imagen VARCHAR(200),
    descripcion LONGTEXT,
    habitaciones INT(1),
    wc INT(1),
    estacionamiento INT(1),
    creado DATE,

    FOREIGN KEY (vendedor_id) REFERENCES vendedores(id) ON DELETE CASCADE
);

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password CHAR(60) NOT NULL
);
