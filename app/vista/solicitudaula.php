<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/global.css">
    <link rel="stylesheet" href="/public/assets/css/solicitudaula.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>SGRSI - Solicitar Aula</title>
</head>
<body id="solicitudaula">
    <header class="top-bar">
        <h2>Bienvenido, Docente</h2>
        <nav>
            <a href="/public/iniciodoc.php" class="btn-solicitud">Volver a Reportar</a>
            <a href="/public/misreportes.php" class="btn-mirar-reportes">Ver mis reportes</a>
            <a href="/public/cerrarSesion.php" class="logout-link">Cerrar Sesion</a>
        </nav>
    </header>
    <main>
        <h1>Solicitar Reserva de Aula</h1>
        <form action="" id="solicitudAulaForm" class="reporte-docente">
            
            <label for="Laboratorio">Laboratorio / Aula Solicitada</label>
            <input type="number" id="Laboratorio" placeholder="Ejemplo: 2" name="Laboratorio" min="1" required>
            
            <label for="Fecha">Fecha de la Reserva</label>
            <input type="date" id="Fecha" name="Fecha" required>
            
            <label for="Turno">Turno</label>
            <select id="Turno" name="Turno" required>
            <option value="" disabled selected>Seleccione un turno</option>
            <option value="matutino">Matutino</option>
            <option value="vespertino">Vespertino</option>
            <option value="nocturno">Nocturno</option>
        </select>
            
            <label for="grupo">Grupo</label>
            <input type="text" id="grupo" placeholder="Ejemplo: 3MA" name="Grupo" required>

            <fieldset class="reporte-item">
                <legend class="reporte-item-titulo">Requerimientos de Software</legend>

                <label for="software">Software a Instalar / Configurar</label>
                <input type="text" id="software" name="Software" placeholder="Ejemplo: Node.js, Git, Visual Studio Code" required>
                
                <label for="detalles_software">Especificaciones o Versión del Software</label>
                <input type="text" id="detalles_software" name="DetallesSoftware" placeholder="Ejemplo: Versión 20.x LTS, extensión de Live Server integrada" required>
            </fieldset>

            <footer class="botones-container">
            <button type="submit" class="btn-enviar">Enviar Solicitud</button>
            </footer>
        </form>
    </main>
</body>
</html>