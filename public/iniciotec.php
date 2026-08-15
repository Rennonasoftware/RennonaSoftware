<?php

require_once '../app/controlador/verificar_sesion.php';

if (!tieneRol('Tecnico')) {

    header("Location: ../../public/index.php?error=no_autorizado");
    exit();
}

require_once '../app/vista/iniciotec.php';
?>