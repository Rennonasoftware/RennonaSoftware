const tablaUsuario = [
    { cedula: "12345678", claveHash: "admin123", activo: false },
    { cedula: "87654321", claveHash: "logis123", activo: false }
];

const tablaAdministrador = [
    { cedula: "12345678" }
];

const tablaLogistica = [
    { cedula: "87654321" }
];

const tablaCargoLogistica = [
    { cedula: "87654321", cargo: "Gerente" }
];

document.getElementById("formLogin").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
    const cedulaIngresada = document.getElementById("inputCedula").value.trim();
    const claveIngresada = document.getElementById("inputClave").value;

    const usuarioEncontrado = tablaUsuario.find(u => u.cedula === cedulaIngresada && u.claveHash === claveIngresada);

    if (!usuarioEncontrado) {
        alert("Acceso denegado: Cédula o contraseña incorrecta.");
        return;
    }

    usuarioEncontrado.activo = true;

    const esAdmin = tablaAdministrador.some(admin => admin.cedula === usuarioEncontrado.cedula);
    if (esAdmin) {
        alert("¡Autenticación Correcta! Bienvenido Administrador.");
        window.location.href = "dashboard_admin.html"; 
        return;
    }

    const esLogistica = tablaLogistica.some(logis => logis.cedula === usuarioEncontrado.cedula);
    if (esLogistica) {
        const registroCargo = tablaCargoLogistica.find(c => c.cedula === usuarioEncontrado.cedula);
        alert(`¡Autenticación Correcta! Bienvenido al panel de Logística.\nCargo asignado: ${registroCargo.cargo}`);
        window.location.href = "dashboard_logistica.html"; 
        return;
    }

    alert("Usuario autenticado sin un rol asignado en el sistema.");
    window.location.href = "inicio.html";
});