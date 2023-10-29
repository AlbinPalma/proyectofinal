<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbproyectoumg";

// Crear la conexión
$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
