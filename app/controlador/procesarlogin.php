<?php
session_start();
require_once '../modelo/AccesoDatosUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Se toman los datos enviados por el formulario y se eliminan caracteres no numéricos de la cédula.
    $cedulaInput   = preg_replace('/[^0-9]/', '', $_POST['cedula'] ?? '');
    $passwordInput = $_POST['password'] ?? '';

    if (empty($cedulaInput) || empty($passwordInput)) {
        header("Location: /RennonaSoftware/public/index.php?error=campos_vacios");
        exit();
    }

    $accesoDatos = new AccesoDatosUsuario();
    $usuario     = $accesoDatos->obtenerPorCedula($cedulaInput);

    // password_verify compara la contraseña escrita con el hash guardado, sin almacenar la contraseña original.
    if ($usuario && password_verify($passwordInput, $usuario->getPassword())) {

        $roles = $usuario->getRoles();

        $_SESSION['cedula'] = $usuario->getCedula();
        $_SESSION['roles']  = $roles; 

        // La primera coincidencia de rol determina el panel al que se envía al usuario.
        if (in_array('administrador', $roles) || in_array('admin', $roles)) {
            header("Location: /RennonaSoftware/public/administrador.php");
        } elseif (in_array('tecnico', $roles)) {
            header("Location: /RennonaSoftware/public/iniciotec.php");
        } else {
            header("Location: /RennonaSoftware/public/iniciodoc.php");
        }
        exit();

    } else {
        header("Location: /RennonaSoftware/public/index.php?error=credenciales_invalidas");
        exit();
    }

} else {
    header("Location: /RennonaSoftware/public/index.php");
    exit();
}
?>