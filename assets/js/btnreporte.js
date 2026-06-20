const botonAgregar = document.getElementById('btn-agregar-reporte');

botonAgregar.addEventListener('click', function () {
    const contenedor = document.getElementById('contenedor-reportes');
    let nuevoCampo = `
        <fieldset class="reporte-item">
            <legend class="reporte-item-titulo">Detalle del Problema</legend>
            <label>Computadora</label>
            <input type="number" name="Computadora[]" placeholder="Ejemplo: 1" required>
            <label>¿Tipo de Falla?</label>
            <select name="Tipo de Falla[]" required>
                <option value="hardware">Hardware / FISICO</option>
                <option value="software">Software / VIRTUAL</option>
                <option value="otro">Otro</option>
            </select>
            <label>Detalles</label>
            <input type="text" name="Detalles[]" placeholder="Ejemplo: No prende" required>
        </fieldset>
    `;
    contenedor.innerHTML = contenedor.innerHTML + nuevoCampo;
});