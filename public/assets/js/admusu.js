document.addEventListener('DOMContentLoaded', function () {

    const selector = document.getElementById('adminsusu');

    const formAgregar =
        document.getElementById('form-agregar-usu');

    const formEliminar =
        document.getElementById('form-eliminar-usu');

    const formModificar =
        document.getElementById('form-modificar-usu');


    function mostrarFormulario() {

        // Solo se muestra el formulario correspondiente a la opción seleccionada.
        formAgregar.style.display = 'none';
        formEliminar.style.display = 'none';
        formModificar.style.display = 'none';

        if (selector.value === 'Agregar') {
            formAgregar.style.display = 'flex';
        }

        if (selector.value === 'Eliminar') {
            formEliminar.style.display = 'flex';
        }

        if (selector.value === 'Modificar') {
            formModificar.style.display = 'flex';
        }
    }


    selector.addEventListener(
        'change',
        mostrarFormulario
    );


    formAgregar.addEventListener(
        'submit',
        async function (event) {

            event.preventDefault();

            const datos = {
                cedula:
                    document.getElementById('cedula').value.trim(),

                password:
                    document.getElementById('password').value,

                rol:
                    document.getElementById('rol').value
            };

            try {
                // fetch envía JSON al controlador sin recargar la página.

                const response = await fetch(
                    '/RennonaSoftware/app/controlador/crearUsuario.php',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json'
                        },

                        body: JSON.stringify(datos)
                    }
                );

                const mensaje = await response.text();

                alert(mensaje);

                if (response.ok) {
                    formAgregar.reset();
                }

            } catch (error) {

                console.error(error);

                alert(
                    'No se pudo conectar con el servidor.'
                );
            }
        }
    );


    formEliminar.addEventListener(
        'submit',
        async function (event) {

            event.preventDefault();

            const cedula =
                document
                    .getElementById('cedula-eliminar')
                    .value
                    .trim();

            try {

                const response = await fetch(
                    '/RennonaSoftware/app/controlador/eliminarUsuario.php',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json'
                        },

                        body: JSON.stringify({
                            cedula: cedula
                        })
                    }
                );

                const mensaje = await response.text();

                alert(mensaje);

                if (response.ok) {
                    formEliminar.reset();
                }

            } catch (error) {

                console.error(error);

                alert(
                    'No se pudo conectar con el servidor.'
                );
            }
        }
    );


    formModificar.addEventListener(
        'submit',
        async function (event) {

            event.preventDefault();

            const datos = {

                cedula:
                    document
                        .getElementById('cedula-modificar')
                        .value
                        .trim(),

                password:
                    document
                        .getElementById('nuevo-password')
                        .value,

                rol:
                    document
                        .getElementById('nuevo-rol')
                        .value
            };

            try {

                const response = await fetch(
                    '/RennonaSoftware/app/controlador/modificarUsuario.php',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json'
                        },

                        body: JSON.stringify(datos)
                    }
                );

                const mensaje = await response.text();

                alert(mensaje);

                if (response.ok) {
                    formModificar.reset();
                }

            } catch (error) {

                console.error(error);

                alert(
                    'No se pudo conectar con el servidor.'
                );
            }
        }
    );


    mostrarFormulario();

});