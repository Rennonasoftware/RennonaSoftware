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

$cedula = trim($data['cedula'] ?? '');
$password = $data['password'] ?? '';
$rol = $data['rol'] ?? '';

if (!preg_match('/^[1-9][0-9]{7}$/', $cedula)) {

    http_response_code(400);
    echo 'Cédula inválida.';
    exit();
}

if ($password !== '' && strlen($password) < 7) {

    http_response_code(400);
    echo 'La contraseña debe tener al menos 7 caracteres.';
    exit();
}

$rolesPermitidos = [
    'Administrador',
    'Tecnico',
    'Docente'
];

if ($rol !== '' && !in_array($rol, $rolesPermitidos, true)) {

    http_response_code(400);
    echo 'Rol inválido.';
    exit();
}

try {

    $modelo = new AccesoDatosUsuario();

    $exito = $modelo->modificarUsuario(
        $cedula,
        $password,
        $rol
    );

    if (!$exito) {
        http_response_code(400);
    }
    echo $exito ? 'Usuario modificado correctamente.' : 'No se pudo modificar el usuario.';

} catch (Exception $e) {

    http_response_code(500);

    echo 'Error interno del servidor.';
}