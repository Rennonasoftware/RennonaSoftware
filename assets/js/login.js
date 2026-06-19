const formulario = document.getElementById('loginForm');

formulario.addEventListener('submit', function(event) {
    event.preventDefault();
    const cedulaIngresada = document.getElementById('cedula').value;
    const passwordIngresada = document.getElementById('password').value;

    if (cedulaIngresada === "12345678" && passwordIngresada === "admin1234567") {
        localStorage.setItem('usuario', 'admin');
        localStorage.setItem('rol', 'admin');
        window.open("inicioadm.html", "_self");
    } 
    else if (cedulaIngresada === "87654321" && passwordIngresada === "user12345678") {
        localStorage.setItem('usuario', 'docente');
        localStorage.setItem('rol', 'docente');
        window.open("iniciodoc.html", "_self");
    } 
    else if (cedulaIngresada === "55555555" && passwordIngresada === "soporte12345") {
        localStorage.setItem('usuario', 'soporte');
        localStorage.setItem('rol', 'soporte');
        window.open("iniciotec.html", "_self");
    } 
    else {
        alert("Los datos ingresados no corresponden a ningún usuario registrado.");
    }
});




