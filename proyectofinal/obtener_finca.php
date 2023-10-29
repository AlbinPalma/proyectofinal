<?php
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbproyectoumg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener la lista de viajes
$sql = "SELECT nombre_finca FROM detalle_trozas";

$result = $conn->query($sql);

$viajes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $viajes[] = $row;
    }
}

// Devuelve la lista de viajes en formato JSON
echo json_encode($viajes);

$conn->close();
?>