<?php
session_start();
require_once '../modelo/AccesoDatosUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cedulaInput   = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_NUMBER_INT);
    $passwordInput = $_POST['password'] ?? '';

    if (empty($cedulaInput) || empty($passwordInput)) {
        header("Location: ../vista/index.php?error=campos_vacios");
        exit();
    }

    $accesoDatos = new AccesoDatosUsuario();
    $usuario     = $accesoDatos->obtenerPorCedula($cedulaInput);

    if ($usuario && password_verify($passwordInput, $usuario->getPassword())) {

        // Validar si el usuario está activo
        if (!$usuario->estaActivo()) {
            header("Location: ../vista/index.php?error=inactive_user");
            exit();
        }

        // Obtenemos el ARRAY de roles (ej: ['docente', 'tecnico'])
        $roles = $usuario->getRoles();

        // Validar si el usuario no tiene roles habilitados
        if (empty($roles)) {
            header("Location: ../vista/index.php?error=no_roles");
            exit();
        }

        $_SESSION['cedula'] = $usuario->getCedula();
        $_SESSION['roles']  = $roles; // Esto hará que tu verificarsesion.php funcione perfecto

        // Redirección por jerarquía (Admin > Técnico > Docente)
        if (in_array('administrador', $roles) || in_array('admin', $roles)) {
            header("Location: ../vista/inicioadm.php");
        } elseif (in_array('tecnico', $roles)) {
            header("Location: ../vista/iniciotec.php");
        } else {
            header("Location: ../vista/iniciodoc.php");
        }
        exit();

    } else {
        header("Location: ../vista/index.php?error=credenciales_invalidas");
        exit();
    }

} else {
    header("Location: ../vista/index.php");
    exit();
}
?>