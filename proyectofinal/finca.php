<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>

    <div class="div-fondo">
    <h1>Cálculo de Volumen de Trozas</h1>

    <table id="tablaTrozas">
        <thead>
            <tr>
                <th>Número de Troza</th>
                <th>Diámetro1 (pulg)</th>
                <th>Diámetro2 (pulg)</th>
                <th>Longitud (pies)</th>
                <th>Volumen (m³)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><input type="number" class="diametro1"></td>
                <td><input type="number" class="diametro2"></td>
                <td><input type="number" class="longitud"></td>
                <td><span class="volumen">0</span></td>
            </tr>
        </tbody>
    </table>
    <button id="agregarFila">Agregar Troza</button>
</div>

    <script src="script-planta.js"></script>
</body>
</html>