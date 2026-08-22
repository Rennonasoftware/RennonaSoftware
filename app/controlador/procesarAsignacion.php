<?php
session_start();
require_once __DIR__ . '/../modelo/AccesosDatoReporte.php';

/**
 * @brief Controlador que procesa la auto-asignación de un ticket por parte de un técnico.
 */

// Validar que el usuario sea un técnico y la petición sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['roles']) && in_array('tecnico', $_SESSION['roles'], true)) {
    
    $idReporte = (int) ($_POST['id_reporte'] ?? 0);
    $cedulaTecnico = $_SESSION['cedula'];

    // Solo se intenta actualizar cuando llegó un identificador válido.
    if ($idReporte) {
        $acceso = new AccesoDatosReporte();
        // NOTA: Debes agregar el método 'asignarTicket' en tu clase AccesoDatosReporte
        // que haga un UPDATE Reportes SET estado='En Proceso', asignado_a=cedula WHERE id_reporte=id
        $acceso->asignarTicket($idReporte, $cedulaTecnico);
    }
}

// Redireccionamiento seguro de vuelta al panel
header('Location: /RennonaSoftware/public/iniciotec.php');
exit();
?>