<?php
session_start();

require_once __DIR__ . '/../modelo/AccesoDatosSolicitud.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['cedula'])) {
	header('Location: /RennonaSoftware/public/index.php?error=no_sesion');
	exit();
}

$datos = [
	'aula' => trim($_POST['Laboratorio'] ?? ''),
	'fecha' => trim($_POST['Fecha'] ?? ''),
	'turno' => trim($_POST['Turno'] ?? ''),
	'grupo' => trim($_POST['Grupo'] ?? ''),
	'software' => trim($_POST['Software'] ?? ''),
	'detalles' => trim($_POST['DetallesSoftware'] ?? '')
];

// Se rechaza la solicitud completa si falta cualquiera de sus datos obligatorios.
if (in_array('', $datos, true)) {
	header('Location: /RennonaSoftware/public/solicitudaula.php?error=datos_invalidos');
	exit();
}

$modelo = new AccesoDatosSolicitud();
$guardado = $modelo->crearSolicitud(
	$_SESSION['cedula'],
	$datos['aula'],
	$datos['fecha'],
	$datos['turno'],
	$datos['grupo'],
	$datos['software'],
	$datos['detalles']
);

header('Location: /RennonaSoftware/public/solicitudaula.php?mensaje=' . ($guardado ? 'solicitud_guardada' : 'error_guardar'));
exit();
