<?php
session_start();
require_once '../modelo/AccesoDatosReporte.php';

/**
 * @brief Controlador que procesa la resolución (cierre) de un ticket.
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['rol']) && $_SESSION['rol'] === 'tecnico') {
    
    $idReporte = filter_input(INPUT_POST, 'id_reporte', FILTER_SANITIZE_NUMBER_INT);
    // Sanitizamos el campo opcional de forma compatible con PHP 8.1+
    $observacionesRaw = filter_input(INPUT_POST, 'observaciones', FILTER_UNSAFE_RAW);
    $observaciones = $observacionesRaw !== null && $observacionesRaw !== false ? trim(strip_tags($observacionesRaw)) : '';

    if ($idReporte !== null && $idReporte !== false && $idReporte !== '') {
        $acceso = new AccesoDatosReporte();
        // NOTA: Debes agregar el método 'resolverTicket' en tu clase AccesoDatosReporte
        // que haga un UPDATE Reportes SET estado='Resuelto', notas=$observaciones WHERE id_reporte=id
        $acceso->resolverTicket($idReporte, $observaciones);
    }
}

header('Location: ../vista/iniciotec.php');
exit();
?>