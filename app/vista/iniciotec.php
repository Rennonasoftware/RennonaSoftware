<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Técnico - RennonaSoftware</title>
    <link rel="stylesheet" href="/RennonaSoftware/public/assets/css/global.css">
    <link rel="stylesheet" href="/RennonaSoftware/public/assets/css/iniciotec.css">
</head>
<body>
    <main class="contenedor-tecnico">
        <header class="header-tecnico">
            <h1 class="titulo-panel">Panel de Trabajo: <?php echo htmlspecialchars($_SESSION['cedula']); ?></h1>
            <p class="subtitulo-panel">Gestión de tickets y mantenimientos pendientes.</p>
            <nav class="nav-usuario">
                <a href="/RennonaSoftware/public/cerrarSesion.php" class="btn-logout">Cerrar Sesión</a>
            </nav>
        </header>

        <section class="grid-reportes">
            <?php if (empty($listaReportes)): ?>
                <p>No hay reportes pendientes ni asignados en este momento.</p>
            <?php else: ?>
                <?php foreach ($listaReportes as $reporte): ?>
                    
                    <?php 
                        // Determinar la clase CSS según el estado
                        $claseEstado = ($reporte['estado'] === 'Pendiente') ? 'estado-pendiente' : 'estado-proceso';
                        $claseBadge = ($reporte['estado'] === 'Pendiente') ? 'badge-pendiente' : 'badge-proceso';
                    ?>

                    <article class="reporte-card <?php echo $claseEstado; ?>">
                        <header class="reporte-encabezado">
                            <h2 class="reporte-titulo">Reporte #<?php echo htmlspecialchars($reporte['id_reporte']); ?></h2>
                            <span class="badge-estado <?php echo $claseBadge; ?>">
                                <?php echo htmlspecialchars($reporte['estado']); ?>
                            </span>
                        </header>
                        
                        <section class="reporte-detalles">
                            <ul class="lista-detalles">
                                <li><strong>Área/Aula:</strong> <?php echo htmlspecialchars($reporte['aula']); ?></li>
                                <li><strong>Falla:</strong> <?php echo htmlspecialchars($reporte['falla']); ?></li>
                                <li><strong>Origen:</strong> <?php echo htmlspecialchars($reporte['origen_dispositivo']); ?></li>
                                <li><strong>Fecha:</strong> <?php echo htmlspecialchars($reporte['fecha']); ?></li>
                            </ul>
                        </section>

                        <footer class="reporte-acciones">
                            <?php if ($reporte['estado'] === 'Pendiente'): ?>
                                <form action="/RennonaSoftware/app/controlador/procesarAsignacion.php" method="POST" class="form-accion">
                                    <input type="hidden" name="id_reporte" value="<?php echo $reporte['id_reporte']; ?>">
                                    <button type="submit" class="btn-accion btn-atender">Asignarme este ticket</button>
                                </form>
                            
                            <?php elseif ($reporte['estado'] === 'En Proceso'): ?>
                                <form action="/RennonaSoftware/app/controlador/procesarResolucion.php" method="POST" class="form-accion">
                                    <input type="hidden" name="id_reporte" value="<?php echo $reporte['id_reporte']; ?>">
                                    <fieldset class="campo-observacion">
                                        <legend class="sr-only">Observaciones de la reparación</legend>
                                        <textarea name="observaciones" placeholder="Observaciones opcionales..." rows="2" class="input-observacion"></textarea>
                                    </fieldset>
                                    <button type="submit" class="btn-accion btn-resolver">Marcar como Resuelto</button>
                                </form>
                            <?php endif; ?>
                        </footer>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>