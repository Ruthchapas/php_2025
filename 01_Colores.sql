CREATE DATABASE IF NOT EXISTS colores;
USE colores;

CREATE TABLE colores (
id_color INT auto_increment not null primary key,
color varchar(15) not null,
usuario varchar(15) not null
);

INSERT INTO colores(color, usuario) VALUES ("green", "Son Goku"), ("Blue", "Bulma");
SELECT * FROM colores;




CREATE TABLE usuarios (
id_usuario int NOT NULL auto_increment primary key,
usuario VARCHAR(50) not null,
email varchar(100),
telefono varchar(13),
password varchar(255) NOT NULL
);
CREATE USER colores @'%' IDENTIFIED BY 'colores';
GRANT ALL PRIVILEGES ON colores.* TO colores@'%' WITH GRANT OPTION;
SELECT * FROM usuarios;

DESCRIBE colores;

CREATE TABLE if not exists temporal (
id_temporal INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
usuario VARCHAR(50) not null,
email varchar(100),
telefono varchar(13),
password varchar(255),
token_registro varchar(128), 
token_caducidad datetime

);
SELECT * FROM temporal;
SELECT * FROM usuarios;