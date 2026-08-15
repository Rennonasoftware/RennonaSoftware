<?php
require_once 'ConectorPDO.php';

/**
 * @class AccesoDatosReporte
 * @brief Gestiona las operaciones de persistencia (DML/DQL) de los reportes.
 */
class AccesoDatosReporte {
    /**
     * @var PDO Objeto de conexión a la base de datos.
     */
    private $conexion;

    /**
     * @brief Constructor que inicializa la conexión PDO.
     */
    public function __construct() {
        $conector = new ConectorPDO();
        $this->conexion = $conector->conectar();
    }

    /**
     * @brief Obtiene los reportes que están pendientes o en proceso asignados al técnico actual.
     * @param string $cedulaTecnico Cédula del técnico con sesión iniciada.
     * @return array Arreglo asociativo con los registros encontrados.
     */
    public function obtenerReportesParaTecnico($cedulaTecnico) {
        try {
            // DQL: Trae los pendientes globales y los que este técnico ya se auto-asignó
            $sql = "SELECT id_reporte, aula, falla, origen_dispositivo, estado, fecha 
                    FROM Reportes 
                    WHERE estado = 'Pendiente' 
                       OR (estado = 'En Proceso' AND asignado_a = :cedula)
                    ORDER BY fecha DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':cedula', $cedulaTecnico);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener reportes: " . $e->getMessage());
            return [];
        }
    }
}
?>