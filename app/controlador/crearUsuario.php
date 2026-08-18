<?php
header('Content-Type: application/json');
require_once '../modelos/AccesoDatosUsuario.php';
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cedula'], $data['password'], $data['rol'])) {
    $modelo = new AccesoDatosUsuario();
    $exito = $modelo->crearUsuario($data['cedula'], $data['password'], $data['rol']);
    echo json_encode(['status' => $exito ? 'success' : 'error']);
}
