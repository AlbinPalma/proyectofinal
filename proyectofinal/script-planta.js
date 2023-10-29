
          // Función para calcular el volumen
          function calcularVolumen(diametro1, diametro2, longitud) {
            // Convertir medidas a metros
            const diametro1Metros = diametro1 
            const diametro2Metros = diametro2 
            const longitudMetros = longitud 

            // Calcular el volumen utilizando la fórmula
            const volumen = diametro1Metros * diametro2Metros * longitudMetros / 12; // Fórmula para una elipse
            return volumen.toFixed(2);
        }

        // Función para calcular la suma total de volúmenes
        function calcularSumaTotal() {
            const volumenes = document.querySelectorAll('.volumen');
            let sumaTotal = 0;

            volumenes.forEach(volumen => {
                sumaTotal += parseFloat(volumen.textContent);
            });

            return sumaTotal.toFixed(2);
        }

        // Agregar evento al botón para agregar fila
        document.getElementById('agregarFila').addEventListener('click', function () {
            const numeroFilas = document.querySelectorAll('#tablaTrozas tbody tr').length + 1;
            const nuevaFila = document.createElement('tr');
            nuevaFila.innerHTML = `
                <td>${numeroFilas}</td>
                <td><input type="number" class="diametro1"></td>
                <td><input type="number" class="diametro2"></td>
                <td><input type="number" class="longitud"></td>
                <td><span class="volumen">0</span></td>
            `;

            document.querySelector('#tablaTrozas tbody').appendChild(nuevaFila);

            const inputs = nuevaFila.querySelectorAll('input');
            const volumenSpan = nuevaFila.querySelector('.volumen');

            inputs.forEach(input => {
                input.addEventListener('change', () => {
                    const diametro1 = parseFloat(inputs[0].value);
                    const diametro2 = parseFloat(inputs[1].value);
                    const longitud = parseFloat(inputs[2].value);
                    const volumen = calcularVolumen(diametro1, diametro2, longitud);
                    volumenSpan.textContent = volumen;
                });
            });
        });

        const inputsPrimeraFila = document.querySelectorAll('#tablaTrozas tbody tr:first-child input');
        const volumenSpanPrimeraFila = document.querySelector('#tablaTrozas tbody tr:first-child .volumen');
        inputsPrimeraFila.forEach(input => {
        input.addEventListener('change', () => {
        const diametro1 = parseFloat(inputsPrimeraFila[0].value);
        const diametro2 = parseFloat(inputsPrimeraFila[1].value);
        const longitud = parseFloat(inputsPrimeraFila[2].value);
        const volumen = calcularVolumen(diametro1, diametro2, longitud);
        volumenSpanPrimeraFila.textContent = volumen;
    });
});

        // Agregar evento al botón para calcular la suma total
document.getElementById('calcularSuma').addEventListener('click', function () {
    const sumaTotal = calcularSumaTotal();
    document.querySelector('#totalVolumen').textContent = sumaTotal;
    document.querySelector('#sumaTotal').value = sumaTotal; // Actualiza el campo oculto
});