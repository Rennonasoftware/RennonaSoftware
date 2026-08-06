const usuario = localStorage.getItem('usuario');
const rol = localStorage.getItem('rol');

if (!usuario || !rol) {
    alert("No has iniciado sesión. Por favor, inicia sesión para acceder a esta página.");
    window.location.href = "index.html";
} else {
    const paginaActual = window.location.pathname;
    const regresarAPagina = {
        'admin': 'inicioadm.html',
        'docente': 'iniciodoc.html',
        'soporte': 'iniciotec.html'
    };
    if (paginaActual.includes("inicioadm.html") || paginaActual.includes("admusu.html")) {
        if (rol !== 'admin') {
            alert("Acceso denegado. Esta zona es exclusiva para administradores.");
            window.location.href = regresarAPagina[rol];
        }
    } 
    else if (paginaActual.includes("iniciodoc.html") || paginaActual.includes("solicitudaula.html") || paginaActual.includes("misreportes.html")) {
        if (rol !== 'docente') {
            alert("Acceso denegado. Esta zona es exclusiva para docentes.");
            window.location.href = regresarAPagina[rol];
        }
    } 
    else if (paginaActual.includes("iniciotec.html")) {
        if (rol !== 'soporte') {
            alert("Acceso denegado. Esta zona es exclusiva para el equipo de soporte técnico.");
            window.location.href = regresarAPagina[rol];
        }
    }
}