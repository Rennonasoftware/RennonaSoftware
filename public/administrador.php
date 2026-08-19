<?php
session_start();
if (!isset($_SESSION['cedula'])) {
    header("Location: index.php");
    exit();
}
require_once '../app/vista/inicioadm.php'; 
?>