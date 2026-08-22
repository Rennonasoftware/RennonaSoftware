<?php
session_start();
require_once __DIR__ . '/../modelo/AccesosDatoReporte.php';

/**
 * @brief Controlador que procesa la resolución (cierre) de un ticket.
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['roles']) && in_array('tecnico', $_SESSION['roles'], true)) {
    
    $idReporte = (int) ($_POST['id_reporte'] ?? 0);
    $observaciones = trim(strip_tags($_POST['observaciones'] ?? ''));

    // Las observaciones son opcionales, pero el reporte debe estar identificado.
    if ($idReporte !== null && $idReporte !== false && $idReporte !== '') {
        $acceso = new AccesoDatosReporte();
        // NOTA: Debes agregar el método 'resolverTicket' en tu clase AccesoDatosReporte
        // que haga un UPDATE Reportes SET estado='Resuelto', notas=$observaciones WHERE id_reporte=id
        $acceso->resolverTicket($idReporte, $observaciones);
    }
}

header('Location: /RennonaSoftware/public/iniciotec.php');
exit();
?>