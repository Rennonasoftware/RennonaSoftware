<?php
session_start();

if (!isset($_SESSION['cedula'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['roles']) || (!in_array('administrador', $_SESSION['roles']) && !in_array('admin', $_SESSION['roles']))) {
    header("Location: index.php?error=no_autorizado");
    exit();
}

require_once '../app/vista/admusu.php';
?>