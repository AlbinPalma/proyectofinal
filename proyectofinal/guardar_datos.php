<?php
include('conexion.php'); // Incluye el archivo de conexión

// Obtén los valores del formulario
$nombreFinca = $_POST['nombreFinca'];
$precioTroza = $_POST['precioTroza'];
$precioExtractor = $_POST['precioExtractor'];
$precioTrasiego = $_POST['precioTrasiego'];
$precioFlete = $_POST['precioFlete'];

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Prepara la consulta SQL para insertar los datos
$sql = "INSERT INTO detalles_trozas (id_finca, precio_troza, precio_extractor, precio_trasiego, precio_flete)
        VALUES ((SELECT id_usuario FROM tbl_usuario WHERE nombre_finca = '$nombreFinca'), $precioTroza, $precioExtractor, $precioTrasiego, $precioFlete)";

if ($conn->query($sql) === TRUE) {
    header('Location: digitador.php');
} else {
    echo "Error al guardar los datos: " . $conn->error;
}

// Cierra la conexión a la base de datos
$conn->close();
?>
