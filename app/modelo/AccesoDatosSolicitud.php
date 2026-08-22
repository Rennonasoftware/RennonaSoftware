<?php
require_once __DIR__ . '/ConectorPDO.php';

class AccesoDatosSolicitud
{
	private PDO $conexion;

	public function __construct()
	{
		$this->conexion = (new ConectorPDO())->conectar();
	}

	public function crearSolicitud($cedulaDocente, $aula, $fecha, $turno, $grupo, $software, $detallesSoftware)
	{
		$sql = "INSERT INTO solicitudes_aula
				(cedula_docente, aula, fecha_reserva, turno, grupo, software, detalles_software)
				VALUES (:cedula, :aula, :fecha, :turno, :grupo, :software, :detalles)";
		$stmt = $this->conexion->prepare($sql);
		return $stmt->execute([
			':cedula' => $cedulaDocente,
			':aula' => $aula,
			':fecha' => $fecha,
			':turno' => $turno,
			':grupo' => $grupo,
			':software' => $software,
			':detalles' => $detallesSoftware
		]);
	}
}
