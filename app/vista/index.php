<?php
session_start();

$mensajesError = [
    'campos_vacios'         => 'Por favor, completa todos los campos.',
    'credenciales_invalidas' => 'Cédula o contraseña incorrectas.',
    'inactive_user'         => 'Tu cuenta de usuario se encuentra inactiva.',
    'no_roles'              => 'El usuario no tiene roles asignados.',
    'unauthenticated'       => 'Debes iniciar sesión para acceder al sistema.',
    'unauthorized'          => 'No tienes permisos para acceder a este panel.'
];

$codigoError = $_GET['error'] ?? null;
$mensajeMostrar = $mensajesError[$codigoError] ?? null;
?>

<?php if ($mensajeMostrar): ?>
    <div class="alert alert-danger" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
        <?php echo htmlspecialchars($mensajeMostrar); ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/global.css">
    <link rel="stylesheet" href="/public/assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>SGRSI - Inicio de sesion</title>
</head>
<body>
<header>
    <h1>SGRSI</h1>
    <img src="/public/assets/img/logoiti.png" alt="Logo ITI">
</header>
    <h2>Inicio de sesion</h2>
    <section class="seccionlogin">
    <form id="loginForm" action="../controlador/procesarlogin.php" method="POST">
        <fieldset>
            <legend>Ingrese sus datos de acceso</legend>
                <div class="input-group">
                    <label for="cedula">Cedula:</label>
                    <input type="text" id="cedula" name="cedula" autocomplete="name" title="Ingrese los 8 numeros de su cedula sin puntos ni guiones" pattern="[1-9][0-9]{7}" inputmode="numeric" maxlength="8" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" autocomplete="current-password" minlength="12" required>
                </div>
                <button type="submit">Iniciar sesion</button>
        </fieldset>
    </form>
    </section>
    <footer>
        <p>Sistema de Gestion de Recursos y Soporte de Informatica.</p>
    </footer>
</body>
</html>