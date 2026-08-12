<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>SGRSI - Inicio de sesion</title>
</head>
<body>
<header>
    <h1>SGRSI</h1>
    <img src="/assets/img/logoiti.png" alt="Logo ITI">
</header>
    <h2>Inicio de sesion</h2>
    <section class="seccionlogin">
    <form id="loginForm">
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