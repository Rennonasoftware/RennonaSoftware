<?php
session_start();
if (!isset($_SESSION['cedula'])) {
    header("Location: ../../public/index.php?error=no_sesion");
    exit();
}

function tieneRol($rolBuscado) {
    return isset($_SESSION['roles']) && in_array($rolBuscado, $_SESSION['roles']);
}
?>