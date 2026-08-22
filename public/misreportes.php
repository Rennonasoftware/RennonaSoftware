<?php
require_once '../app/controlador/verificarsesion.php';
require_once '../app/modelo/AccesosDatoReporte.php';

$accesoReportes = new AccesoDatosReporte();
$listaReportes = $accesoReportes->obtenerReportesParaDocente($_SESSION['cedula']);

require_once '../app/vista/misreportes.php';
