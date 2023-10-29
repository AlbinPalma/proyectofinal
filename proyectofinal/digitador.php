<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ingreso de Datos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
        <!-- DataTable -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
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

        .container2 {
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
        <div class="container">
        <h2>Formulario de Ingreso de Datos de Trozas</h2>
        <form action="guardar_datos.php" method="POST">
            <label for="nombreFinca">Nombre de la Finca:</label>
            <select id="nombreFinca" name="nombreFinca" required>
                <?php
                // Conexión a la base de datos (asegúrate de configurar las credenciales correctamente)
                $mysqli = new mysqli("localhost", "root", "", "dbproyectoumg");

                // Verificar la conexión
                if ($mysqli->connect_error) {
                    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
                }

                // Consulta SQL para seleccionar los nombres de fincas desde tbl_usuario
                $query = "SELECT DISTINCT nombre_finca FROM tbl_usuario";
                $result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['nombre_finca'] . "'>" . $row['nombre_finca'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay nombres de fincas disponibles</option>";
                }

                // Cerrar la conexión
                $mysqli->close();
                ?>
            </select>

            <label for="precioTroza">Precio de Troza:</label>
            <input type="text" id="precioTroza" name="precioTroza" required>

            <label for="precioExtractor">Precio de Extractor:</label>
            <input type="text" id="precioExtractor" name="precioExtractor" required>

            <label for="precioTrasiego">Precio de Trasiego:</label>
            <input type="text" id="precioTrasiego" name="precioTrasiego" required>

            <label for="precioFlete">Precio de Flete:</label>
            <input type="text" id="precioFlete" name="precioFlete" required>

            <input type="submit" value="Guardar">
        </form>
        <br>
        <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
    </div>
   <div class="container">
    <h2>Lista de Datos de Finca</h2>
    <!-- Aplicar estilos de Bootstrap a la tabla -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre de la Finca</th>
                <th>Precio de Flete</th>
                <th>Precio de Extractor</th>
                <th>Precio de Trasiego</th>
                <th>Precio de Troza</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Conexión a la base de datos (asegúrate de configurar las credenciales correctamente)
$mysqli = new mysqli("localhost", "root", "", "dbproyectoumg");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

// Consulta SQL para seleccionar datos de detalles_trozas y el nombre de finca de tbl_usuario
$query = "SELECT d.id, u.nombre_finca, d.precio_extractor, d.precio_flete, d.precio_trasiego, d.precio_troza
          FROM detalles_trozas d
          INNER JOIN tbl_usuario u ON d.id_finca = u.id_usuario";

$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nombre_finca'] . "</td>";
        echo "<td>" . $row['precio_extractor'] . "</td>";
        echo "<td>" . $row['precio_flete'] . "</td>";
        echo "<td>" . $row['precio_trasiego'] . "</td>";
        echo "<td>" . $row['precio_troza'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay datos en la base de datos.</td></tr>";
}

// Cerrar la conexión
$mysqli->close();
?>

            </tbody>
        </table>
        </div>
    </div>
    
</body>
</html>
