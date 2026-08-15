<?php

namespace App\Modelo;

use PDO;

class AccesoDatosUsuario {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = ConectorPDO::getConexion();
    }

    public function buscarPorCedula(string $cedula): ?array {
        $sql = "SELECT * FROM usuarios WHERE cedula = :cedula LIMIT 1";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':cedula' => $cedula]);
        
        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }
}