<?php
 session_start();
    include('conexion.php');
    $nombreFincaUsuario = $_SESSION['nombre_finca'];

    $consulta = "SELECT
    usu.nombre_finca,
    det.precio_troza,
    cub.nota_envio,
    cub.fecha_cubicacion,
    cub.placa_cabezal,
    cub.placa_rastra,
    det.precio_extractor,
    det.precio_trasiego,
    det.precio_flete,
    cub.pietablar,
    (det.precio_troza + det.precio_extractor + det.precio_trasiego + det.precio_flete) * cub.pietablar AS total_a_pagar
FROM
    detalles_trozas AS det
JOIN
    cubicaciones AS cub
ON
    det.id_finca = cub.id_finca
JOIN
    tbl_usuario AS usu
ON
    cub.id_finca = usu.id_usuario
WHERE
    usu.nombre_finca = '$nombreFincaUsuario'";

$resultado = mysqli_query($conn, $consulta);
$tabla = "<table border='1' class='table table-striped table-hover'>
<tr>
<th>No. Viaje</th>
<th>Nombre Finca</th>
<th>Nota Envio</th>
<th>Fecha Cubicacion</th>
<th>Placa Cabezal </th>
<th>Placa Rastra</th>
<th>Precio de Troza</th>
<th>Precio de extractor</th>
<th>Precio de Trasiego</th>
<th>Precio de Flete</th>
<th>Pie Tablar</th>
<th>Total a Pagar</th>
</tr>";

$numeroViaje = 1; // Inicializa el número de viaje
while ($registro = mysqli_fetch_assoc($resultado)) {
    $tabla .= "<tr>";
    $tabla .= "<td>{$numeroViaje}</td>"; // Muestra el número de viaje
    $tabla .= "<td>{$registro['nombre_finca']}</td>";
    $tabla .= "<td>{$registro['nota_envio']}</td>";
    $tabla .= "<td>{$registro['fecha_cubicacion']}</td>";
    $tabla .= "<td>{$registro['placa_cabezal']}</td>";
    $tabla .= "<td>{$registro['placa_rastra']}</td>";
    $tabla .= "<td>{$registro['precio_troza']}</td>";
    $tabla .= "<td>{$registro['precio_extractor']}</td>";
    $tabla .= "<td>{$registro['precio_trasiego']}</td>";
    $tabla .= "<td>{$registro['precio_flete']}</td>";
    $tabla .= "<td>{$registro['pietablar']}</td>";
    $tabla .= "<td>{$registro['total_a_pagar']}</td>";
    $tabla .= "</tr>";

    $numeroViaje++; // Incrementa el número de viaje para la siguiente fila
}

$tabla .= "</table>";
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Informacion Proveedor</h1>
   
    <title>Resumen de Cubicación</title>

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
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
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
    
    <style>
        .div-fondo {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0; 
        }

        h1 {
            text-align: center;
        }

        .resumen {
            width: 200%;
            max-width: 1000px; 
            margin-left: 100px;
            background-color: #fff; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 1); 
            padding: 20px;
        }

        .resumen h2 {
            text-align: center;
        }

        .resumen table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .resumen th, .resumen td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <div class="container">
    
        <div class="resumen">
        <button> <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a></button>
            <h2>Resumen de Cubicación</h2>
                </table>
                    <?php
                    echo $tabla 
                     ?>
            </form>
        </div>
    </div>

    <script>
       
function cargarDatosViaje() {
    // Obtén el valor seleccionado del combo box
    const numeroViajeSelect = document.getElementById("numeroViajeSelect");
    const numeroViaje = numeroViajeSelect.value;
    // Verifica si se ha seleccionado un número de viaje
    if (numeroViaje === "") {
        return;
    }

    // Realiza una solicitud AJAX para obtener los datos del viaje desde PHP
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parsea la respuesta JSON recibida desde PHP
            const data = JSON.parse(xhr.responseText);
            var nombreFinca = "EjemploNombreFinca";

            // Llena los campos del formulario con los datos obtenidos
            document.getElementById("fechaCubicacion").textContent = data.fechaCubicacion;
            document.getElementById("nombreFinca").textContent = data.nombreFinca;
            document.getElementById("notaEnvio").textContent = data.notaEnvio;
            document.getElementById("placaCabezal").textContent = data.placaCabezal;
            document.getElementById("placaRastra").textContent = data.placaRastra;
        }
    };

    // Realiza una solicitud GET al servidor para obtener los datos del viaje
    xhr.open("GET", `obtener_datos_viaje.php?numero_viaje=${numeroViaje}`, true);
    xhr.send();
}

// Llama a la función para cargar los viajes disponibles al cargar la página
cargarViajes();
    </script>
</body>
</html>

