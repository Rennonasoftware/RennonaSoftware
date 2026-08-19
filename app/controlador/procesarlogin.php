<?php
session_start();
require_once '../modelo/AccesoDatosUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cedulaInput   = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_NUMBER_INT);
    $passwordInput = $_POST['password'] ?? '';

    if (empty($cedulaInput) || empty($passwordInput)) {
        header("Location: /public/index.php?error=campos_vacios");
        exit();
    }

    $accesoDatos = new AccesoDatosUsuario();
    $usuario     = $accesoDatos->obtenerPorCedula($cedulaInput);

    if ($usuario && password_verify($passwordInput, $usuario->getPassword())) {

        $roles = $usuario->getRoles();

        $_SESSION['cedula'] = $usuario->getCedula();
        $_SESSION['roles']  = $roles; 

        if (in_array('administrador', $roles) || in_array('admin', $roles)) {
            header("Location: /public/administrador.php");
        } elseif (in_array('tecnico', $roles)) {
            header("Location: /public/iniciotec.php");
        } else {
            header("Location: /public/iniciodoc.php");
        }
        exit();

    } else {
        header("Location: /public/index.php?error=credenciales_invalidas");
        exit();
    }

} else {
    header("Location: /public/index.php");
    exit();
}
?>