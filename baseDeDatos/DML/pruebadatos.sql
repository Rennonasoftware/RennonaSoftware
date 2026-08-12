USE sgrsi_db;

INSERT INTO roles (nombre_rol) VALUES ('Administrador'), ('Logistica'), ('Docente');

INSERT INTO usuarios (cedula, password_hash, estado) VALUES 
('11111111', '$2y$10$wY9/O5E4/K3d5M.v0YFmEuL6uVz3V9g.qP.p/Q.sY7y4q3G6c/SgS', 1), -- Admin
('22222222', '$2y$10$wY9/O5E4/K3d5M.v0YFmEuL6uVz3V9g.qP.p/Q.sY7y4q3G6c/SgS', 1), -- Logistica (Soporte)
('33333333', '$2y$10$wY9/O5E4/K3d5M.v0YFmEuL6uVz3V9g.qP.p/Q.sY7y4q3G6c/SgS', 1), -- Elvis (Admin + Logística)
('44444444', '$2y$10$wY9/O5E4/K3d5M.v0YFmEuL6uVz3V9g.qP.p/Q.sY7y4q3G6c/SgS', 1), -- Docente
('55555555', '$2y$10$wY9/O5E4/K3d5M.v0YFmEuL6uVz3V9g.qP.p/Q.sY7y4q3G6c/SgS', 0); -- Inactivo


INSERT INTO usuario_rol (cedula, id_rol) VALUES 
('11111111', 1),
('22222222', 2),
('33333333', 1), ('33333333', 2), -- Doble rol
('44444444', 3);