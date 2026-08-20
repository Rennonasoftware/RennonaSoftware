<?php
session_start();

if (!isset($_SESSION['cedula'])) {
    header("Location: ../../public/index.php?error=unauthenticated");
    exit();
}

function tieneRol($rolBuscado) {
    return isset($_SESSION['roles']) && in_array($rolBuscado, $_SESSION['roles']);
}

function validarRol($rolesPermitidos) {
    $tienePermiso = false;

    foreach ($rolesPermitidos as $rol) {
        if (tieneRol($rol)) {
            $tienePermiso = true;
            break;
        }
    }

    if (!$tienePermiso) {
        header("Location: ../../public/index.php?error=unauthorized");
        exit();
    }
}
?>