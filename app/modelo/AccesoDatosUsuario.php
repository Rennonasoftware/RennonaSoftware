<?php
require_once 'ConectorPDO.php';
require_once 'Usuario.php';

class AccesoDatosUsuario {
    private $conexion;

    public function __construct() {
        try {
            $conector = new ConectorPDO();
            $this->conexion = $conector->conectar();
        } catch (Exception $e) {
            error_log("Error de conexión: " . $e->getMessage());
            $this->conexion = null;
        }
    }

    public function obtenerTodosLosUsuarios() {
        $sql = "SELECT u.cedula, GROUP_CONCAT(r.nombre_rol) AS roles 
                FROM usuarios u
                LEFT JOIN usuario_rol ur ON u.cedula = ur.cedula
                LEFT JOIN roles r ON ur.id_rol = r.id_rol
                WHERE u.estado = 1 GROUP BY u.cedula";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($cedula, $password, $rol) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (cedula, password_hash, estado) VALUES (:cedula, :pass, 1)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':cedula' => $cedula, ':pass' => $hash]);
    }

    public function eliminarUsuario($cedula) {
        $sql = "UPDATE usuarios SET estado = 0 WHERE cedula = :cedula";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':cedula' => $cedula]);
    }

    public function modificarUsuario($cedula, $password, $rol) {
        $sql = "UPDATE usuarios SET password_hash = :pass WHERE cedula = :cedula";
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $stmt = $this->conexion->prepare($sql)->execute([':cedula' => $cedula, ':pass' => $hash]);
    }
}

