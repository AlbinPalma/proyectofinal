<?php

// Configura tus credenciales de base de datos
$nombre_del_servidor = "localhost";
$nombre_de_usuario = "root";
$contraseña = "";
$nombre_de_la_base_de_datos = "dbproyectoumg";

// Conexión a la base de datos
$mysqli = new mysqli($nombre_del_servidor, $nombre_de_usuario, $contraseña, $nombre_de_la_base_de_datos);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

// Obtener los valores del formulario
$numeroViaje = $_POST['numeroViaje'];
$fechaCubicacion = $_POST['fechaCubicacion'];
$nombreFinca = $_POST['nombreFinca'];
$notaEnvio = $_POST['notaEnvio'];
$placaCabezal = $_POST['placaCabezal'];
$placaRastra = $_POST['placaRastra'];
$sumaTotal = $_POST['sumaTotal'];

// Consulta SQL para insertar los datos en la base de datos
$query = "INSERT INTO cubicaciones (numero_viaje, fecha_cubicacion, id_finca, nota_envio, placa_cabezal, placa_rastra, pietablar)
          VALUES ('$numeroViaje', '$fechaCubicacion', '$nombreFinca', '$notaEnvio', '$placaCabezal', '$placaRastra', '$sumaTotal')";

if ($mysqli->query($query) === TRUE) {
    // Éxito al insertar los datos
    header('Location: registro_exitoso2.php?mensaje=Registro exitoso');
    exit; // Asegúrate de que no haya más salida después de la redirección
} else {
    // Error al insertar los datos
    echo "Error al guardar los datos: " . $mysqli->error;
}

// Cerrar la conexión
$mysqli->close();
?>
