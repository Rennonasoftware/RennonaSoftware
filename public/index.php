
<?php

session_start();
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'administrador') {
        header("Location: administrador.php");
    } else {
        header("Location: logistica.php");
    }
    exit();
}
require_once '../app/vista/login.php';
?>