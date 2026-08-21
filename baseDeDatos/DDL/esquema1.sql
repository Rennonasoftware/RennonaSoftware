CREATE DATABASE IF NOT EXISTS sgrsi_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sgrsi_db;


DROP TABLE IF EXISTS solicitudes_aula;
DROP TABLE IF EXISTS reportes;
DROP TABLE IF EXISTS usuario_rol;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS usuarios;


CREATE TABLE usuarios (
    cedula VARCHAR(8) PRIMARY KEY,
    password_hash VARCHAR(255) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1
);


CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE usuario_rol (
    cedula VARCHAR(8) NOT NULL,
    id_rol INT NOT NULL,

    PRIMARY KEY (cedula, id_rol),

    FOREIGN KEY (cedula)
        REFERENCES usuarios(cedula)
        ON DELETE CASCADE,

    FOREIGN KEY (id_rol)
        REFERENCES roles(id_rol)
        ON DELETE CASCADE
);


CREATE TABLE reportes (
    id_reporte INT AUTO_INCREMENT PRIMARY KEY,

    cedula_docente VARCHAR(8) NOT NULL,

    aula VARCHAR(100) NOT NULL,
    turno VARCHAR(30) NOT NULL,
    grupo VARCHAR(30) NOT NULL,

    computadora VARCHAR(50) NOT NULL,

    origen_dispositivo VARCHAR(50) NOT NULL,

    falla TEXT NOT NULL,

    estado ENUM(
        'Pendiente',
        'En Proceso',
        'Resuelto'
    ) NOT NULL DEFAULT 'Pendiente',

    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    asignado_a VARCHAR(8) NULL,

    observaciones TEXT NULL,

    FOREIGN KEY (cedula_docente)
        REFERENCES usuarios(cedula),

    FOREIGN KEY (asignado_a)
        REFERENCES usuarios(cedula)
        ON DELETE SET NULL
);


CREATE TABLE solicitudes_aula (
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,

    cedula_docente VARCHAR(8) NOT NULL,

    aula VARCHAR(100) NOT NULL,

    fecha_reserva DATE NOT NULL,

    turno VARCHAR(30) NOT NULL,

    grupo VARCHAR(30) NOT NULL,

    software VARCHAR(255) NOT NULL,

    detalles_software TEXT NOT NULL,

    estado ENUM(
        'Pendiente',
        'Aprobada',
        'Rechazada'
    ) NOT NULL DEFAULT 'Pendiente',

    fecha_solicitud DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (cedula_docente)
        REFERENCES usuarios(cedula)
        ON DELETE CASCADE
);