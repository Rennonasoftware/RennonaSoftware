SELECT u.cedula, u.estado, r.nombre_rol 
FROM usuarios u
LEFT JOIN usuario_rol ur ON u.cedula = ur.cedula
LEFT JOIN roles r ON ur.id_rol = r.id_rol
WHERE u.cedula = '33333333';