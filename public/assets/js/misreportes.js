document.addEventListener('DOMContentLoaded', function () {
    const contenedor = document.getElementById('contenedor-historial');

    const reportesMock = [
        {
            id: 14, laboratorio: "2", turno: "Vespertino",
            falla: "Hardware / FISICO", detalle: "El equipo enciende pero no conecta.",
            estado: "abierto", fecha: "19-06-2026"
        },
        {
            id: 13, laboratorio: "1", turno: "Nocturno",
            falla: "Software / VIRTUAL", detalle: "Falta instalar Node.js.",
            estado: "cerrado", fecha: "15-06-2026"
        }
    ];

    if (reportesMock.length === 0) {
        contenedor.innerHTML = '<p style="text-align: center;">Aún no has generado ningún reporte o solicitud.</p>';
    } else {
        let contenidoEstatico = "";

        reportesMock.forEach(function (reporte) {
            let textoEstado = "";

            if (reporte.estado === 'abierto') {
                textoEstado = 'Abierto';
            } else {
                textoEstado = 'Cerrado';
            }
            contenidoEstatico = contenidoEstatico + `
                <article class="tarjeta-reporte">
                    <header>
                        <h3>Reporte #${reporte.id} - Laboratorio ${reporte.laboratorio}</h3>
                        <span class="estado-badge ${reporte.estado}">${textoEstado}</span>
                    </header>
                    <section>
                        <p><strong>Fecha:</strong> ${reporte.fecha}</p>
                        <p><strong>Turno:</strong> ${reporte.turno}</p>
                        <p><strong>Tipo de Falla:</strong> ${reporte.falla}</p>
                        <p><strong>Detalle:</strong> ${reporte.detalle}</p>
                    </section>
                </article>
            `;
        });
        
        contenedor.innerHTML = contenidoEstatico;
    }
});