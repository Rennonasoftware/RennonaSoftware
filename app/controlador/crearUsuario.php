<?php

session_start();

header('Content-Type: text/plain; charset=utf-8');

require_once __DIR__ . '/../modelo/AccesoDatosUsuario.php';

if (!isset($_SESSION['roles']) ||
    !in_array('administrador', $_SESSION['roles'])) {

    http_response_code(403);

    echo 'No autorizado.';
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
    http_response_code(400);
    echo 'Faltan datos.';
    exit();
}

$cedula = trim($data['cedula']);
$password = $data['password'];
$rol = $data['rol'];

$rolesPermitidos = [
    'Administrador',
    'Tecnico',
    'Docente'
];

if (!in_array($rol, $rolesPermitidos, true)) {

    http_response_code(400);
    echo 'Rol inválido.';
    exit();
}

if (!preg_match('/^[1-9][0-9]{7}$/', $cedula)) {

    http_response_code(400);
    echo 'La cédula debe tener 8 dígitos.';
    exit();
}

if (strlen($password) < 7) {

    http_response_code(400);
    echo 'La contraseña debe tener al menos 7 caracteres.';
    exit();
}

try {

    $modelo = new AccesoDatosUsuario();

    $exito = $modelo->crearUsuario(
        $cedula,
        $password,
        $rol
    );

    if (!$exito) {
        http_response_code(400);
    }
    echo $exito ? 'Usuario creado correctamente.' : 'No se pudo crear el usuario.';

} catch (Exception $e) {

    http_response_code(500);

    echo 'Error interno del servidor.';
}
