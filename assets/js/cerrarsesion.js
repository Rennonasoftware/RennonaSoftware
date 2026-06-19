const botonCerrarSesion = document.getElementById('btn-cerrar-sesion');

if (botonCerrarSesion) {
    botonCerrarSesion.addEventListener('click', function(event) {
        event.preventDefault(); 
        localStorage.removeItem('usuario');
        localStorage.removeItem('rol');
        window.open("index.html", "_self");
    });
}