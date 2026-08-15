<?php
require_once 'ConectorPDO.php';
require_once 'Usuario.php';

class AccesoDatosUsuario {
    private $conexion;

    public function __construct() {
        $conector = new ConectorPDO();
        $this->conexion = $conector->conectar();
    }

    public function obtenerPorCedula($cedula) {
        try {
            // Usamos GROUP_CONCAT para traer todos los roles del usuario en una sola fila
            $sql = "SELECT u.cedula, u.password_hash AS password, GROUP_CONCAT(LOWER(r.nombre_rol)) AS roles_asignados 
                    FROM usuarios u
                    LEFT JOIN usuario_rol ur ON u.cedula = ur.cedula
                    LEFT JOIN roles r ON ur.id_rol = r.id_rol
                    WHERE u.cedula = :cedula AND u.estado = 1
                    GROUP BY u.cedula";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
            $stmt->execute();

            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($fila) {
                // Convertimos el string "docente,tecnico" a un array ['docente', 'tecnico']
                $arregloRoles = $fila['roles_asignados'] ? explode(',', $fila['roles_asignados']) : ['docente'];

                return new Usuario(
                    $fila['cedula'],
                    '', 
                    '', 
                    $fila['password'], 
                    $arregloRoles // Pasamos el array al objeto
                );
            }

            return null;
        } catch (PDOException $e) {
            error_log("Error al obtener usuario: " . $e->getMessage());
            return null;
        }
    }
}
?>