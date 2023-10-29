//Función para calcular el volumen
function calcularVolumen(numero) {
    const diametro1 = parseFloat(document.getElementById(`diametro1`).value);
    const diametro2 = parseFloat(document.getElementById(`diametro2`).value);
    const longitudPies = parseFloat(document.getElementById(`Longitud`).value);

    // Convertir medidas a metros
    const diametro1Metros = diametro1; 
    const diametro2Metros = diametro2;
    const longitudMetros = longitudPies; 

    // Calcular el volumen utilizando la fórmula
    const volumen = (diametro1Metros * diametro2Metros * longitudMetros) / 12; // Fórmula para una elipse
    document.getElementById(`volumen`).textContent = volumen.toFixed(2);
}

// Agregar eventos de cambio a los campos de entrada
document.getElementById(`diametro1`).addEventListener('change', calcularVolumen);
document.getElementById(`diametro2`).addEventListener('change', calcularVolumen);
document.getElementById(`Longitud`).addEventListener('change', calcularVolumen);

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


