document.addEventListener('DOMContentLoaded', function () {
    if (!localStorage.getItem('db_usuarios')) {
        const usuariosBase = [
            { cedula: "12345678", password: "admin1234567", rol: "admin" },
            { cedula: "87654321", password: "user12345678", rol: "docente" },
            { cedula: "55555555", password: "soporte12345", rol: "soporte" }
        ];
        localStorage.setItem('db_usuarios', JSON.stringify(usuariosBase));
    }
});

const formulario = document.getElementById('loginForm');
formulario.addEventListener('submit', function(event) {
    event.preventDefault();
    const cedulaIngresada = document.getElementById('cedula').value;
    const passwordIngresada = document.getElementById('password').value;
    let usuarios = JSON.parse(localStorage.getItem('db_usuarios'));
    let usuarioAutenticado = null;
    for (let i = 0; i < usuarios.length; i++) {
        if (usuarios[i].cedula === cedulaIngresada && usuarios[i].password === passwordIngresada) {
            usuarioAutenticado = usuarios[i];
        }
    }

    if (usuarioAutenticado !== null) {
        localStorage.setItem('usuario', usuarioAutenticado.cedula);
        localStorage.setItem('rol', usuarioAutenticado.rol);
        if (usuarioAutenticado.rol === 'admin') {
            window.open("inicioadm.html", "_self");
        } else if (usuarioAutenticado.rol === 'docente') {
            window.open("iniciodoc.html", "_self");
        } else if (usuarioAutenticado.rol === 'soporte') {
            window.open("iniciotec.html", "_self");
        }
        
    } else {
        alert("Los datos ingresados no corresponden a ningún usuario registrado o la contraseña es incorrecta.");
    }
});