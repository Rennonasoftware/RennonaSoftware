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

$cedula = trim($data['cedula'] ?? '');
$password = $data['password'] ?? '';
$rol = $data['rol'] ?? '';

if (!preg_match('/^[1-9][0-9]{7}$/', $cedula)) {

    echo json_encode([
        'status' => 'error',
        'message' => 'Cédula inválida.'
    ]);

    exit();
}

if ($password !== '' && strlen($password) < 12) {

    echo json_encode([
        'status' => 'error',
        'message' => 'La contraseña debe tener al menos 12 caracteres.'
    ]);

    exit();
}

$rolesPermitidos = [
    'Administrador',
    'Logistica',
    'Docente'
];

if ($rol !== '' && !in_array($rol, $rolesPermitidos, true)) {

    echo json_encode([
        'status' => 'error',
        'message' => 'Rol inválido.'
    ]);

    exit();
}

try {

    $modelo = new AccesoDatosUsuario();

    $exito = $modelo->modificarUsuario(
        $cedula,
        $password,
        $rol
    );

    echo json_encode([
        'status' => $exito ? 'success' : 'error',
        'message' => $exito
            ? 'Usuario modificado correctamente.'
            : 'No se pudo modificar el usuario.'
    ]);

} catch (Exception $e) {

    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'message' => 'Error interno del servidor.'
    ]);
}