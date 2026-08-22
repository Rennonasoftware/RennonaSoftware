<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/RennonaSoftware/public/assets/css/global.css">
    <link rel="stylesheet" href="/RennonaSoftware/public/assets/css/misreportes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Mis Reportes - SGRSI</title>
</head>
<body id="misreportes">
    <header class="top-bar">
        <h2>Mis Reportes</h2>
        <nav>
            <a href="/RennonaSoftware/public/iniciodoc.php">Volver</a>
            <a href="/RennonaSoftware/public/solicitudaula.php">Solicitar Aula</a>
            <a href="/RennonaSoftware/public/cerrarSesion.php" class="logout-link">Cerrar Sesion</a>
        </nav>
    </header>
    <main>
        <h1>Historial de Reportes</h1>
        <section id="contenedor-historial" class="contenedor-reportes">
            <?php if (empty($listaReportes)): ?>
                <p>Aún no has generado ningún reporte.</p>
            <?php else: ?>
                <?php foreach ($listaReportes as $reporte): ?>
                    <article class="tarjeta-reporte">
                        <h3>Reporte #<?php echo htmlspecialchars($reporte['id_reporte']); ?></h3>
                        <p><strong>Aula:</strong> <?php echo htmlspecialchars($reporte['aula']); ?></p>
                        <p><strong>Computadora:</strong> <?php echo htmlspecialchars($reporte['computadora']); ?></p>
                        <p><strong>Falla:</strong> <?php echo htmlspecialchars($reporte['falla']); ?></p>
                        <p><strong>Estado:</strong> <?php echo htmlspecialchars($reporte['estado']); ?></p>
                        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($reporte['fecha']); ?></p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>