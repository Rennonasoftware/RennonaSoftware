document.addEventListener('DOMContentLoaded', function () {
    const selectorAccion = document.getElementById('adminsusu');
    const formAgregar = document.getElementById('form-agregar-usu');
    const formEliminar = document.getElementById('form-eliminar-usu');
    const formModificar = document.getElementById('form-modificar-usu');

    selectorAccion.addEventListener('change', function () {
        formAgregar.style.display = 'none';
        formEliminar.style.display = 'none';
        formModificar.style.display = 'none';

        if (selectorAccion.value === 'Agregar') {
            formAgregar.style.display = 'flex';
        } else if (selectorAccion.value === 'Eliminar') {
            formEliminar.style.display = 'flex';
        } else if (selectorAccion.value === 'Modificar') {
            formModificar.style.display = 'flex';
        }
    });

    if (!localStorage.getItem('db_usuarios')) {
        const usuariosBase = [
            { cedula: "12345678", password: "admin1234567", rol: "admin" },
            { cedula: "87654321", password: "user12345678", rol: "docente" },
            { cedula: "55555555", password: "soporte12345", rol: "soporte" }
        ];
        localStorage.setItem('db_usuarios', JSON.stringify(usuariosBase));
    }

    formAgregar.addEventListener('submit', function (ev) {
        ev.preventDefault();
        const cedula = document.getElementById('cedula').value;
        const password = document.getElementById('password').value;
        const rol = document.getElementById('rol').value;
        let usuarios = JSON.parse(localStorage.getItem('db_usuarios'));
        let existe = false;
        for (let i = 0; i < usuarios.length; i++) {
            if (usuarios[i].cedula === cedula) {
                existe = true;
            }
        }

        if (existe === true) {
            alert("Error: Usuario ya registrado.");
        } else {
            usuarios.push({ cedula: cedula, password: password, rol: rol });
            localStorage.setItem('db_usuarios', JSON.stringify(usuarios));
            alert("Usuario agregado con éxito.");
            formAgregar.reset();
        }
    });

    formEliminar.addEventListener('submit', function (ev) {
        ev.preventDefault();
        const cedulaEliminar = document.getElementById('cedula-eliminar').value;
        if (cedulaEliminar === "12345678") {
            alert("Acción denegada: No puedes eliminar la cuenta de administrador principal.");
            return;
        }

        let usuarios = JSON.parse(localStorage.getItem('db_usuarios'));
        let nuevosUsuarios = [];
        let encontrado = false;
        for (let i = 0; i < usuarios.length; i++) {
            if (usuarios[i].cedula !== cedulaEliminar) {
                nuevosUsuarios.push(usuarios[i]);
            } else {
                encontrado = true;
            }
        }
        if (encontrado === true) {
            localStorage.setItem('db_usuarios', JSON.stringify(nuevosUsuarios));
            alert("Usuario eliminado correctamente.");
            formEliminar.reset();
        } else {
            alert("El usuario no existe en la base de datos.");
        }
    });

    formModificar.addEventListener('submit', function (ev) {
        ev.preventDefault();
        const cedulaModificar = document.getElementById('cedula-modificar').value;
        const nuevaPass = document.getElementById('nuevo-password').value;
        const nuevoRol = document.getElementById('nuevo-rol').value;
        let usuarios = JSON.parse(localStorage.getItem('db_usuarios'));
        let modificado = false;
        for (let i = 0; i < usuarios.length; i++) {
            if (usuarios[i].cedula === cedulaModificar) {
                if (nuevaPass !== "") {
                    usuarios[i].password = nuevaPass;
                }
                if (nuevoRol !== "") {
                    usuarios[i].rol = nuevoRol;
                }
                modificado = true;
            }
        }

        if (modificado === true) {
            localStorage.setItem('db_usuarios', JSON.stringify(usuarios));
            alert("Usuario modificado correctamente.");
            formModificar.reset();
        } else {
            alert("No se encontró el usuario para modificar.");
        }
    });
});