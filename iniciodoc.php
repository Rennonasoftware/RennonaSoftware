<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/iniciodoc.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>SGRSI - Inicio Docente</title>
</head>
<body id="iniciodoc">
    <header class="top-bar">
        <h2>Bienvenido, Docente</h2>
        <nav>
            <a href="solicitudaula.php" class="btn-solicitud">Solicitar aula</a>
            <a href="misreportes.php" class="btn-mirar-reportes">Ver mis reportes</a>
            <a href="cerrarSesion.php" class="logout-link">Cerrar Sesion</a>
        </nav>
    </header>
    <main>
        <h1>Reportar un problema</h1>
        <form action="" id="reportedocente" class="reporte-docente">
            
            <label for="Laboratorio">Laboratorio</label>
            <input type="number" id="Laboratorio" placeholder="Ejemplo: 1" name="Laboratorio" required>
            
            <label for="Turno">Turno</label>
            <select id="Turno" name="Turno" required>
            <option value="" disabled selected>Seleccione un turno</option>
            <option value="matutino">Matutino</option>
            <option value="vespertino">Vespertino</option>
            <option value="nocturno">Nocturno</option>
            </select>
            
            <label for="grupo">Grupo</label>
            <input type="text" id="grupo" placeholder="Ejemplo: 3MA" name="Grupo" required>
            
            <section id="contenedor-reportes" class="contenedor-reportes">
                
                <fieldset class="reporte-item">
                        <legend class="reporte-item-titulo">Detalle del Problema</legend>

                    <label>Computadora</label>
                    <input type="number" name="Computadora[]" placeholder="Ejemplo: 1" required>
                    
                    <label>¿Tipo de Falla?</label>
                    <select name="Tipo de Falla[]" required>
                        <option value="hardware">Hardware / FISICO</option>
                        <option value="software">Software / VIRTUAL</option>
                        <option value="otro">Otro</option>
                    </select>
                    
                    <label>Detalles</label>
                    <input type="text" name="Detalles[]" placeholder="Ejemplo: No prende la pantalla, o otro comentario adicional." required>
                </fieldset>

            </section>

            <footer class="botones-container">
                <button type="button" id="btn-agregar-reporte" class="btn-agregar">
                    + Añadir otra computadora / falla
                </button>
                <button type="submit" class="btn-enviar">Enviar Reporte</button>
            </footer>
    <script src="assets/js/btnreporte.js"></script>
    </form>
    </main>
</body>
</html>