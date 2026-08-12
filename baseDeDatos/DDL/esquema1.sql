CREATE DATABASE IF NOT EXISTS sgrsi_db;
USE sgrsi_db;

CREATE TABLE usuarios (
    cedula VARCHAR(8) PRIMARY KEY,
    password_hash VARCHAR(255) NOT NULL,
    estado BOOLEAN DEFAULT 1
);

CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE usuario_rol (
    cedula VARCHAR(8),
    id_rol INT,
    PRIMARY KEY (cedula, id_rol),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula) ON DELETE CASCADE,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol) ON DELETE CASCADE
);