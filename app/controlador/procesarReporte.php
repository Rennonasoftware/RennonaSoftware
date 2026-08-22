<?php
session_start();

require_once __DIR__ . '/../modelo/AccesosDatoReporte.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['cedula'])) {
	header('Location: /RennonaSoftware/public/index.php?error=no_sesion');
	exit();
}

$aula = trim($_POST['Laboratorio'] ?? '');
$turno = trim($_POST['Turno'] ?? '');
$grupo = trim($_POST['Grupo'] ?? '');
$computadoras = $_POST['Computadora'] ?? [];
$fallas = $_POST['Tipo_de_Falla'] ?? [];
$detalles = $_POST['Detalles'] ?? [];

// Las tres listas deben tener la misma cantidad para relacionar cada equipo con su falla y detalle.
if ($aula === '' || $turno === '' || $grupo === '' ||
	!is_array($computadoras) || !is_array($fallas) || !is_array($detalles) ||
	count($computadoras) === 0 || count($computadoras) !== count($fallas) ||
	count($computadoras) !== count($detalles)) {
	header('Location: /RennonaSoftware/public/iniciodoc.php?error=datos_invalidos');
	exit();
}

$acceso = new AccesoDatosReporte();
$guardado = $acceso->crearReportes(
	$_SESSION['cedula'],
	$aula,
	$turno,
	$grupo,
	$computadoras,
	$fallas,
	$detalles
);

header('Location: /RennonaSoftware/public/iniciodoc.php?mensaje=' . ($guardado ? 'reporte_guardado' : 'error_guardar'));
exit();
