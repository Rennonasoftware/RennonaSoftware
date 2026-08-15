<?php
session_start();
require_once '../modelo/AccesoDatosReporte.php';

/**
 * @brief Controlador que procesa la auto-asignación de un ticket por parte de un técnico.
 */

// Validar que el usuario sea un técnico y la petición sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['rol']) && $_SESSION['rol'] === 'tecnico') {
    
    $idReporte = filter_input(INPUT_POST, 'id_reporte', FILTER_SANITIZE_NUMBER_INT);
    $cedulaTecnico = $_SESSION['cedula'];

    if ($idReporte) {
        $acceso = new AccesoDatosReporte();
        // NOTA: Debes agregar el método 'asignarTicket' en tu clase AccesoDatosReporte
        // que haga un UPDATE Reportes SET estado='En Proceso', asignado_a=cedula WHERE id_reporte=id
        $acceso->asignarTicket($idReporte, $cedulaTecnico);
    }
}

// Redireccionamiento seguro de vuelta al panel
header('Location: ../vista/iniciotec.php');
exit();
?>