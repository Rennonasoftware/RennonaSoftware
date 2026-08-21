<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SGRSI - Administrar Usuarios</title>

    <link rel="stylesheet"
          href="/RennonaSoftware/public/assets/css/global.css">

    <link rel="stylesheet"
          href="/RennonaSoftware/public/assets/css/admusu.css">
</head>

<body id="admusu">

<header class="top-bar">

    <h2>Administrar Usuarios</h2>

    <nav>
        <a href="/RennonaSoftware/public/administrador.php">
            Volver
        </a>

        <a href="/RennonaSoftware/public/cerrarSesion.php">
            Cerrar sesión
        </a>
    </nav>

</header>

<main>

    <section class="seleccionar-accion-AEM">

        <label for="adminsusu">
            Seleccione una acción
        </label>

        <select id="adminsusu">

            <option value="Agregar">
                Agregar Usuario
            </option>

            <option value="Eliminar">
                Eliminar Usuario
            </option>

            <option value="Modificar">
                Modificar Usuario
            </option>

        </select>

    </section>


    <form id="form-agregar-usu"
          class="reporte-docente">

        <h2>Agregar Usuario</h2>

        <label for="cedula">
            Cédula
        </label>

        <input
            type="text"
            id="cedula"
            name="cedula"
            pattern="[1-9][0-9]{7}"
            inputmode="numeric"
            maxlength="8"
            required
        >

        <label for="password">
            Contraseña
        </label>

        <input
            type="password"
            id="password"
            name="password"
            minlength="12"
            required
        >

        <label for="rol">
            Seleccione un rol
        </label>

        <select id="rol" name="rol" required>

            <option value="Administrador">
                Administrador
            </option>

            <option value="Docente">
                Docente
            </option>

            <option value="Logistica">
                Logística
            </option>

        </select>

        <button type="submit"
                class="btn-enviar">
            Agregar Usuario
        </button>

    </form>


    <form id="form-eliminar-usu"
          class="reporte-docente"
          style="display:none;">

        <h2>Eliminar Usuario</h2>

        <label for="cedula-eliminar">
            Cédula
        </label>

        <input
            type="text"
            id="cedula-eliminar"
            pattern="[1-9][0-9]{7}"
            inputmode="numeric"
            maxlength="8"
            required
        >

        <button type="submit"
                class="btn-enviar">
            Eliminar Usuario
        </button>

    </form>


    <form id="form-modificar-usu"
          class="reporte-docente"
          style="display:none;">

        <h2>Modificar Usuario</h2>

        <label for="cedula-modificar">
            Cédula
        </label>

        <input
            type="text"
            id="cedula-modificar"
            pattern="[1-9][0-9]{7}"
            inputmode="numeric"
            maxlength="8"
            required
        >

        <label for="nuevo-password">
            Nueva contraseña
        </label>

        <input
            type="password"
            id="nuevo-password"
            minlength="12"
            placeholder="Dejar vacío para mantener actual"
        >

        <label for="nuevo-rol">
            Nuevo rol
        </label>

        <select id="nuevo-rol">

            <option value="">
                Mantener rol actual
            </option>

            <option value="Administrador">
                Administrador
            </option>

            <option value="Docente">
                Docente
            </option>

            <option value="Logistica">
                Logística
            </option>

        </select>

        <button type="submit"
                class="btn-enviar">
            Modificar Usuario
        </button>

    </form>

</main>

<script src="/RennonaSoftware/public/assets/js/admusu.js"></script>

</body>
</html>