<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../modelo/AccesoDatosUsuario.php';

if (!isset($_SESSION['roles']) ||
    !in_array('administrador', $_SESSION['roles'])) {

    http_response_code(403);

    echo json_encode([
        'status' => 'error',
        'message' => 'No autorizado.'
    ]);

    exit();
}

$data = json_decode(
    file_get_contents('php://input'),
    true
);

if (
    !isset($data['cedula']) ||
    !isset($data['password']) ||
    !isset($data['rol'])
) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Faltan datos.'
    ]);

    exit();
}

$cedula = trim($data['cedula']);
$password = $data['password'];
$rol = $data['rol'];

$rolesPermitidos = [
    'Administrador',
    'Logistica',
    'Docente'
];

if (!in_array($rol, $rolesPermitidos, true)) {

    echo json_encode([
        'status' => 'error',
        'message' => 'Rol inválido.'
    ]);

    exit();
}

if (!preg_match('/^[1-9][0-9]{7}$/', $cedula)) {

    echo json_encode([
        'status' => 'error',
        'message' => 'La cédula debe tener 8 dígitos.'
    ]);

    exit();
}

if (strlen($password) < 12) {

    echo json_encode([
        'status' => 'error',
        'message' => 'La contraseña debe tener al menos 12 caracteres.'
    ]);

    exit();
}

try {

    $modelo = new AccesoDatosUsuario();

    $exito = $modelo->crearUsuario(
        $cedula,
        $password,
        $rol
    );

    echo json_encode([
        'status' => $exito ? 'success' : 'error',
        'message' => $exito
            ? 'Usuario creado correctamente.'
            : 'No se pudo crear el usuario.'
    ]);

} catch (Exception $e) {

    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'message' => 'Error interno del servidor.'
    ]);
}
