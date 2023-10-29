<?php
session_start();
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbproyectoumg";

$conn = new mysqli($servername, $username, $password, $dbname);

include('accion_login.php');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombreFincaUsuario = $_SESSION['nombre_finca'];
// Consulta para obtener la lista de viajes
$sql = "SELECT numero_viaje FROM cubicaciones WHERE id_finca = (select id_finca from tbl_usuario )";

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
