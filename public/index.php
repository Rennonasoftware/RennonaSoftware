<?php
session_start();

if (isset($_SESSION['cedula']) && isset($_SESSION['roles'])) {
    
    $roles = $_SESSION['roles'];

    if (in_array('administrador', $roles) || in_array('admin', $roles)) {
        header("Location: administrador.php");
    } elseif (in_array('tecnico', $roles)) {
        header("Location: iniciotec.php");
    } else {
        header("Location: iniciodoc.php");
    }
    exit();
}

require_once '../app/vista/login.php';
?>