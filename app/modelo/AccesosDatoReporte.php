<?php
require_once __DIR__ . '/ConectorPDO.php';

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
            // Trae los pendientes globales y los que este técnico ya se autoasignó.
            $sql = "SELECT id_reporte, aula, falla, origen_dispositivo, estado, fecha 
                    FROM reportes 
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

    public function crearReportes($cedulaDocente, $aula, $turno, $grupo, $computadoras, $fallas, $detalles) {
        try {
            // Cada computadora es un reporte independiente dentro de una misma transacción.
            $this->conexion->beginTransaction();
            $sql = "INSERT INTO reportes
                    (cedula_docente, aula, turno, grupo, computadora, origen_dispositivo, falla)
                    VALUES (:cedula, :aula, :turno, :grupo, :computadora, :origen, :falla)";
            $stmt = $this->conexion->prepare($sql);

            foreach ($computadoras as $indice => $computadora) {
                $stmt->execute([
                    ':cedula' => $cedulaDocente,
                    ':aula' => $aula,
                    ':turno' => $turno,
                    ':grupo' => $grupo,
                    ':computadora' => trim($computadora),
                    ':origen' => trim($fallas[$indice]),
                    ':falla' => trim($detalles[$indice])
                ]);
            }

            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }
            error_log("Error al crear reportes: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerReportesParaDocente($cedulaDocente) {
        // El filtro por cédula evita que un docente vea reportes de otra persona.
        $sql = "SELECT id_reporte, aula, turno, grupo, computadora,
                       origen_dispositivo, falla, estado, fecha, observaciones
                FROM reportes
                WHERE cedula_docente = :cedula
                ORDER BY fecha DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':cedula' => $cedulaDocente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function asignarTicket($idReporte, $cedulaTecnico) {
        $sql = "UPDATE reportes
                SET estado = 'En Proceso', asignado_a = :cedula
                WHERE id_reporte = :id AND estado = 'Pendiente'";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':cedula' => $cedulaTecnico, ':id' => $idReporte]);
    }

    public function resolverTicket($idReporte, $observaciones) {
        $sql = "UPDATE reportes
                SET estado = 'Resuelto', observaciones = :observaciones
                WHERE id_reporte = :id AND estado = 'En Proceso'";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':observaciones' => $observaciones, ':id' => $idReporte]);
    }
}
?>