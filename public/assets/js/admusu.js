ocument.addEventListener('DOMContentLoaded', function () {
    const formAgregar = document.getElementById('form-agregar-usu');
    const formEliminar = document.getElementById('form-eliminar-usu');

    // Reemplazo de lógica de Agregar con FETCH
    formAgregar.addEventListener('submit', async function (ev) {
        ev.preventDefault();
        const datos = {
            cedula: document.getElementById('cedula').value,
            password: document.getElementById('password').value,
            rol: document.getElementById('rol').value
        };

        const response = await fetch('controladores/crearUsuario.php', {
            method: 'POST',
            body: JSON.stringify(datos)
        });
        const res = await response.json();
        if(res.status === 'success') {
            alert("Usuario creado en BD");
            formAgregar.reset();
        }
    });

    // Reemplazo de lógica de Eliminar con FETCH
    formEliminar.addEventListener('submit', async function (ev) {
        ev.preventDefault();
        const cedula = document.getElementById('cedula-eliminar').value;
        
        const response = await fetch('controladores/eliminarUsuario.php', {
            method: 'POST',
            body: JSON.stringify({ cedula })
        });
        const res = await response.json();
        alert(res.status === 'success' ? "Eliminado" : "Error");
    });
});