<?php
require_once 'UsuarioModel.php';

class LoginController {
    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $usuario = UsuarioModel::verificarCredenciales($username, $password);

            if ($usuario) {
                if (session_status() === PHP_SESSION_NONE) { 
                    session_start(); 
                }
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['username'] = $usuario['username'];
                $_SESSION['rol'] = $usuario['rol'];

                switch ($usuario['rol']) {
                    case 'admin':
                        header('Location: views/dashboard_admin.php');
                        break;
                    case 'operador':
                        header('Location: views/panel_logistica.php');
                        break;
                    default:
                        header('Location: views/home_publico.php');
                        break;
                }
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require 'views/login_view.php';
            }
        }
    }
}
