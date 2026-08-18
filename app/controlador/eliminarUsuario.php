<?php
header('Content-Type: application/json');
require_once '../modelos/AccesoDatosUsuario.php';
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cedula'])) {
    $modelo = new AccesoDatosUsuario();
    $exito = $modelo->eliminarUsuario($data['cedula']);
    echo json_encode(['status' => $exito ? 'success' : 'error']);
}