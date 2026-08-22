<?php
session_start();

if (!isset($_SESSION['cedula'])) {
    header("Location: index.php?error=no_sesion");
    exit();
}

$rolesPermitidos = ['tecnico'];
$tienePermiso = false;

if (isset($_SESSION['roles']) && is_array($_SESSION['roles'])) {
    foreach ($_SESSION['roles'] as $rol) {
        if (in_array(strtolower($rol), $rolesPermitidos)) {
            $tienePermiso = true;
            break;
        }
    }
}

if (!$tienePermiso) {
    header("Location: index.php?error=no_autorizado");
    exit();
}

require_once '../app/vista/iniciotec.php';
?>