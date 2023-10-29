<?php
include('conexion.php');
 // Consulta SQL para seleccionar id y nombre_finca de tbl_usuario
$query = "SELECT id_usuario, nombre_finca FROM tbl_usuario";
$result = mysqli_query($conn,$query);
$data = array(); // Inicializa un array para almacenar los resultados

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Agrega cada fila a la matriz de datos
    }
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Volumen de Trozas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container0 {
            display: flex;
            width: 100%;
        }

        .container {
            max-width: 200%;
            margin: 0 auto;
            padding: 20px;
            background-color: #e0c088; /* Color de fondo madera */
            border: 1px solid #c0a050; /* Borde madera */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .container1 {
            max-width: 200%;
            margin: 0 auto;
            padding: 20px;
            background-color: #e0c088; /* Color de fondo madera */
            border: 1px solid #c0a050; /* Borde madera */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #663300; /* Color del encabezado */
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #663300; /* Color del texto */
        }

        button {
            display: block;
            width: 20%;
            padding: 10px;
            background-color: #663300; /* Color del botón */
            color: #fff; /* Color del texto del botón */
            border: none;
            cursor: pointer;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #c0a050; /* Borde madera */
            background-color: #fff; /* Color de fondo del campo */
            color: #663300; /* Color del texto del campo */
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #663300; /* Color del botón */
            color: #fff; /* Color del texto del botón */
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #996633; /* Color del botón al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container0">

    <div class="container1">

    <form id="formAgregarViaje" action="guardarCubicacion.php" method="POST">
                <label for="numeroViaje">Número de Viaje:</label>
                <input type="text" id="numeroViaje" name="numeroViaje" required>

                <label for="fechaCubicacion">Fecha de Cubicación:</label>
                <input type="date" id="fechaCubicacion" name="fechaCubicacion" required>

                <label for="nombreFinca">Nombre de la Finca:</label>
                <select id="nombreFinca" name="nombreFinca">
                <?php foreach ($data as $row): ?>
               <option value="<?php echo $row['id_usuario']; ?>"><?php echo $row['nombre_finca']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="notaEnvio">Número de Nota de Envío:</label>
                <input type="text" id="notaEnvio" name="notaEnvio" required>

                <label for="placaCabezal">Placa del Cabezal:</label>
                <input type="text" id="placaCabezal" name="placaCabezal" required>

                <label for="placaRastra">Placa de la Rastra:</label>
                <input type="text" id="placaRastra" name="placaRastra" required>

                <div>Total Volumen: <span id="totalVolumen">0</span> PT</div>
                <input type="hidden" id="sumaTotal" name="sumaTotal" value="0">
                <br>
                <input type="submit" value="Guardar Viaje">
                <br>
                <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>

            </form>
    </div>

    <div class="container">
        <h1>Cálculo de Volumen de Trozas</h1>

        <table id="tablaTrozas">
            <thead>
                <tr>
                    <th>Número de Troza</th>
                    <th>Diámetro1 (pulg)</th>
                    <th>Diámetro2 (pulg)</th>
                    <th>Longitud (pies)</th>
                    <th>Volumen (PT)</th>
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
        <br>
        <button id="calcularSuma">Calcular Suma Total</button>
    </div>
    
    </div>
    <script src="script-planta.js"></script>
</body>
</html>
