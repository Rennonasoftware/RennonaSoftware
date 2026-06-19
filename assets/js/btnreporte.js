        document.getElementById('btn-agregar-reporte').addEventListener('click', function() {
            const contenedor = document.getElementById('contenedor-reportes');
            const primerItem = contenedor.querySelector('.reporte-item');
        
            if (!primerItem) return;
            const nuevoItem = primerItem.cloneNode(true);
        
            nuevoItem.querySelectorAll('input').forEach(input => input.value = '');
            nuevoItem.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            
            const campoOtros = nuevoItem.querySelector('.campo-otros-container');
             if (campoOtros) {
             campoOtros.style.display = 'none';
             }
             
            contenedor.appendChild(nuevoItem);
            
        });