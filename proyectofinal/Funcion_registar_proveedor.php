<?php
session_start();
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Limpia el mensaje de éxito
}
include('conexion2.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $finca = $_POST['finca'];

    // Consulta SQL para insertar los datos en la base de datos
    $query = "INSERT INTO tbl_usuario (nombre_usuario, correo_usuario, pass_usuario, nombre_finca, rol_usuario)
              VALUES ('$nombre', '$email', '$password', '$finca', '3')";

    if ($conexion->query($query) === TRUE) {
       header('Location: registro_exitoso.php?mensaje=Registro exitoso');
       exit; // Asegúrate de que no haya más salida después de la redirección
    } else {
        // Error al insertar los datos
        echo "Error al guardar los datos: " . $conexion->error;
    }
}

?>
