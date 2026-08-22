<?php

require_once '../app/controlador/verificarsesion.php';
require_once '../app/modelo/AccesosDatoReporte.php';


if (!tieneRol('tecnico')) {
    header("Location: index.php?error=no_autorizado");
    exit();
}
$accesoReportes = new AccesoDatosReporte();
$listaReportes = $accesoReportes->obtenerReportesParaTecnico($_SESSION['cedula']);
require_once '../app/vista/iniciotec.php';
?>