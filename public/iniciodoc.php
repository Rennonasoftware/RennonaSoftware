<?php
require_once '../app/controlador/verificarsesion.php';

if (!isset($_SESSION['cedula'])) {
    header("Location: index.php?error=no_autorizado");
    exit();
}

require_once '../app/vista/iniciodoc.php';
?>