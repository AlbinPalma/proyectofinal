<?php
include('conexion.php'); // Incluye el archivo de conexión

// Verifica si se ha proporcionado un número de viaje en la solicitud
if (isset($_GET['numero_viaje'])) {
    $numeroViaje = $_GET['numero_viaje'];

    // Consulta SQL para obtener los datos del viaje
    $sql = "SELECT cub.fecha_cubicacion, usu.nombre_finca, cub.nota_envio, cub.placa_cabezal, cub.placa_rastra
            FROM cubicaciones cub
            inner JOIN tbl_usuario usu ON cub.id_finca = usu.id_usuario
            WHERE cub.numero_viaje = $numeroViaje";

    $result = $conn->query($sql);

    // Verifica si se encontraron datos
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $datosViaje = [
            "fechaCubicacion" => $row["fecha_cubicacion"],
            "nombreFinca" => $row["nombre_finca"],
            "notaEnvio" => $row["nota_envio"],
            "placaCabezal" => $row["placa_cabezal"],
            "placaRastra" => $row["placa_rastra"]
        ];

        // Devuelve los datos en formato JSON
        echo json_encode($datosViaje);
    } else {
        echo "No se encontraron datos para el número de viaje seleccionado.";
    }
} else {
    echo "Número de viaje no proporcionado en la solicitud.";
}

// Cierra la conexión a la base de datos
$conn->close();
?>
