<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
require_once '../app/vista/inicioadm.php';
?>